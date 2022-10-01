<?php
abstract class ACoreAdmin {

    public $db;

    public function __construct() {
        $this->db = new User();
        if($_GET['option']) {
            $this->get_body(trim(strip_tags($_GET['option'])));
        }
    }

    public function get_body($tpl) {
        $this->get_content();
        include "template/index.php";
    }

    abstract function get_content();
}