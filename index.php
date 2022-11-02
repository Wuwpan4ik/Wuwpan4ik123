<?php
    session_start();
    header("Content-Type:text/html;charset=UTF-8");
    require_once 'vendor/autoload.php';
    require_once 'model/Routering.php';
    $url = key($_GET);
    $router = new Router();

    $router->addRoute("/", "Main.php");
    $router->addRoute("/reg", "Registration.php");
    $router->addRoute("/login", "Login.php");
    $router->addRoute("/LoginController/login", "LoginController.php", 'login');
    $router->addRoute("/LoginController/logout", "LoginController.php", 'logout');


    $router->route("/$url");

?>