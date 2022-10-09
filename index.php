<?php
    session_start();
    header("Content-Type:text/html;charset=UTF-8");
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