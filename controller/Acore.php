<?php
abstract class ACore {

    protected $m;

    public function __construct() {
        $this->m = new User();
        //Middleware
        if (!isset($_SESSION['user']['id'])) {
            header("Location:?option=Registration");
        }

        if(isset($_GET['option'])) {
            $this->get_body(trim(strip_tags($_GET['option'])));
        } else {
            header("Location:?option=Main");
        }
    }

    public function get_body($tpl) {
        if (!$this->obr() && !is_null($this->obr())) {
            header("Location:?option=Main");
            return False;
        }
        $content = $this->get_content();
        include "template/index.php";
    }
	
    abstract function get_content();

    abstract function obr();

}

?>
