<?php
    session_start();
    header("Content-Type:text/html;charset=UTF-8");

    spl_autoload_register(function($class) {
        if(file_exists("controller/$class.php")) {
            require_once "controller/$class.php";
        }
        if(file_exists("pages/$class.php")) {
            require_once "pages/$class.php";
        }
        if (file_exists("model/$class.php")) {
            require_once "model/$class.php";
        }
    });
    require_once 'vendor/autoload.php';

    if(isset($_GET['option'])) {
        $class = trim(strip_tags($_GET['option']));
        if(isset($_GET['method'])) {
            $method = trim(strip_tags($_GET['method']));
        }
    }
    else {
        $class = 'Main';
    }


    if(class_exists($class)) {

        $obj = new $class;
        if (isset($method)) {
            if (method_exists($obj, $method)) {
                $obj->$method();
            }
        }

    }
    else {
        exit("<p>Нет данных для входа</p>");
    }

?>