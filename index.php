<?php
    session_start();
    header("Content-Type:text/html;charset=UTF-8");
    require_once 'vendor/autoload.php';
    require_once 'model/Routering.php';
    $item_id = 0;
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
    $router->addRoute("/recovery", "PasswordRecovery.php");


    $router->addRoute("/Analytics", "Analytics.php");
    $router->addRoute("/ConfirmEmail", "ConfirmEmail.php");
    $router->addRoute("/PasswordRecovery", "PasswordRecovery.php");
    $router->addRoute("/Cases", "Cases.php");
    $router->addRoute("/SmallPlayer/$item_id", "SmallPlayer.php");
    $router->addRoute("/Account", "Account.php");
    $router->addRoute("/Account/MainSettings", "AccountController.php", "SaveSettings");
    $router->addRoute("/Account/UserSettings", "AccountController.php", "SaveUserSettings");
    $router->addRoute("/Account/SaveSchoolSettings", "AccountController.php", "SaveSchoolSettings");


    $router->addRoute("/UserMain", "UserMain.php");
    $router->addRoute("/UserLogin", "UserLogin.php");
    $router->addRoute("/UserRecovery", "UserPasswordRecovery.php");
    $router->addRoute("/UserNotifications", "UserNotifications.php");
    $router->addRoute("/UserContacts", "UserContacts.php");
    $router->addRoute("/UserMenu", "UserMenu.php");
    $router->addRoute("/UserPlayer/$item_id", "UserPlayer.php");
    $router->addRoute("/AboutTheAuthor/$item_id", "AboutTheAuthor.php");
    $router->addRoute("/UserAccount", "SettingsAccountUser.php");
    $router->addRoute("/Project", "Project.php");

    $router->addRoute("/Article", "Article.php");


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
    $router->addRoute("/LoginController/reg", "LoginController.php", 'registration');
    $router->addRoute("/LoginController/recovery", "LoginController.php", 'recovery');
    $router->addRoute("/LoginController/logout", "LoginController.php", 'logout');

    $router->addRoute("/send-email", "EmailController.php", 'RegistrateUser');
    $router->addRoute("/ClientsController/application", "ClientsController.php", 'AddApplication');
    $router->addRoute("/ClientsController/CourseBuy", "ClientsController.php", 'BuyCourse');
    $router->addRoute("/ClientsController/CourseVideo", "ClientsController.php", 'BuyVideo');
    $router->addRoute("/ClientsController/$item_id/delete", "ClientsController.php", 'Delete');
    $router->addRoute("/PopupController/get_popup", "PopupController.php", 'get_popup');

    $router->addRoute("/StatisticsController/GetStatistics", "StatisticsController.php", 'GetAllStatistics');
    $router->addRoute("/StatisticsController/GetWeek", "StatisticsController.php", 'GetWeekGraph');
    $router->addRoute("/StatisticsController/GetWeek", "StatisticsController.php", 'GetWeekGraph');

    $router->addRoute("/UserController/getCourse", "UserController.php", 'getCourseSite');
    $router->addRoute("/UserController/getDisableCourse", "UserController.php", 'getDisableCourseSite');
    $router->addRoute("/UserController/getList", "UserController.php", 'getList');
    $router->addRoute("/UserController/getBuyCourse", "UserController.php", 'getBuyCourse');
    $router->addRoute("/UserController/getCoursePrice", "UserController.php", 'getCoursePrice');
    $router->addRoute("/UserController/getVideoInfo", "UserController.php", 'getBuyVideo');
    $router->addRoute("/UserController/save", "LoginController.php", 'saveUserSettings');

    $router->addRoute("/addQuestion", "ContactController.php", "SendQuestion");
    $router->addRoute("/getNotifications", "NotificationsController.php", "getNotifications");
    $router->addRoute("/NotificationsController/checkout", "NotificationsController.php", "checkNotifications");


    $router->route("/$url");

?>