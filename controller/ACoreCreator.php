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

        protected $email_class;
        protected $statistic_class;
        protected $tariff_class;
        protected $notifications_class;

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
            $this->email_class = new Email();
            $this->statistic_class = new Statistic();
            $this->tariff_class = new Tariff();
            $this->notifications_class = new Notifications();

            $email_account = $this->email_class->GetEmailAccount();
            $this->ourEmail = $email_account['email'];
            $this->ourPassword = $email_account['password'];
            $this->ourNickName = $email_account['name'];

            $this->url_dir = "./uploads/users/" . $_SESSION['user']['id'] . '/';
        }

        public function CheckTariff()
        {
            return $this->tariff_class->Get();
        }

        public function obr() {
            if (isset($_SESSION['user']['is_creator']) && $_SESSION['user']['is_creator'] == 0) {
                header("Location: /UserMain");
            } else if (!isset($_SESSION['user']) || is_null($_SESSION['user'])) {
                header("Location: /login");
            }
        }
    }