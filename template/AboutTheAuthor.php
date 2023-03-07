<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Сюда вставить имя автор / название школы-->
    <title>Course Creator - О авторе</title>
    <link rel="stylesheet" href="/css/nullCss.css">
    <link rel="stylesheet" href="/css/UserMain.css">
    <!--Favicon-->
    <link rel="icon" type="image/x-icon" href="/uploads/course-creator/favicon.ico">
</head>
<body class="body">
<div class="aboutTheAuthor bcg">

    <div class="_container">
        <div class="User-header">
                <div class="User-logo user__logo">
                    <div class="user__logo-img"><img src="../img/Logo.svg" alt=""></div>
                    <div class="user__logo-text">Course Creator</div>
                </div>
            <div class="header-white__burger">
                <a href="/">
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
            <div class="aboutTheAuthor userPopup__title" style="text-align:center;margin-bottom: 40px;">
                Об авторе:
            </div>
            <div class="userPopup__body">
                <div class="aboutTheAuthor-img">
                    <img src="<? echo (isset($content[0]['avatar']) && (!empty($content[0]['avatar'])))  ? $content[0]['avatar'] : "/uploads/ava/userAvatar.jpg" ?>" alt="">
                </div>
                <div class="aboutTheAuthor__name">
                    <? echo htmlspecialchars($content[0]["first_name"]), " ", htmlspecialchars($content[0]["second_name"])?>
                </div>
                <div class="aboutTheAuthor__text">
                    <?echo htmlspecialchars($content[0]["school_desc"])?>
                </div>
            </div>
            <div class="userPopup__button">
                <button onclick="window.location.replace('/UserContacts/<?php echo htmlspecialchars($content[0]['id'])?>')">Есть вопросы?</button>
            </div>
        </div>

    </div>
    </div>

</div>

</div>
</body>
</html>
