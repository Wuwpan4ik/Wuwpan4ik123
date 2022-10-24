<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Моя тестовая страница</title>
    <link rel="stylesheet" href="css/nullCss.css">
    <link rel="stylesheet" href="css/UserMenu.css">
    <link rel="stylesheet" href="css/UserLogin.css">
    <link rel="stylesheet" href="css/main.css">


</head>

<body>
    <div class="UserMenu">
        <div class="_container">
            <div class="UserMenu-header">
                <div class="UserMenu-header__logo user__logo">
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
                        <a href="?option=Account">
                            <button class="UserMenu-profile__settings"><img class="" src="img/UserSetting.svg"></button>
                        </a>
                    </div>
                </div>

            </div>
        </div>

    </div>
</body>
</html>
