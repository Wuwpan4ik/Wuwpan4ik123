<?php
    class LoginController extends ACoreAdmin {
        private function validate_data ($email, $name) {
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error']['email_message'] = 'Неверный email';
            }
            if (count($this->db->db->query("SELECT * FROM user WHERE email = '$email'")) != 0) {
                $_SESSION['error']['email_message'] = 'Почта либо занята, либо это ваша';
            }
            if (preg_match("/[^(\w)|(\x7F-\xFF)|(\s)]/",$name)) {
                $_SESSION['error']['first_name_message'] = 'Имя содержит запрещенные знаки';
            }
        }

        private function GenerateRandomPassword ($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') {
            $str = '';
            $max = strlen($keyspace) - 1;
            if ($max < 1) {
                throw new Exception('$keyspace must be at least two characters long');
            }
            for ($i = 0; $i < $length; ++$i) {
                $str .= $keyspace[rand(0, $max)];
            }
            return $str;
        }

        private function GetRecoveryHtml($login, $password) {
            return '<html lang="RU">
                        <head>
                            <meta charset="UTF-8">
                            <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        </head>
                        <body style="padding:0px;margin:0px;max-width: 800px;font-family: Verdana, Geneva, Tahoma, sans-serif;background: #EFEFEF;">
                        <div class="envelope-container">
                            <div class="envelope-body" style="background:white;">
                                <div class="first_row">
                                    <img style="width:100%;" src="https://course-creator.io/envelope-images/envelope-welcome.jpg" alt="Добро пожаловать в Course Creator!">
                                </div>
                                <div class="second_row" style="padding:40px 20px;">
                                    <h2 style="font-size:24px;font-weight: 400;margin-top: 0px;margin-left:0px;margin-bottom: 20px;margin-right: 0px;">
                                        Ваш пароль был изменён
                                    </h2>
                                    <span style="color: rgba(0, 0, 0, 0.6);font-size:16px;font-weight:400;">
                                        Если вы не отправляли запрос и это письмо пришло к вам по ошибке, свяжитесь с нами в телеграмм: <a href="https://t.me/CourseCreatorBot" target="_blank">@CourseCreatorBot</a>
                                    </span>
                                    <div class="info_account" style="display:-webkit-box;
                                    display:-ms-flexbox;flex-direction:column;
                                    display:flex;-webkit-box-pack: justify;-ms-flex-pack: justify;justify-content: space-between;gap: 20px;margin-top: 40px;">
                                        <div class="first_row" style="width:50%">
                                            <p style="font-weight:700;font-size:14px;margin-top: 0px;margin-left:0px;margin-bottom: 20px;margin-right: 0px;color: rgba(0, 0, 0, 0.9);">
                                                Ваш логин:
                                            </p>
                                            <div style="color: #8098AB;background: #EFF3F6;border-radius: 3px;padding-top: 15px;padding-bottom: 15px;padding-right: 20px;padding-left: 20px;">
                                                '. $login .'
                                            </div>
                                        </div>
                                        <br>
                                        <div class="second_row" style="width:100%">
                                            <p style="font-weight:700;font-size:14px;margin-top: 0px;margin-left:0px;margin-bottom: 20px;margin-right: 0px;color: rgba(0, 0, 0, 0.9);">
                                                Ваш пароль:
                                            </p>
                                            <div style="color: #8098AB;background: #EFF3F6;border-radius: 3px;padding-top: 15px;padding-bottom: 15px;padding-right: 20px;padding-left: 20px;">
                                                '. $password .'
                                            </div>
                                        </div>
                                    </div>
                                    <div class="link_account" style="margin-top: 20px;">
                                        <a href="https://course-creator.io/UserLogin" target="_blank">
                                            <button style="width:100%; height:48px;border:none;font-size:16px;border-radius: 10px;background: linear-gradient(299.36deg, rgba(55, 101, 223, 0.93) 0%, rgba(100, 162, 255, 0.96) 100%);color:white;cursor: pointer;">
                                                Перейти в аккаунт
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="envelope_info_bottom" style="text-align: center;margin-top:20px;margin-bottom: 20px;">
                                <div style="font-size:12px;">
                                    Если у вас есть вопросы, пожалуйста, напишите <br> в службу поддержки: <a href="mailto:support@course-creator.io">support@course-creator.io</a>
                                </div>
                            </div>
                            </div>
                        </body>
                        </html>';
        }

        private function GetRegistrationHtml($login)
        {
            return '<html lang="RU">
                        <head>
                            <meta charset="UTF-8">
                            <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        </head>
                        <body style="padding:0px;margin:0px;max-width: 800px;font-family: Verdana, Geneva, Tahoma, sans-serif;background: #EFEFEF;">
                        <div class="envelope-container">
                            <div class="envelope-body" style="background:white;">
                                <div class="first_row">
                                    <img style="width:100%;" src="https://course-creator.io/envelope-images/envelope-welcome.jpg" alt="Добро пожаловать в Course Creator!">
                                </div>
                                <div class="second_row" style="padding:20px 40px;">
                                    <h2 style="font-size:24px;font-weight: 400;margin:0px 0px 20px 0px;">
                                        Добро пожаловать в Сourse Сreator
                                    </h2>
                                    <span style="color: rgba(0, 0, 0, 0.6);font-size:16px;font-weight:400;">
                                        Спасибо, что вы зарегистрировались в Сourse Сreator! Ниже важная информация о вашем аккаунте. Пожалуйста, сохраните это письмо, чтобы можно было обратиться к нему позже.
                                    </span>
                                    <div class="info_account" style="display:-webkit-box;
                                    display:-ms-flexbox;flex-direction:column;
                                    display:flex;-webkit-box-pack: justify;-ms-flex-pack: justify;justify-content: space-between;margin-top: 40px;">
                                        <div class="first_row" style="width:100%">
                                            <p style="font-weight:700;font-size:14px;margin-top: 0px;margin-left:0px;margin-bottom: 20px;margin-right: 0px;color: rgba(0, 0, 0, 0.9);">
                                                Ваш логин:
                                            </p>
                                            <div style="color: #8098AB;background: #EFF3F6;border-radius: 3px;padding-top: 15px;padding-bottom: 15px;padding-right: 20px;padding-left: 20px;">
                                                '.$login.'
                                            </div>
                                        </div>
                                        <div class="link_account" style="margin-top: 20px;">
                                            <a href="https://course-creator.io/UserLogin" target="_blank">
                                                <button style="width:100%; height:48px;border:none;font-size:16px;border-radius: 10px;background: linear-gradient(299.36deg, rgba(55, 101, 223, 0.93) 0%, rgba(100, 162, 255, 0.96) 100%);color:white;cursor: pointer;">
                                                    Перейти в аккаунт
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="envelope_info_bottom" style="text-align: center;margin-top:20px;margin-bottom: 20px;">
                                <div style="font-size:12px;">
                                    Если у вас есть вопросы, пожалуйста, напишите <br> в службу поддержки: <a href="mailto:support@course-creator.io">support@course-creator.io</a>
                                </div>
                            </div>
                        </div>
                        </body>
                        </html>';
        }

        public function UserLogin() {
            $email = $_POST['email'];
            $password = $_POST['pass'];

            $res = $this->db->db->query("SELECT * FROM user WHERE email = '$email' AND password = '$password'");
            if(count($res) != 0) {
                unset($_SESSION["user"]);
                if ($res[0]['is_creator'] == 0) {
                    $_SESSION["user"] = [
                        'id' => $res[0]['id'],
                        'email' => $res[0]['email'],
                        'avatar' => $res[0]['avatar'],
                        'is_creator' => 0
                    ];
                    if (!is_null($res[0]['first_name'])) {
                        $_SESSION['user']['first_name'] = $res[0]['first_name'];
                    }
                } else {
                    $response = "Вам не разрешён доступ";
                    echo $response;
                    die(header("HTTP/1.0 404 Not Found"));
                }
            } else {
                $response = "Неверный пароль или логин";
                echo $response;
                die(header("HTTP/1.0 404 Not Found"));
            }
            header('Location: /');
        }

        public function login () {
            $login = $_POST['login'];
            $password = $_POST['pass'];

            $res = $this->db->db->query("SELECT * FROM user WHERE username = '$login' AND password = '$password'");
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
                $integrations = $this->db->db->query("SELECT * FROM `user_integrations` WHERE user_id = {$_SESSION['user']['id']}");
                if (count($integrations) != 0) {
                    $_SESSION['user']['albato_key'] = $integrations[0]['albato_key'];
                    $_SESSION['user']['prodamus_key'] = $integrations[0]['prodamus_key'];
                }

                $tariff_id = $this->db->db->query("SELECT * FROM `users_tariff` WHERE `user_id` = {$_SESSION['user']['id']}")[0]['tariff_id'];
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

            $res = $this->db->db->query("SELECT * FROM user WHERE email = '$email'");
            if(count($res) != 0){
                $response = "На этот адрес электронной почты уже был зарегистрирован аккаунт";
                echo $response;
                die(header("HTTP/1.0 404 Not Found"));
            }

            $this->validate_data($email, $first_name);

            $this->db->db->execute("INSERT INTO `user` (`niche`, `avatar`,`username`, `first_name`, `second_name`, `email`, `password`, `is_creator`) VALUES ('$niche', '$ava', '$username', '$first_name', '$second_name', '$email', '$password', 1)");
            $res = $this->db->db->query("SELECT * FROM user WHERE username = '$username' AND password = '$password'");
            if(count($res) != 0) {
                if ($res[0]['is_creator'] != 0) {
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
                    $body = $this->GetRegistrationHtml($username);
                    $this->SendEmail($title, $body, $email);
                }
            } else {
                $response = "Неверный логин или пароль";
                echo $response;
                die(header("HTTP/1.0 404 Not Found"));
            }

//            foreach (['', '/funnels', '/courses', '/files', '/course_files', '/thumbnails'] as $item) {
//                mkdir("./uploads/users/" . $_SESSION['user']['id'] . $item);
//                chmod("./uploads/users/" . $_SESSION['user']['id'] . $item, 0777);
//            }

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
            echo "success";
            return True;
        }

        public function saveUserSettings() {

            $user = $this->db->db->query("SELECT * FROM user WHERE `id` = ". $_SESSION['user']['id']);

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

            $this->db->db->execute("UPDATE user SET `first_name` = '$first_name', `second_name` = '$second_name' WHERE id = " . $_SESSION['user']['id']);

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

                $this->db->db->execute("INSERT INTO `notifications`(`id`, `user_id`, `class`, `body`, `date`, `time`, `is_checked`) VALUES (NULL,'$user_id','$class','$message','$date','$time','0')");

                $this->db->db->execute("UPDATE user SET `password` = '$npass' WHERE id = " . $_SESSION['user']['id']);
                unset($_SESSION['error']['pass_message']);
            }
            header('Location: /');
            return true;
        }

        public function recovery()
        {
            unset($_SESSION['user']);
            $username = $_POST['username'];
            $user = $this->db->db->query("SELECT * FROM `user` WHERE `username` = '$username'");
//            if (count($user) == 1) {
                $title = "Восстановление пароля";
                $this->password = $this->GenerateRandomPassword(12);
                $this->db->db->execute("UPDATE `user` SET `password` = '$this->password' WHERE `username` = '$username'");
                $body = $this->GetRecoveryHtml($user[0]['username'], $this->password);
                $this->SendEmail($title, $body, $user[0]['email']);
                header('Location: /login');
                return true;
//            }
//            header('Location: /');
//            return false;
        }

        public function UserRecovery()
        {
            unset($_SESSION['user']);
            $this->email = $_POST['email'];
            $user = $this->db->getUserByEmail($this->email);
            if (count($user) == 1) {
                $title = "Восстановление пароля";
                $this->password = $this->GenerateRandomPassword(12);
                $this->db->db->execute("UPDATE `user` SET `password` = '$this->password' WHERE email = '$this->email'");
                $body = $this->GetRecoveryHtml($user[0]['email'], $this->password);
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
