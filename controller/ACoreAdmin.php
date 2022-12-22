<?php
abstract class ACoreAdmin {

    protected $m;
    protected $ourEmail = "dimalim110@gmail.com";
    protected $ourPassword = "uyrmpfgzbivwrvdp";
    protected $ourNickName = "course-creator.io";
    protected $email;

    protected function SendEmail ($title, $body) {

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
            $mail->addAddress($this->email);

            $mail->isHTML(true);
            $mail->Subject = $title;
            $mail->Body = $body;

            if ($mail->send()) {$result = "success";}
            else {$result = "allGood";}

        } catch (Exception $e) {
            $result = $mail->ErrorInfo;
            $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
        }
        $_SESSION['status'] = $status;
        echo $result;
    }

    public $db;

    public function __construct() {
        $this->db = new User();
    }

    public function get_body($tpl) {
        $this->get_content();
        include "template/index.php";
    }

    abstract function get_content();
}