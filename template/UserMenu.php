<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Моя тестовая страница</title>
    <link rel="stylesheet" href="css/nullCss.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/UserMenu.css">
    <link rel="stylesheet" href="css/UserLogin.css">
    <link rel="stylesheet" href="css/sidebar.css">


</head>

<body class="body">
    <div class="UserMenu">
        <div class="_container">
            <div class="User-header">
                <div class="User-logo user__logo">
                    <div class="user__logo-img"><img src="../img/Logo.svg" alt=""></div>
                    <div class="user__logo-text">Центр Ратнера</div>
                </div>
                <div class="UserMenu-header__burger">
                    <div class=" header__burger">
                        <span></span>
                    </div>
                </div>
            </div>
            <div class="UserMenu-profile">
                <div class="UserMenu-profile__header">
                    <div class="UserMenu-profile__header-user">
                        <img id="avatar" src="<?=$_SESSION['user']['avatar']?>"/>
                        <div class="UserMenu-profile__textInfo">
                            <p>Добро пожаловать,</p>
                            <div class="UserMenu-profile__textInfo-name">
                                <h1><?=$_SESSION["user"]["first_name"]?></h1>
                            </div>
                        </div>
                    </div>

                    <div>
                        <a href="?option=SettingsAccountUser">
                            <button class="UserMenu-profile__settings"><img class="" src="img/UserSetting.svg"></button>
                        </a>
                    </div>
                </div>
                <div class="UserMenu-list">
                    <a href="">

                        <div class="UserMenu-list__option sidebarOption <? if ($_GET['option'] == 'Main') echo 'active'; ?>" >

                            <div class="option">

                                <img class="ico" src="img/home.svg">

                                <h2>Мои курсы</h2>

                            </div>

                        </div>

                    </a>

                    <a href="?option=AboutTheAuthor">

                        <div class=" UserMenu-list__option sidebarOption <? if ($_GET['option'] == 'Project') echo 'active'; ?>">

                            <div class="option">

                                <img class="ico" src="img/question.svg">

                                <h2>Об авторе</h2>

                            </div>

                        </div>

                    </a>

                    <a href="?option=UserNotifications">

                        <div class="UserMenu-list__option sidebarOption <? if ($_GET['option'] == 'Analytics') echo 'active'; ?>">

                            <div class="option">

                                <img class="ico" src="img/notification.svg">

                                <h2>Уведомления</h2>

                            </div>
                            <div class="notification-score" >5</div>

                        </div>

                    </a>

                    <a href="?option=UserContacts">

                        <div class=" UserMenu-list__option sidebarOption <? if ($_GET['option'] == 'Cases') echo 'active'; ?>">

                            <div class="option">

                                <img class="ico" src="img/save.svg">

                                <h2>Контакты</h2>

                            </div>

                        </div>

                    </a>

                </div>
                <div class="UserMenu-footer">
                    <div class="UserMenu-footer__form">
                        <div class="UserMenu-footer__form-back UserMenu-footer__button">
                            <button>Назад</button>
                        </div>
                        <div class="UserMenu-footer__form-question UserMenu-footer__button">
                            <button>Есть вопросы?</button>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>

    </div>
</body>
</html>
