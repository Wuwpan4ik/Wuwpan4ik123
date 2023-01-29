<?php
abstract class ACoreAdmin {

    use SendEmail;

    public $db;
    protected $m;
    protected $ourEmail;
    protected $ourPassword;
    protected $ourNickName;
    protected $email;

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