<?php
abstract class ACoreGuess
{
    use addNotifications;
    protected $user;
    protected $user_contacts;
    protected $user_class;
    protected $notifications;
    protected $course_content;

    public function __construct() {
        date_default_timezone_set('Europe/Moscow');
        $this->user = new User();
        $this->user_contacts = new UserContactsModel();
        $this->user_class = new UserModel();
        $this->notifications = new Notifications();
        $this->course_content = new CourseContentModel();
    }

    public function obr() {
        if (isset($_SESSION['user']['is_creator']) && $_SESSION['user']['is_creator'] == 1) {
            header("Location: /");
        } else if (!isset($_SESSION['user']['id'])) {
            header("Location: /UserLogin");
        }
    }
}