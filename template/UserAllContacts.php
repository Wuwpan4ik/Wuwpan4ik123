<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Course Creator - Общие контакты</title>
    <link rel="stylesheet" href="/css/nullCss.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/UserMain.css">
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
                <a href="/UserMenu">
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
                                    <img class="aboutTheAuthor video__img" src="../img/author.jpg" alt="">
                                    <div  class=" popup__allLessons-item-video-play">
                                        <img src="../img/smallPlayer/play.png" alt="">
                                    </div>
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
                                    <?php echo htmlspecialchars(isset($item['school_name']) ? $item['school_name'] : $item['name'] )?>
                                </div>
                                <div class="aboutTheAuthor__info-text hide-content">
                                    <?=$item['description'] ?></div>
                            </div>
                        </div>
                        <div class="aboutTheAuthor-button availableСoursesBtn">
                            <button class="buttonUserPopup" onclick="getCoursePage(<?=$item['id']?>)">
                                <?php if($item['count']%1 === 1) { ?>
                                    Вам доступен <?=$item['count']?> курс
                                <? } else { ?>
                                    Вам доступно <?=$item['count']?> курса
                                <? } ?>
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

</body>
</html>