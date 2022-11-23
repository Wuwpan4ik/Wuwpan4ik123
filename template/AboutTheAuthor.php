<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Моя тестовая страница</title>
    <link rel="stylesheet" href="/css/nullCss.css">
    <link rel="stylesheet" href="/css/UserMain.css">
</head>
<body class="body">
<div class="aboutTheAuthor bcg">

    <div class="_container">
        <div class="User-header">
                <div class="User-logo user__logo">
                    <div class="user__logo-img"><img src="../img/Logo.svg" alt=""></div>
                    <div class="user__logo-text">Центр Ратнера</div>
                </div>
            <div class="header-white__burger">
                <a href="/UserMenu">
                    <div class="main__burger">
                        <span></span>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="popup__container">
    <div class="userPopup">
        <div class="user-content">
            <div class="aboutTheAuthor userPopup__title">
                Об авторе:
            </div>
            <div class="userPopup__body">
                <div class="aboutTheAuthor-img">
                    <img src="/<?=$content[0]["avatar"]?>" alt="">
                </div>
                <div class="aboutTheAuthor__name">
                    <? echo htmlspecialchars($content[0]["first_name"]), " ", htmlspecialchars($content[0]["second_name"])?>
                </div>
                <div class="aboutTheAuthor__text">
                    <?echo htmlspecialchars($content[0]["about"])?>
                </div>
            </div>
            <div class="userPopup__button">
                <button>Есть вопросы?</button>
            </div>
        </div>

    </div>
    </div>

</div>

</div>
</body>
</html>
