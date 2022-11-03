<?php
abstract class ACore {

    protected $m;

    public function __construct() {
        $this->m = new User();
        //Middleware
        if (!isset($_SESSION['user']['id'])) {
            header("Location: reg");
        }
    }

    abstract function get_content();

    abstract function obr();

}
