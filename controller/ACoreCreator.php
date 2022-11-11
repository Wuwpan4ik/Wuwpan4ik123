<?php
    abstract class ACoreCreator {

        protected $m;

        public function __construct() {
            date_default_timezone_set('Europe/Moscow');
            $this->m = new User();
            if (!isset($_SESSION['user']['id'])) {
                header("Location: reg");
            }
        }

        public function obr() {
            if ($_SESSION['user']['is_creator'] == 0) {
                header("Location: /UserMain");
            }
        }
    }