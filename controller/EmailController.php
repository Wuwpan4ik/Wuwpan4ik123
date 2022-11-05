<?php
    require '../model/phpmailer/Exception.php';
    require '../model/phpmailer/SMTP.php';
    require '../model/phpmailer/PHPMailer.php';

    class EmailController extends ACore {

        private $email;
        private $name;
        private $password;
        private $ourEmail = "dimalim110@gmail.com";

        public function RequestValidate()
        {
            $this->email = $_POST['email'];
            if (isset($_POST['name'])) {
                $this->name = $_POST['name'];
                if (!preg_match("/[^(\w)|(\x7F-\xFF)|(\s)]/",$this->name)) {
                    return false;
                }
            }
            if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                return false;
            }

            if (count($this->m->db->query("SELECT * FROM user WHERE email = '$this->email'")) != 0) {
                return false;
            }

            $this->password = $this->GenerateRandomPassword(12);
            $this->SendEmail();
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

        public function SendEmail () {

//            !$this->RequestValidate();
            $this->password = $this->GenerateRandomPassword(9);

            $title = "Заголовок письма";
            $body = "
                <h2>Новое письмо</h2>
                <b>Имя:</b> $this->name<br>
                <b>Почта:</b> $this->email<br><br>
                <b>Сообщение:</b><br>Текст
            ";
            echo $title;

//            $mail = new PHPMailer\PHPMailer\PHPMailer();
//
//            try {
//                $mail->isSMTP();
//                $mail->CharSet = "UTF-8";
//                $mail->SMTPAuth   = true;
//                $mail->SMTPDebug = 2;
//                $mail->Debugoutput = function($str, $level) {$GLOBALS['status'][] = $str;};
//
//                // Настройки вашей почты
//                $mail->Host       = 'smtp.gmail.com'; // SMTP сервера вашей почты
//                $mail->Username   = 'Wuwpan4ik'; // Логин на почте
//                $mail->Password   = 'zloybambr2014B2014'; // Пароль на почте
//                $mail->SMTPSecure = 'ssl';
//                $mail->Port       = 465;
//                $mail->setFrom('dimalim110@gmail.com', 'Дмитрий Викторович'); // Адрес самой почты и имя отправителя
//
//                // Получатель письма
//                $mail->addAddress('dimalim110@gmail.com');
//
//                $mail->isHTML(true);
//                $mail->Subject = $title;
//                $mail->Body = $body;
//
//                if ($mail->send()) {$result = "success";}
//                else {$result = "error";}
//
//            } catch (Exception $e) {
//                $result = "error";
//                $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
//            }
//            return true;

        }

        function get_content()
        {
//            echo '<!DOCTYPE html>
//                <html lang="en">
//                <head>
//                <meta charset="UTF-8">
//                <meta http-equiv="X-UA-Compatible" content="IE=edge">
//                <meta name="viewport" content="width=device-width, initial-scale=1.0">
//                <title>Document</title>
//                </head>
//                <body>
//                    <script>
//                        window.location.replace("/Analytics");
//                    </script>
//                </body>
//                </html>';
        }

        function obr()
        {
        }
    }