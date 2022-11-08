<?php
    if (!class_exists('PHPMailer\PHPMailer\Exception'))
    {
        require './vendor/phpmailer/phpmailer/src/PHPMailer.php';
        require './vendor/phpmailer/phpmailer/src/SMTP.php';
        require './vendor/phpmailer/phpmailer/src/PHPMailer.php';
    }

    class EmailController extends ACore {


        private $ourEmail = "dimalim110@gmail.com";
        private $ourPassword = "pumnwmlvfvxokkcp";
        private $ourNickName = "Wuwpan4ik";

        private $email;
        private $name;
        private $password;
        private $phone;

        public function RequestValidate()
        {
            $this->email = $_POST['email'];
            if (isset($_POST['name'])) {
                $this->name = $_POST['name'];
//                if (!preg_match("/[^(\w)|(\x7F-\xFF)|(\s)]/",$this->name)) {
//                    return false;
//                }
            }

            if (isset($_POST['phone'])) {
                $this->phone = $_POST['phone'];
            }

            if (isset($_POST['password'])) {
                $this->password = $this->GenerateRandomPassword(12);
                if (count($this->m->db->query("SELECT * FROM user WHERE email = '$this->email'")) != 1) {
                    return false;
                }
            } else {
                if (count($this->m->db->query("SELECT * FROM user WHERE email = '$this->email'")) != 0) {
                    return false;
                }
            }

            if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                return false;
            }

            $this->password = $this->GenerateRandomPassword(12);
            return True;
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

        public function ResetPassword() {
            if (!$this->RequestValidate()) return false;
            $title = "Смена пароля";
            $body = "Ваш новый пароль на <a href='http://localhost/login'>Course Creator</a><br>Пароль:$this->password";
            $this->SendEmail($title, $body);
            return true;
        }

        public function RegistrateUser()
        {
            if (!$this->RequestValidate()) return false;
            $title = "Регистрация аккаунта";
            $body = "Ваш аккаунт на <a href='http://localhost/login'>Course Creator</a><br>Почта: $this->email<br>Пароль:$this->password";
            $this->SendEmail($title, $body);
            $avatar = "uploads/ava/1.jpg";

            $this->m->db->execute("INSERT INTO `user` (`email`, `password`, `is_creator`, `avatar`) VALUES ('$this->email', '$this->password', 0, '$avatar')");

            if (isset($this->name)) {
                $this->m->db->execute("INSERT INTO `user` (`first_name`) VALUES ('$this->name') WHERE `email` = '$this->email'");
            }

            if (isset($this->phone)) {
                $this->m->db->execute("INSERT INTO `user` (`telephone`) VALUES ('$this->phone') WHERE `email` = '$this->email'");
            }

            return true;
        }

        public function SendEmail ($title, $body) {

            $mail = new PHPMailer\PHPMailer\PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->CharSet = "UTF-8";
                $mail->SMTPAuth   = true;
                $mail->Debugoutput = function($str, $level) {$GLOBALS['status'][] = $str;};

                // Настройки вашей почты
                $mail->Host       = 'smtp.gmail.com'; // SMTP сервера вашей почты
                $mail->Username   = $this->ourEmail; // Логин на почте
                $mail->Password   = $this->ourPassword; // Пароль на почте
                $mail->SMTPSecure = 'ssl';
                $mail->Port       = 465;
                $mail->setFrom($this->ourEmail, $this->ourNickName); // Адрес самой почты и имя отправителя

                // Получатель письма
                $mail->addAddress($this->email);

                $mail->isHTML(true);
                $mail->Subject = $title;
                $mail->Body = $body;

                if ($mail->send()) {$result = "success";}
                else {$result = "allGood";}

            } catch (Exception $e) {
                $result = "error";
                $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
            }
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
                        window.location.replace("/Analytics");
                    </script>
                </body>
                </html>';
        }

        function obr()
        {
        }
    }