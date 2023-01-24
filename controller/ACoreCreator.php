<?php
if (!class_exists('PHPMailer\PHPMailer\Exception'))
{
    require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
    require '../vendor/phpmailer/phpmailer/src/SMTP.php';
    require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
}

    abstract class  ACoreCreator {

        protected $m;
        protected $ourEmail;
        protected $ourPassword;
        protected $ourNickName;
        protected $email;
        protected $date;

        protected $url_dir;

        public function __construct() {
            date_default_timezone_set('Europe/Moscow');
            $this->date = date("Y-m-d");
            $this->m = new User();

            $email_account = $this->m->GetEmailAccount();
            $this->ourEmail = $email_account['email'];
            $this->ourPassword = $email_account['password'];
            $this->ourNickName = $email_account['name'];

            $this->url_dir = "./uploads/users/" . $_SESSION['user']['id'] . '/';
        }

        public function obr() {
            if (isset($_SESSION['user']['is_creator']) && $_SESSION['user']['is_creator'] == 0) {
                header("Location: /UserMain");
            } else if (!isset($_SESSION['user']) || is_null($_SESSION['user'])) {
                header("Location: /login");
            }
        }

        public function addNotifications($class, $message, $image, $user_id = null) {
            if (is_null($user_id)) $user_id = $_SESSION['user']['id'];
            $date = date("Y-m-d");
            $time = date("H:i:s");
            return $this->m->db->execute("INSERT INTO `notifications` (`user_id`, `class`, `body`, `image`, `date`, `time`, `is_checked`) VALUES ('$user_id', '$class', '$message', '$image', '$date', '$time', 0)");
        }

        public function CheckTariff()
        {
            return $this->m->db->query("SELECT users_tariff.tariff_id, tariffs.funnel_count, tariffs.course_count, tariffs.file_size, tariffs.children_count FROM `users_tariff` INNER JOIN `tariffs` ON tariffs.id = users_tariff.tariff_id WHERE users_tariff.user_id = {$_SESSION['user']['id']}");
        }


        public function SendEmail ($title, $body, $email, $file = null, $file_name = null) {

            $mail = new PHPMailer\PHPMailer\PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->CharSet = "UTF-8";
                $mail->SMTPAuth   = true;
                $mail->Debugoutput = function($str, $level) {$GLOBALS['status'][] = $str;};

                // Настройки вашей почты
                $mail->Host       = 'smtp.yandex.ru'; // SMTP сервера вашей почты
                $mail->Username   = $this->ourEmail; // Логин на почте
                $mail->Password   = $this->ourPassword; // Пароль на почте
                $mail->SMTPSecure = 'ssl';
                $mail->Port       = 465;
                $mail->smtpConnect(
                    array(
                        "ssl" => array(
                            "verify_peer" => false,
                            "verify_peer_name" => false,
                            "allow_self_signed" => true
                        )
                    )
                );
                $mail->setFrom($this->ourEmail, $this->ourNickName); // Адрес самой почты и имя отправителя

                // Получатель письма
                $mail->addAddress($email);

                $mail->isHTML();
                $mail->Subject = $title;
                $mail->Body = $body;
                if (!is_null($file)) {
                    $mail->addAttachment($file, $file_name);
                }

                if ($mail->send()) {$result = "success";}
                else {$result = "allGood";}

            } catch (Exception $e) {
                $result = $mail->ErrorInfo;
                $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
            }
            echo $result;
        }
    }