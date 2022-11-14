<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Моя тестовая страница</title>
    <link rel="stylesheet" href="/css/nullCss.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/UserMain.css">



</head>

<body class="body">
<div class="UserNotifications bcg">
    <div class="_container">
        <div class="User-header">
            <div class="User-logo user__logo">
                <div class="user__logo-img"><img src="../img/Logo.svg" alt=""></div>
                <div class="user__logo-text">Центр Ратнера</div>
            </div>
            <div class="header-white__burger">
                <div class="white__burger">
                    <span></span>
                </div>
            </div>
        </div>
    </div>
    <div class="popup__container">
    <div class="userPopup">
        <div class="aboutTheAuthor userPopup__title">
            Уведомления:
        </div>
        <div class="userPopup__body">
            <div class="UserNotifications-cards">
				<?php foreach($content as $nt){?>
                <div class="UserNotifications-item <?=$nt["class"]?>">
                    <div class="UserNotifications-item__img">
                        <img src="../img/UserNotifications/like.svg" alt="">
                    </div>
                    <div class="UserNotifications-item__text">
                        <?=$nt["body"]?>
                    </div>
                    <div class="UserNotifications-item__info">
                        <div class="UserNotifications-item__info-time">
                            <?=$nt["time"]?>
                        </div>
                        <div class="UserNotifications-item__info-date">
                            <?=$nt["date"]?>
                        </div>
                    </div>
                </div>
				<?}?>
            </div>
        </div>
        <div class="userPopup__button">
            <button>Есть вопросы?</button>
        </div>
    </div>
    </div>

</div>

</div>
</body>
</html>