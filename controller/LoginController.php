<?php
    class LoginController extends ACoreAdmin {
        use GenerateRandomPassword;

        private function validate_data ($email, $name) {
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error']['email_message'] = 'Неверный email';
            }
            if (count($this->user->getUserByEmail($email)) != 0) {
                $_SESSION['error']['email_message'] = 'Почта либо занята, либо это ваша';
            }
            if (preg_match("/[^(\w)|(\x7F-\xFF)|(\s)]/",$name)) {
                $_SESSION['error']['first_name_message'] = 'Имя содержит запрещенные знаки';
            }
        }

        public function UserLogin() {
            unset($_SESSION["user"]);
            $email = $_POST['email'];
            $password = $_POST['pass'];

            $res = $this->user->getAuthorizationUserByEmail($email, $password);
            if(count($res) != 0) {
                if ($res[0]['is_creator'] == 0) {
                    $_SESSION["user"] = [
                        'id' => $res[0]['id'],
                        'email' => $res[0]['email'],
                        'avatar' => $res[0]['avatar'],
                        'is_creator' => 0
                    ];
                    if (!is_null($res[0]['first_name'])) $_SESSION['user']['first_name'] = $res[0]['first_name'];
                    if (!is_null($res[0]['telephone'])) $_SESSION['user']['telephone'] = $res[0]['telephone'];
                } else {
                    $response = "Вам не разрешён доступ";
                    echo $response;
                    die(header("HTTP/1.0 404 Not Found"));
                }
            }
            else {
                $response = "Неверный пароль или логин";
                echo $response;
                die(header("HTTP/1.0 404 Not Found"));
            }
            header('Location: /');
        }

        public function login () {
            $username = $_POST['login'];
            $password = $_POST['pass'];

            $res = $res = $this->user->getAuthorizationUserByUsername($username, $password);
            if(count($res) != 0) {
                unset($_SESSION["user"]);
                $_SESSION["user"] = [
                    'id' => $res[0]['id'],
                    'niche' => $res[0]['niche'],
                    'avatar' => $res[0]['avatar'],
                    'username' => $res[0]['username'],
                    'first_name' => $res[0]['first_name'],
                    'second_name' => $res[0]['second_name'],
                    'email' => $res[0]['email'],
                    'site_url' => $res[0]['site_url'],
                    'is_creator' => 1

                ];
                $integrations = $this->user->getUserIntegrations();
                if (count($integrations) != 0) {
                    $_SESSION['user']['albato_key'] = $integrations[0]['albato_key'];
                    $_SESSION['user']['prodamus_key'] = $integrations[0]['prodamus_key'];
                }

                $tariff_id = $this->tariff_class->GetUserTariff()['tariff_id'];
                if (count($tariff_id) != 0) $_SESSION['user']['tariff'] = $tariff_id;
                $this->get_content();
            } else {
                $response = "Неверный логин или пароль";
                echo $response;
                die(header("HTTP/1.0 404 Not Found"));
            }
            header('Location: /');
            return True;
        }

        public function registration () {

            $username = $_POST['username'];

            $first_name = $_POST['first_name'];

            $second_name = $_POST['second_name'];

            $niche = $_POST['niche'];

            $email = $_POST['email'];

            $password = $_POST['pass'];

            $ava = "uploads/ava/" . $email. "_" .$_FILES['avatar']['name'];

            if($_FILES['avatar']['size'] == 0){
                $ava = "uploads/ava/userAvatar.jpg";
            }

            move_uploaded_file($_FILES['avatar']['tmp_name'], "./".$ava);

            $res = $this->user->getUserByEmail($email);
            if(count($res) != 0){
                $response = "На этот адрес электронной почты уже был зарегистрирован аккаунт";
                echo $response;
                die(header("HTTP/1.0 404 Not Found"));
            }

            $resUsername = $this->user->getUserByUsername($username);

            if(count($resUsername) != 0){
                $response = "На этот логин уже был зарегистрирован аккаунт";
                echo $response;
                die(header("HTTP/1.0 404 Not Found"));
            }

            $this->validate_data($email, $first_name);
            $data = [
                'niche' => $niche,
                'avatar' => $ava,
                'username' => $username,
                'first_name' => $first_name,
                'second_name' => $second_name,
                'email' => $email,
                'password' => $password,
                'is_creator' => 1
            ];

            unset($_SESSION['user']);

            $this->user->InsertQuery('user', $data);

            sleep(0.5);

            $res = $this->user->getAuthorizationUserByUsername($username, $password);
            if(count($res) != 0) {
                $_SESSION["user"] = [
                    'id' => $res[0]['id'],
                    'niche' => $res[0]['niche'],
                    'avatar' => $res[0]['avatar'],
                    'username' => $res[0]['username'],
                    'first_name' => $res[0]['first_name'],
                    'second_name' => $res[0]['second_name'],
                    'email' => $res[0]['email'],
                    'site_url' => $res[0]['site_url'],
                    'is_creator' => 1
                ];
                $title = "Спасибо за регистрацию";
                $body = include './template/templates_email/WelcomeClient.php';
                $data = [
                    "from" => $this->ourEmail,
                    "from_name" => $this->ourNickName,
                    "sender" => $this->ourEmail,
                    "to" => $this->email,
                    "content" => $body,
                    "is_send_now" => 1,
                    "is_html" => 1,
                    "subject" => "dwdwdwd"
                ];

                $f = $this->user->GetApi();
                $this->api_key = $f['api_key'];
                $this->api_endpoint = $f['endpoint'];
                $this->EmailQueueApiCall($this->api_endpoint, $this->api_key, $data);
//                $this->SendEmail($title, $body, $email);
            }

            mkdir("./uploads/users/" . $_SESSION['user']['id']);
            mkdir("./uploads/users/". $_SESSION['user']['id'] . "/funnels");
            mkdir("./uploads/users/". $_SESSION['user']['id'] . "/courses");
            mkdir("./uploads/users/". $_SESSION['user']['id'] . "/files");
            mkdir("./uploads/users/". $_SESSION['user']['id'] . "/course_files");
            mkdir("./uploads/users/". $_SESSION['user']['id'] . "/thumbnails");
            chmod("./uploads/users/" . $_SESSION['user']['id'], 0777);
            chmod("./uploads/users/". $_SESSION['user']['id'] . "/funnels", 0777);
            chmod("./uploads/users/". $_SESSION['user']['id'] . "/courses", 0777);
            chmod("./uploads/users/". $_SESSION['user']['id'] . "/files", 0777);
            chmod("./uploads/users/". $_SESSION['user']['id'] . "/course_files", 0777);
            chmod("./uploads/users/". $_SESSION['user']['id'] . "/thumbnails", 0777);
            echo true;
            return true;
        }

        public function saveUserSettings() {

            $user = $this->user->getCurrentUser();

            if (strlen($_POST['first_name']) == 0) {
                $first_name = $_SESSION['user']['first_name'];
            } else {
                if (preg_match("/[^(\w)|(\x7F-\xFF)|(\s)]/",$_POST['first_name'])) {
                    $_SESSION['error']['first_name_message'] = 'Имя содержит запрещенные знаки';
                    return False;
                }
                $first_name = $_POST['first_name'];
            }

            if (strlen($_POST['second_name']) == 0) {
                $second_name =  $_SESSION['user']['second_name'];
            } else {
                if (preg_match("/[^(\w)|(\x7F-\xFF)|(\s)]/",$_POST['second_name'])) {
                    $_SESSION['error']['second_name_message'] = 'Фамилия содержит запрещенные знаки';
                    return False;
                }
                $second_name = $_POST['second_name'];
            }

            $data = [
                "first_name" => $first_name,
                "second_name" => $second_name
            ];

            $this->user->UpdateQuery('user', $data, "WHERE id = " . $_SESSION['user']['id']);

            $_SESSION["user"]['first_name'] = $first_name;
            $_SESSION["user"]['second_name'] = $second_name;

            $npass = $_POST['new_pass'];
            $npassr = $_POST['new_pass_repeat'];

            if ($user[0]["password"] != $_POST['old_pass']) {
                $_SESSION['error']['pass_message'] = 'Неверный пароль';
                return False;
            }
            if($npass != $npassr){
                $_SESSION['error']['pass_message'] = 'Пароли не совпадают';
                return False;
            }else{
                $class = "item-lite";
                $user_id = $_SESSION["user"]["id"];
                $message = "Ваш пароль изменен";

                $date = date("d.m.Y");
                $time = date("H:i");

                $data = [
                    "user_id" => $user_id,
                    "class" => $class,
                    "body" => $message,
                    "date" => $date,
                    "time" => $time,
                    "is_checked" => 0
                ];

                $this->notifications_class->InsertQuery('notifications', $data);

                $data = [
                    'password' => $npass
                ];
                $this->user->UpdateQuery('user', $data, "WHERE id = " . $_SESSION['user']['id']);
                unset($_SESSION['error']['pass_message']);
            }
            header('Location: /');
            return true;
        }

        public function recovery()
        {

            unset($_SESSION['user']);
            $username = $_POST['username'];
            $user = $this->user->getUserByUsername($username);
            if (count($user) == 1) {
                $title = "Восстановление пароля";
                $this->password = $this->GenerateRandomPassword(12);
                $data = [
                    "password" => $this->password,
                    "username" => $username
                ];
                $this->user->UpdateQuery("user", $data, "WHERE id = {$user[0]['id']}");
                $body = include "./template/templates_email/vosstanovlenie-parolya(client, user).php";
                $this->SendEmail($title, $body, $user[0]['email']);
                header('Location: /login');
                return true;
            }
            header('Location: /');
            return false;
        }

        public function UserRecovery()
        {
            unset($_SESSION['user']);

            $this->email = $_POST['email'];
            $this->user->GetApi();

            $user = $this->user->getUserByEmail($this->email);
            if (count($user) == 1) {
                $title = "Восстановление пароля";
                $this->password = $this->GenerateRandomPassword(12);
                $data = [
                    "password" => $this->password
                ];
                $this->user->UpdateQuery("user", $data, "WHERE email = {$this->email}");
                $body = include "./template/templates_email/vosstanovlenie-parolya(client, user).php";
                $this->SendEmail($title, $body, $user[0]['email']);
                header('Location: /UserLogin');
                return true;
            }
            header('Location: /');
            return false;
        }


        public function logout() {
            unset($_SESSION['user']);
            header('Location: /');
        }

        function get_content()
        {
        }
    }
