<?php
    abstract class ACoreCreator {

        protected $m;
        protected $ourEmail = "dimalim110@gmail.com";
        protected $ourPassword = "pumnwmlvfvxokkcp";
        protected $ourNickName = "Wuwpan4ik";
        protected $email;

        protected $url_dir;

        public function __construct() {
            date_default_timezone_set('Europe/Moscow');
            $this->m = new User();
            $this->url_dir = "./uploads/users/" . $_SESSION['user']['id'] . '/';
        }

        public function obr() {
            if (isset($_SESSION['user']['is_creator']) && $_SESSION['user']['is_creator'] == 0) {
                header("Location: /UserMain");
            } else if (!isset($_SESSION['user']['id'])) {
                header("Location: /reg");
            }
        }

        public function addNotifications($class, $message, $image, $user_id = null) {
            if (is_null($user_id)) $user_id = $_SESSION['user']['id'];
            $date = date("Y-m-d");
            $time = date("H:i:s");
            return $this->m->db->execute("INSERT INTO `notifications` (`user_id`, `class`, `body`, `image`, `date`, `time`, `is_checked`) VALUES ('$user_id', '$class', '$message', '$image', '$date', '$time', 0)");
        }

        protected function dir_size($path) {
            $path = ($path . '/');
            $size = 0;
            $dir = opendir($path);
            if (!$dir) {
                return 0;
            }

            while (false !== ($file = readdir($dir))) {
                if ($file == '.' || $file == '..') {
                    continue;
                } elseif (is_dir($path . $file)) {
                    $size += $this->dir_size($path . '//' . $file);
                } else {
                    $size += filesize($path . '//' . $file);
                }
            }
            closedir($dir);
            return $size;
        }

        public function SendEmail ($title, $body, $email, $file = null, $file_name = null) {

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

                $mail->isHTML(true);
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