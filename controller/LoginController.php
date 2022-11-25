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

        public function login () {
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
                    $response = "С возвращением, " . $_SESSION["user"]["name"];
                } else {
                    $_SESSION["user"] = [
                        'id' => $res[0]['id'],
                        'niche' => $res[0]['niche'],
                        'avatar' => $res[0]['avatar'],
                        'first_name' => $res[0]['first_name'],
                        'second_name' => $res[0]['second_name'],
                        'email' => $res[0]['email'],
                        'site_url' => $res[0]['site_url'],
                        'is_creator' => 1
                    ];
                    $response = "С возвращением, " . $_SESSION["user"]["name"];
                    $this->get_content();
                }
            } else {
                $response = "Неверный логин или пароль";
            }
            return True;
        }

        public function registration () {
            $first_name = $_POST['first_name'];

            $second_name = $_POST['second_name'];

            $niche = $_POST['niche'];

            $email = $_POST['email'];

            $password = $_POST['pass'];

            $ava = "uploads/ava/" . $email. "_" .$_FILES['avatar']['name'];

            move_uploaded_file($_FILES['avatar']['tmp_name'], "./".$ava);

            if(!$_FILES['avatar']['name']){
                $ava = "uploads/ava/1.jpg";
            }

            $res = $this->db->db->query("SELECT * FROM user WHERE email = '$email'");
            if(count($res) != 0){
                $_SESSION['error']['registration_message'] = "На этот адрес электронной почты уже был зарегистрирован аккаунт";
                return false;
            }

            $this->validate_data($email, $first_name);
            if (isset($_SESSION['email_message']) || isset($_SESSION['first_name_message'])) return False;

            $this->db->db->execute("INSERT INTO `user` (`niche`, `avatar`, `first_name`, `second_name`, `email`, `password`, `is_creator`) VALUES ('$niche', '$ava', '$first_name', '$second_name', '$email', '$password', 1)");
            $_SESSION['error']['registration_message'] = "Регистрация прошла успешно";
            $res = $this->db->db->query("SELECT * FROM user WHERE email = '$email' AND password = '$password'");
            if(count($res) != 0) {
                if ($res[0]['is_creator'] == 0) {
                    $_SESSION["user"] = [
                        'id' => $res[0]['id'],
                        'email' => $res[0]['email'],
                        'avatar' => $res[0]['avatar'],
                        'is_creator' => 0
                    ];
                    $response = "С возвращением, " . $_SESSION["user"]["name"];
                } else {
                    $_SESSION["user"] = [
                        'id' => $res[0]['id'],
                        'niche' => $res[0]['niche'],
                        'avatar' => $res[0]['avatar'],
                        'first_name' => $res[0]['first_name'],
                        'second_name' => $res[0]['second_name'],
                        'email' => $res[0]['email'],
                        'site_url' => $res[0]['site_url'],
                        'is_creator' => 1
                    ];
                    $response = "С возвращением, " . $_SESSION["user"]["name"];
                }
            } else {
                $response = "Неверный логин или пароль";
            }
            mkdir("./uploads/users/" . $_SESSION['user']['id']);
            mkdir("./uploads/users/". $_SESSION['user']['id'] . "/funnels");
            mkdir("./uploads/users/". $_SESSION['user']['id'] . "/courses");
            mkdir("./uploads/users/". $_SESSION['user']['id'] . "/files");
            mkdir("./uploads/users/". $_SESSION['user']['id'] . "/thumbnails");
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
            return true;
        }

        public function recovery()
        {
            $this->email = $_POST['email'];
            if (count($this->db->getUserByEmail($this->email)) == 1) {
                $title = "Восстановление пароля";
                $this->password = $this->GenerateRandomPassword(12);
                $this->db->db->execute("UPDATE `user` SET `password` = '$this->password' WHERE email = '$this->email'");
                $body = "Вы сменили пароль на сайте <a href=\"/login\">Course Creator</a><br>Новый пароль: $this->password";
                $this->SendEmail($title, $body);
                return true;
            }
            return false;
        }


        public function logout() {
            unset($_SESSION['user']);
        }

        function get_content()
        {
            echo '<!DOCTYPE html>
			<html lang="en">
			<head>
			<meta charset="UTF-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<title>Document</title>
			</head>
			<body>
				<script>
					window.location.replace("/Account");
				</script>
			</body>
			</html>';
        }
    }
