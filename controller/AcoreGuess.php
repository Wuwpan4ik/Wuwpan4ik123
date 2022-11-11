<?php

abstract class ACoreGuess
{
    protected $m;

    public function __construct() {
        date_default_timezone_set('Europe/Moscow');
        $this->m = new User();
    }

    public function obr() {
        if ($_SESSION['user']['is_creator'] == 1) {
            header("Location: /");
        } else if (!isset($_SESSION['user']['id'])) {
            header("Location: /UserLogin");
        }
    }
}