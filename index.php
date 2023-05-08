<?php
    header("Content-Type:text/html;charset=UTF-8");
    session_start();
    require_once './vendor/autoload.php';
    require_once './connect/Routering.php';
    $item_id = 0;
    $url = key($_GET);
    $url_array = explode('/', $url);

    $router = new Router();

    if (str_contains($url, 'SmallPlayer')) {
        $_SESSION['item_id'] = $url_array[1];
//        $user = count((new User())->db->query("SELECT * FROM user WHERE username = '" . $url_array[0] . "' AND is_creator = '1'"));
//        if ($user == 1) {
//            echo 1;
            $url_local = "/SmallPlayer/" . $url_array[1];
            $router->addRoute("$url_local", "SmallPlayer.php");
//        }
    } else {
        if (count($url_array) >= 2) {
            $item_id = $url_array[1];
            $_SESSION['item_id'] = $item_id;
        }
    }
	
    $router->addRoute("/", "Main.php");
    $router->addRoute("/reg", "Registration.php");
    $router->addRoute("/login", "Login.php");
    $router->addRoute("/recovery", "PasswordRecovery.php");
    $router->addRoute("/ConfirmEmail", "ConfirmEmail.php");
    $router->addRoute("/PasswordRecovery", "PasswordRecovery.php");

    $router->addRoute("/Mailings", "Mailings.php");
    $router->addRoute("/OneTimeMailings", "OneTimeMailings.php");
    $router->addRoute("/NewMailing/$item_id", "NewMailing.php");
    $router->addRoute("/NewMailing", "NewMailing.php");
    $router->addRoute("/NewMailing/create", "MailingController.php", "CreateAndEdit");
    $router->addRoute("/mailing-delete/$item_id", "MailingController.php", "Delete");


    $router->addRoute("/Analytics", "Analytics.php");
    $router->addRoute("/Orders", "Orders.php");

    $router->addRoute("/Cases", "Cases.php");
    $router->addRoute("/Account", "Account.php");
    $router->addRoute("/Account/SocialUrls", "AccountController.php", "TakeSocialUrls", false);
    $router->addRoute("/Account/MainSettings", "AccountController.php", "SaveSettings");
    $router->addRoute("/Account/UserSettings", "AccountController.php", "SaveUserSettings");
    $router->addRoute("/Account/SaveSchoolSettings", "AccountController.php", "SaveSchoolSettings");
    $router->addRoute("/Account/SaveSocialSettings", "AccountController.php", "SaveSocialSettings");
    $router->addRoute("/Account/SaveIntegrationsSettings", "AccountController.php", "SaveIntegrationsSettings");
    $router->addRoute("/AccountController/AddAdditionally", "AccountController.php", "AddAdditionally");

    $router->addRoute("/UserMain", "UserMain.php");
    $router->addRoute("/UserLogin", "UserLogin.php");
    $router->addRoute("/LoginController/UserLogin", "LoginController.php", "UserLogin");
    $router->addRoute("/UserRecovery", "UserPasswordRecovery.php");
    $router->addRoute("/UserNotifications", "UserNotifications.php");
    $router->addRoute("/UserContacts/$item_id", "UserContacts.php");
    $router->addRoute("/UserMenu", "UserMenu.php");
    $router->addRoute("/UserPlayer/$item_id", "UserPlayer.php");
    $router->addRoute("/AboutTheAuthor/$item_id", "AboutTheAuthor.php");
    $router->addRoute("/UserAccount", "SettingsAccountUser.php");
    $router->addRoute('/UserAllContacts', 'UserAllContacts.php');
    $router->addRoute("/Project", "Project.php");

    $router->addRoute("/Article/$item_id", "Article.php");

    $router->addRoute("/Course", "Course.php");
    $router->addRoute("/Course/$item_id", "CourseEdit.php");
    $router->addRoute("/Course/create", "CourseController.php", "CreateCourse", false);
    $router->addRoute("/Course-rename/$item_id", "CourseController.php", "RenameCourse");
    $router->addRoute("/Course-delete/$item_id", "CourseController.php", "DeleteCourse");
    $router->addRoute("/Course/$item_id/create", "CourseController.php", "AddVideo");
    $router->addRoute("/Course/$item_id/delete", "CourseController.php", "DeleteVideo");
    $router->addRoute("/Course/$item_id/rename", "CourseController.php", "RenameVideo");
    $router->addRoute("/Course/$item_id/change", "CourseController.php", "ChangeVideo");
    $router->addRoute("/Course/$item_id/setPrice", "CourseController.php", "SetPrice");
    $router->addRoute("/Course/$item_id/AddView", "CourseController.php", "AddView");

    $router->addRoute("/Funnel", "Funnel.php");
    $router->addRoute("/Funnel/$item_id", "FunnelEdit.php");
    $router->addRoute("/Funnel/create", "FunnelController.php", "CreateFunnel", false);
    $router->addRoute("/Funnel-rename/$item_id", "FunnelController.php", "RenameFunnel");
    $router->addRoute("/Funnel-delete/$item_id", "FunnelController.php", "DeleteFunnel");
    $router->addRoute("/Funnel-select/$item_id", "FunnelController.php", "SelectCourse");
    $router->addRoute("/Funnel/$item_id/create", "FunnelController.php", "AddVideo");
    $router->addRoute("/Funnel/$item_id/delete", "FunnelController.php", "DeleteVideo");
    $router->addRoute("/Funnel/$item_id/rename", "FunnelController.php", "RenameVideo");
    $router->addRoute("/Funnel/$item_id/change", "FunnelController.php", "ChangeVideo");
    $router->addRoute("/Funnel/$item_id/settings", "FunnelController.php", "PopupSettings");
    $router->addRoute("/Funnel/$item_id/main_settings", "FunnelController.php", "MainSettings");
    $router->addRoute("/Funnel/$item_id/GetMainSettings", "FunnelController.php", "GetMainSettings");
    $router->addRoute("/Funnel/$item_id/AddView", "FunnelController.php", "AddView");
    $router->addRoute("/Funnel/$item_id/checkSettings", "CheckFunnelSettingsController.php", "CheckPopupSettings", false);
    $router->addRoute("/Funnel/$item_id/checkMainSettings", "CheckFunnelSettingsController.php", "CheckMainSettings", false);
    $router->addRoute("/Funnel/$item_id/getFunnelPopup", "UserController.php", "GetFunnelPopup");

    $router->addRoute("/LoginController/login", "LoginController.php", 'login');
    $router->addRoute("/LoginController/reg", "LoginController.php", 'registration');
    $router->addRoute("/LoginController/recovery", "LoginController.php", 'recovery');
    $router->addRoute("/LoginController/UserRecovery", "LoginController.php", 'UserRecovery');
    $router->addRoute("/LoginController/logout", "LoginController.php", 'logout');

    $router->addRoute("/ClientsController/application", "ClientsController.php", 'AddApplication');
    $router->addRoute("/PopupController/get_popup", "PopupController.php", 'get_popup');

    $router->addRoute("/SortController/Clients", "SortController.php", "getClientsForMain");
    $router->addRoute("/SortController/AnalyticClients", "SortController.php", "getClientsForAnalytics");
    $router->addRoute("/SortController/AnalyticOrders", "SortController.php", "getOrdersForAnalytics");
    $router->addRoute("/AnalyticController/DeleteAllClients", "AnalyticController.php", 'DeleteAllClients');
    $router->addRoute("/AnalyticController/DeleteAllOrders", "AnalyticController.php", 'DeleteAllOrders');

    $router->addRoute("/StatisticsController/GetStatistics", "StatisticsController.php", 'GetAllStatistics');
    $router->addRoute("/StatisticsController/GetWeek", "StatisticsController.php", 'GetWeekGraph');
    $router->addRoute("/StatisticsController/GetWeekDays", "StatisticsController.php", 'GetWeekDays');

    $router->addRoute("/UserController/getCourse", "UserController.php", 'getCourseSite');
    $router->addRoute("/UserController/getDisableCourse", "UserController.php", 'getDisableCourseSite');
    $router->addRoute("/UserController/getList", "UserController.php", 'getList');
    $router->addRoute("/UserController/getBuyCourse", "UserController.php", 'getBuyCourse');
    $router->addRoute("/UserController/getCoursePrice", "UserController.php", 'getCoursePrice');
    $router->addRoute("/UserController/getVideoInfo", "UserController.php", 'getBuyVideo');
    $router->addRoute("/UserController/save", "LoginController.php", 'saveUserSettings');

    $router->addRoute("/ContactController/sendQuestions", "ContactController.php", "SendQuestion");
    $router->addRoute("/getCheckedNotifications", "NotificationsController.php", "getCheckedNotifications");
    $router->addRoute("/getNotifications", "NotificationsController.php", "getNotifications");
    $router->addRoute("/getCountNotifications", "NotificationsController.php", "getCountNotifications");
    $router->addRoute("/NotificationsController/checkout", "NotificationsController.php", "checkNotifications");

    $router->addRoute("/TariffController/Buy", "TariffController.php", "Buy");
    $router->addRoute("/Tariff-absent", "tariff-absent.php");
    $router->addRoute("/BuyHandler/BuyTariff", "BuyHandler.php", "BuyTariff");
	$router->addRoute("/BuyHandler/CreateLinkProdamus", "BuyHandler.php", "CreateLinkBuyCourse");
	$router->addRoute("/BuyHandler/GoBuyCourse", "BuyHandler.php", 'GoBuyCourse');
	$router->addRoute("/BuyHandler/CourseBuy", "BuyHandler.php", 'BuyCourse');
	$router->addRoute("/BuyHandler/BuyCourse", "BuyHandler.php", "BuyCourse");
	$router->addRoute("/error", "404.php");
	
	
	$router->addRoute("/admin/login", "AdminLogin.php");
	$router->addRoute("/admin", "AdminUserList.php");
	$router->addRoute("/admin/AddUser", "AdminAddUser.php");
	$router->addRoute("/admin/UserList", "AdminUserList.php");
	$router->addRoute("/admin/AdminChangeUser", "AdminChangeUser.php");
	$router->addRoute("/admin/AdminStatistic", "AdminStatistic.php");
	$router->addRoute("/admin/$item_id/AdminChangeUser", "AdminChangeUser.php");
	$router->addRoute("/AdminController/GetClients", "AdminPageController.php", "getAllClients");
	$router->addRoute("/AdminController/AddUser", "AdminController.php", "AddAdmin");
	$router->addRoute("/AdminController/ChangeUser", "AdminController.php", "ChangeUser");
	$router->addRoute("/AdminController/Login", "AdminController.php", "Login");
	
	$router->addRoute("/AmoCrmController/checkTariff", "AmoController.php", 'checkTariffs');

    if (array_key_exists("/$url", $router->getRoute())) {
        $router->route("/$url");
    } else {
        $router->route("/error");
    }
    $_SESSION['item_id'] = null;


?>