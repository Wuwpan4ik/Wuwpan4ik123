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

        public function login () {
            $email = $_POST['email'];
            $password = $_POST['pass'];

            $res = $this->db->db->query("SELECT * FROM user WHERE email = '$email' AND password = '$password'");

            if(count($res) != 0){
                $_SESSION["user"] = [
                    'id' => $res[0]['id'],
                    'gender' => $res[0]['gender'],
                    'niche' => $res[0]['niche'],
                    'avatar' => $res[0]['avatar'],
                    'first_name' => $res[0]['first_name'], // поменял name - first_name
                    'second_name' => $res[0]['second_name'], // добавить в форму - first_name
                    'email' => $res[0]['email'],
                    'site_url' => $res[0]['site_url']
                ];
                $response = "С возвращением, ".$_SESSION["user"]["name"];
            }
            else {
                $response = "Неверный логин или пароль";
            }
            $_SESSION['message'] = $response;
        }

        public function registration () {
            $first_name = $_POST['first_name'];

            $gender = $_POST['gender'];

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

            else {
                $this->db->db->execute("INSERT INTO `user` (`gender`, `niche`, `avatar`, `first_name`, `email`, `password`) VALUES ('$gender', '$niche', '$ava', '$first_name', '$email', '$password')");
                $_SESSION['error']['registration_message'] = "Регистрация прошла успешно";
            }
            return true;
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
					window.location.replace("/");
				</script>
			</body>
			</html>';
        }
    }
