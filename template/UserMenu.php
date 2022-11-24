<html lang="ru">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Course Creatior - Главная</title>
    <link rel="stylesheet" href="/css/nullCss.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/UserMain.css">
    <!--Favicon-->
    <link rel="icon" type="image/x-icon" href="/uploads/course-creator/favicon.ico">
</head>

<body class="body">
    <div class="UserMenu">
        <div class="_container">
            <div class="User-header">
                <div class="User-logo user__logo">
                    <div class="user__logo-img"><img src="../img/Logo.svg" alt=""></div>
                    <div class="user__logo-text">Course Creator</div>
                </div>
                <div class="UserMenu-header__burger">
                    <a href="/UserMain">
                    <div class=" header__burger">
                        <span></span>
                    </div>
                    </a>
                </div>
            </div>
            <div class="UserMenu-profile">
                <div class="UserMenu-profile__header">
                    <div class="UserMenu-profile__header-user">
                        <img id="avatar" src="<?=$_SESSION['user']['avatar']?>"/>
                        <div class="UserMenu-profile__textInfo">
                            <p>Добро пожаловать,</p>
                            <div class="UserMenu-profile__textInfo-name">
                                <h1>
                                    <? if (!isset($_SESSION["user"]["first_name"])) { ?>
                                        Гость
                                    <? } else { ?>
                                        <? echo $_SESSION["user"]["first_name"] ?>
                                    <? } ?>
                                </h1>
                            </div>
                        </div>
                    </div>

                    <div>
                        <a href="/UserAccount">
                            <button class="UserMenu-profile__settings"><img class="" src="img/UserSetting.svg"></button>
                        </a>
                    </div>
                </div>
                <div class="UserMenu-list">
                    <div class="menu_first">
                    <a href="/UserMain">

                        <div class="UserMenu-list__option sidebarOption <? if ($_GET['option'] == 'Main') echo 'active'; ?>" >

                            <div class="option">

                                <img class="ico" src="img/home.svg">

                                <h2>Мои курсы</h2>

                            </div>

                        </div>

                    </a>

                    <a href="/UserNotifications">

                        <div class="UserMenu-list__option sidebarOption <? if ($_GET['option'] == 'Analytics') echo 'active'; ?>">

                            <div class="option">

                                <img class="ico" src="img/notification.svg">

                                <h2>Уведомления</h2>

                            </div>
                            <? if(!isset($content)){?>

                            <? } else { ?>
                                <div class="notification-score" ><?=$content?></div>
                            <? } ?>

                        </div>

                    </a>

                    <a href="/UserContacts">

                        <div class=" UserMenu-list__option sidebarOption <? if ($_GET['option'] == 'Cases') echo 'active'; ?>">

                            <div class="option">

                                <img class="ico" src="img/save.svg">

                                <h2>Контакты</h2>

                            </div>

                        </div>

                    </a>

                    </div>

                    <div class="second_menu">
                        <a href="#">

                            <div class=" UserMenu-list__option sidebarOption <? if ($_GET['option'] == 'Cases') echo 'active'; ?>">

                                <div class="option">

                                    <img class="ico" src="img/Support-white.svg">

                                    <h2>Поддержка</h2>

                                </div>

                            </div>

                        </a>
                        <a href="/LoginController/logout">

                            <div class=" UserMenu-list__option sidebarOption <? if ($_GET['option'] == 'Cases') echo 'active'; ?>">

                                <div class="option">

                                    <img class="ico" src="img/Exit-white.svg">

                                    <h2>Выход</h2>

                                </div>

                            </div>

                        </a>
                    </div>

                </div>
            </div>
            </div>
        </div>

    </div>
</body>
</html>
