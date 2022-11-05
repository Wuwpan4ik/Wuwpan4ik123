<?php
    session_start();
    header("Content-Type:text/html;charset=UTF-8");
    require_once 'vendor/autoload.php';
    require_once 'model/Routering.php';
    $url = key($_GET);
    $url_array = explode('/', $url);

    if (count($url_array) >= 2) {
        $item_id = $url_array[1];
        $_SESSION['item_id'] = $item_id;
    }

    $router = new Router();

    $router->addRoute("/", "Main.php");
    $router->addRoute("/reg", "Registration.php");
    $router->addRoute("/login", "Login.php");
    $router->addRoute("/Analytics", "Analytics.php");
    $router->addRoute("/Account", "Account.php");
    $router->addRoute("/Cases", "Cases.php");
    $router->addRoute("/SmallPlayer/$item_id", "SmallPlayer.php");

    $router->addRoute("/Project", "Project.php");

    $router->addRoute("/Course", "Course.php");
    $router->addRoute("/Course/$item_id", "CourseEdit.php");
    $router->addRoute("/Course/create", "CourseController.php", "CreateCourse");
    $router->addRoute("/Course-rename/$item_id", "CourseController.php", "RenameCourse");
    $router->addRoute("/Course-delete/$item_id", "CourseController.php", "DeleteCourse");
    $router->addRoute("/Course/$item_id/create", "CourseController.php", "AddVideo");
    $router->addRoute("/Course/$item_id/delete", "CourseController.php", "DeleteVideo");
    $router->addRoute("/Course/$item_id/rename", "CourseController.php", "RenameVideo");

    $router->addRoute("/Funnel", "Funnel.php");
    $router->addRoute("/Funnel/$item_id", "FunnelEdit.php");
    $router->addRoute("/Funnel/create", "FunnelController.php", "CreateFunnel");
    $router->addRoute("/Funnel-rename/$item_id", "FunnelController.php", "RenameFunnel");
    $router->addRoute("/Funnel-delete/$item_id", "FunnelController.php", "DeleteFunnel");
    $router->addRoute("/Funnel-select/$item_id", "FunnelController.php", "SelectCourse");
    $router->addRoute("/Funnel/$item_id/create", "FunnelController.php", "AddVideo");
    $router->addRoute("/Funnel/$item_id/delete", "FunnelController.php", "DeleteVideo");
    $router->addRoute("/Funnel/$item_id/rename", "FunnelController.php", "RenameVideo");
    $router->addRoute("/Funnel/$item_id/settings", "FunnelController.php", "PopupSettings");

    $router->addRoute("/SortController/Clients", "SortController.php", "getClientsForMain");
    $router->addRoute("/SortController/AnalyticClients", "SortController.php", "getClientsForAnalytics");
    $router->addRoute("/LoginController/login", "LoginController.php", 'login');
    $router->addRoute("/LoginController/logout", "LoginController.php", 'logout');

    $router->addRoute("/send-email", "EmailController.php", 'RegistrateUser');
    $router->addRoute("/create-client", "ClientsController.php", 'Create');


    $router->route("/$url");

?>