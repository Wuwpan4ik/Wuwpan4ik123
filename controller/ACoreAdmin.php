<?php
abstract class ACoreAdmin {

    use SendEmail;

    protected $user;
    protected $email_class;
    protected $tariff_class;
    protected $notifications_class;
    protected $funnel;
    protected $clients;
    protected $course;


    protected $ourEmail;
    protected $ourPassword;
    protected $ourNickName;
    protected $email;

    public function __construct() {
        $this->user = new User();
        $this->email_class = new Email();
        $this->tariff_class = new Tariff();
        $this->notifications_class = new Notifications();
        $this->funnel = new FunnelModel();
        $this->clients = new ClientsModel();
        $this->course = new CourseModel();

        $email_account = $this->email_class->GetEmailAccount();
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