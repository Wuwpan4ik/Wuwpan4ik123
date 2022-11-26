<?php
    if (!class_exists('PHPMailer\PHPMailer\Exception'))
    {
        require '/vendor/phpmailer/phpmailer/src/PHPMailer.php';
        require '/vendor/phpmailer/phpmailer/src/SMTP.php';
        require '/vendor/phpmailer/phpmailer/src/PHPMailer.php';
    }

    class EmailController extends ACoreCreator {


        private $ourEmail = "dimalim110@gmail.com";
        private $ourPassword = "pumnwmlvfvxokkcp";
        private $ourNickName = "Wuwpan4ik";

//        public function SendEmail ($title, $body) {
//
//            $mail = new PHPMailer\PHPMailer\PHPMailer(true);
//
//            try {
//                $mail->isSMTP();
//                $mail->CharSet = "UTF-8";
//                $mail->SMTPAuth   = true;
//                $mail->Debugoutput = function($str, $level) {$GLOBALS['status'][] = $str;};
//
//                // Настройки вашей почты
//                $mail->Host       = 'smtp.gmail.com'; // SMTP сервера вашей почты
//                $mail->Username   = $this->ourEmail; // Логин на почте
//                $mail->Password   = $this->ourPassword; // Пароль на почте
//                $mail->SMTPSecure = 'ssl';
//                $mail->Port       = 465;
//                $mail->smtpConnect(
//                    array(
//                        "ssl" => array(
//                            "verify_peer" => false,
//                            "verify_peer_name" => false,
//                            "allow_self_signed" => true
//                        )
//                    )
//                );
//                $mail->setFrom($this->ourEmail, $this->ourNickName); // Адрес самой почты и имя отправителя
//
//                // Получатель письма
//                $mail->addAddress($this->email);
//
//                $mail->isHTML(true);
//                $mail->Subject = $title;
//                $mail->Body = $body;
//
//                if ($mail->send()) {$result = "success";}
//                else {$result = "allGood";}
//
//            } catch (Exception $e) {
//                $result = "error";
//                $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
//            }
//            echo $result;
//        }

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