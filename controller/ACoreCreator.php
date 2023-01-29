<?php
    if (!class_exists('PHPMailer\PHPMailer\Exception'))
    {
        require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
        require '../vendor/phpmailer/phpmailer/src/SMTP.php';
        require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
    }

    abstract class ACoreCreator {

        use addNotifications;
        use SendEmail;

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

        public function CheckTariff()
        {
            return $this->m->db->query("SELECT users_tariff.tariff_id, tariffs.funnel_count, tariffs.course_count, tariffs.file_size, tariffs.children_count FROM `users_tariff` INNER JOIN `tariffs` ON tariffs.id = users_tariff.tariff_id WHERE users_tariff.user_id = {$_SESSION['user']['id']}");
        }

        public function obr() {
            if (isset($_SESSION['user']['is_creator']) && $_SESSION['user']['is_creator'] == 0) {
                header("Location: /UserMain");
            } else if (!isset($_SESSION['user']) || is_null($_SESSION['user'])) {
                header("Location: /login");
            }
        }
    }