<?php
    class LoginController extends ACoreAdmin {
        private function validate_data ($email, $name) {
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error']['email_message'] = 'Неверный email';
            }
            if ((int)$this->m->db->query("SELECT count(*) FROM user WHERE email = " . $_POST[email]) > 0) {
                $_SESSION['error']['email_message'] = 'Почта либо занята, либо это ваша';
            }
            if (preg_match("/[^(\w)|(\x7F-\xFF)|(\s)]/",$_POST['name'])) {
                $_SESSION['error']['name_message'] = 'Имя содержит запрещенные знаки';
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
                    'status' => $res[0]['status'],
                    'avatar' => $res[0]['avatar'],
                    'name' => $res[0]['name'],
                    'subname' => $res[0]['subname'],
                    'email' => $res[0]['email'],
                    'role' => $res[0]['role'],
                    'sub_id' => $res[0]['subscription_id'],
                    'course_id' => $res[0]['course_id'],
                    'site_url' => $res[0]['site_url']
                ];
                $response = "С возвращением, ".$_SESSION["user"]["name"];
            }
            else {
                $response = "Неверный логин или пароль";
            }
        }

        public function registration () {
            $name = $_POST['name'];

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
                $response = "На этот адрес электронной почты уже был зарегистрирован аккаунт";
            }

            $this->validate_data($email, $name);
            if (isset($_SESSION['email_message']) || isset($_SESSION['name_message'])) return False;

            else {

                $this->db->db->execute("INSERT INTO `user` (`id`, `gender`, `niche`, `status`, `avatar`, `name`, `email`, `password`, `role`, `subscription_id`, `course_id`) VALUES (NULL, '$gender', '$niche', '', '$ava', '$name', '$email', '$password', '', '0', '0')");
                $response = "Регистрация прошла успешно";
            }
            $_SESSION['message'] = $response;
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
					window.location.replace("?option=Main");
				</script>
			</body>
			</html>';
        }
    }
