<?php
abstract class ACoreAdmin {

    public $db;
    protected $m;
    protected $ourEmail;
    protected $ourPassword;
    protected $ourNickName;
    protected $email;

    protected function SendEmail ($title, $body, $email)
    {

        $mail = new PHPMailer\PHPMailer\PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->CharSet = "UTF-8";
            $mail->SMTPAuth = true;
            $mail->Debugoutput = function ($str, $level) {
                $GLOBALS['status'][] = $str;
            };

            // Настройки вашей почты
            $mail->Host = 'smtp.yandex.ru'; // SMTP сервера вашей почты
            $mail->Username = $this->ourEmail; // Логин на почте
            $mail->Password = $this->ourPassword; // Пароль на почте
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
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

            if ($mail->send()) {
                $result = "success";
            } else {
                $result = "allGood";
            }

        } catch (Exception $e) {
            $result = $mail->ErrorInfo;
            $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
        }
        $_SESSION['status'] = $status;
        echo $result;
    }

    public function __construct() {
        $this->db = new User();
        $email_account = $this->db->GetEmailAccount();
        $this->ourEmail = $email_account['email'];
        $this->ourPassword = $email_account['password'];
        $this->ourNickName = $email_account['name'];
    }

    public function get_body($tpl) {
        $this->get_content();
        include "template/index.php";
    }

    abstract function get_content();
}