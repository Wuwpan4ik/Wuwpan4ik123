<?php
abstract class ACoreGuess
{
    use addNotifications;
    protected $m;

    public function __construct() {
        date_default_timezone_set('Europe/Moscow');
        $this->m = new User();
    }

    public function obr() {
        if (isset($_SESSION['user']['is_creator']) && $_SESSION['user']['is_creator'] == 1) {
            header("Location: /");
        } else if (!isset($_SESSION['user']['id'])) {
            header("Location: /UserLogin");
        }
    }
}