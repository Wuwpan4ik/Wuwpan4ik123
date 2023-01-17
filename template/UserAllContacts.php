<html lang="ru">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Course Creator - Главная</title>
    <link rel="stylesheet" href="/css/nullCss.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/UserMain.css">
    <link rel="stylesheet" href="/css/smallPlayer.css">
    <!--Favicon-->
    <link rel="icon" type="image/x-icon" href="/uploads/course-creator/favicon.ico">
</head>
<body class="body">
<div class="UserMain bcg">
    <div class="_container" style="height: 9%;">
        <div class="User-header">
            <div class="User-logo user__logo">
                <div class="user__logo-img"><img src="../img/Logo.svg" alt=""></div>
                <div class="user__logo-text">Course Creator</div>
            </div>
            <div class="header-main__burger">
                <a href="/">
                    <div class="main__burger">
                        <span></span>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="popup__container">
        <div class=" aboutTheAuthor userPopup active ">
            <div class="aboutTheAuthor userPopup__title">
                Выберите автора:
            </div>
            <div class="aboutTheAuthor userPopup__body">
                <div class="popup__allLessons-body">
                    <?php
                    foreach ($content['author_page'] as $item) {
                        ?>
                        <div class="popup__allLessons-item ">
                            <div class="popup__allLessons-item__header">
                                <div class="aboutTheAuthor popup-item">
                                    <div class=" popup__allLessons-item-video">
                                        <div class="popup__allLessons-item-video__img">
                                            <img class="aboutTheAuthor video__img" src="/<?=$item['avatar']?>" alt="">
                                        </div>
                                    </div>
                                    <div class="aboutTheAuthor popup__allLessons-item-info">
                                        <div class="popup__allLessons-item-info-header">
                                            <div class=" aboutTheAuthor available-number">
                                                Автор
                                            </div>
                                            <div class="aboutTheAuthor-name">
                                                <a href="/AboutTheAuthor/<?=$item['id']?>">
                                                    <?=$item['first_name']?> <?=$item['second_name']?>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="popup__allLessons-item-info-title">
                                            <?php echo htmlspecialchars(isset($item['school_name']) ? $item['school_name'] : $item['first_name'] . " " . $item['second_name'] )?>
                                        </div>
                                        <div class="aboutTheAuthor__info-text hide-content">
                                            <?=$item['description'] ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="aboutTheAuthor-button availableСoursesBtn">
                                    <button class="buttonUserPopup" onclick="window.location.replace('/UserContacts/<?=$item['id']?>')">
                                        Открыть контакты
                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
unset($_SESSION['course_price']);
unset($_SESSION['course_id']);
?>
</body>
</html>
