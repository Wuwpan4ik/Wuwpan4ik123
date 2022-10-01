<?php
abstract class ACore {

    protected $m;

    public function __construct() {
        $this->m = new User();
        if($_GET['option']) {
            $this->get_body(trim(strip_tags($_GET['option'])));
        }
    }

    public function get_body($tpl) {
        $content = $this->get_content();
        include "template/index.php";
    }

    abstract function get_content();

}

?>