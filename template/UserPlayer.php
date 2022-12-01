<!DOCTYPE HTML>
<html lang="ru">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo htmlspecialchars($content[0]['name'])?></title>
    <link rel="stylesheet" href="/css/nullCss.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/UserMain.css">
    <link rel="stylesheet" href="/css/smallPlayer.css">
    <link rel="stylesheet" href="/css/courseplayer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!--Favicon-->
    <link rel="icon" type="image/x-icon" href="/uploads/course-creator/favicon.ico">
</head>
<body class="body">
<div class=" userVideoContainer UserPlayer">
    <div class="UserPlayer User-header">
        <div class="User-logo user__logo">
            <div class="user__logo-img"><img src="../<?=$content[0]['avatar']?>" alt=""></div>
            <div class="user__logo-text"><?=$content[0]['first_name']?></div>
        </div>
        <div class="header-main__burger">
            <a href="/UserMenu">
                <div class="main__burger">
                    <span></span>
                </div>
            </a>
        </div>
    </div>
    <div class="UserPlayer Сourse-form">
        <div class="userPopup__button courseBackBtn backBtn">
            <button onclick="window.location.replace('/UserMain')">Назад</button>
        </div>
        <div class="Сourse-question userPopup__button questionBtn">
            <button>Есть вопросы?</button>
        </div>
    </div>
    <div class="firstPlayButton" id="playBtn">
        <div class="playBtn">
            <img src="/img/smallPlayer/play.svg">
        </div>
    </div>
    <div class="container show-controls contaierPlayer">
        <div class="wrapper nonActivePlayer">
            <div class="video-timeline">
                <div class="progress-area">
                    <span>00:00</span>
                    <div class="progress-bar"></div>
                </div>
            </div>
            <ul class="video-controls">
                <li class="options left">
                    <button class="play-pause"><i class="fas fa-play"></i></button>
                    <div class="video-timer">
                        <p class="current-time">00:00</p>
                        <p class="separator"> / </p>
                        <p class="video-duration">00:00</p>
                    </div>
                </li>
                <!-- 10сек вперед и назад кнопочки
                <li class="options center">
                    <button class="skip-backward"><i class="fas fa-backward"></i></button>
                    <button class="skip-forward"><i class="fas fa-forward"></i></button>
                </li>
                -->
                <li class="options right">
                    <button class="volume"><i class="fa-solid fa-volume-high"></i></button>
                    <button class="fullscreen"><i class="fa-solid fa-expand"></i></button>
                </li>
            </ul>
        </div>
        <video class="UserPlayerVideo" id="UserPlayerVideo" playsinline src=".<?=$content[0]['video']?>">
        </video>

    </div>
    <div class="slider__darkness">

    </div>

    <style>
        .slider__darkness {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgb(0, 0, 0);
            background: -webkit-gradient(linear, left bottom, left top, color-stop(5%, rgb(0, 0, 0)), color-stop(20%, rgba(0, 0, 0, 0.7)), color-stop(50%, rgba(0, 0, 0, 0.5)), to(rgba(0, 0, 0, 0.3)));
            background: -o-linear-gradient(bottom, rgb(0, 0, 0) 5%, rgba(0, 0, 0, 0.7) 20%, rgba(0, 0, 0, 0.5) 50%, rgba(0, 0, 0, 0.3) 100%);
            background: linear-gradient(0deg, rgb(0, 0, 0) 5%, rgba(0, 0, 0, 0.7) 20%, rgba(0, 0, 0, 0.5) 50%, rgba(0, 0, 0, 0.3) 100%);
            pointer-events: none;
        }
    </style>

    <div class="youWatching">
        <div class="userPopup__title">
            Вы смотрите:
        </div>
        <div class="userPopup__body">
            <div class="youChosen availableToYou__body">
                <div class="popup__allLessons-item ">
                    <div class="popup__allLessons-item__header">
                        <div class="popup-item">
                            <div class="popup__allLessons-item-video__img">
                                <img src=".<?php echo $content[0]['thubnails'] ?>" alt="">
                            </div>
                            <div class="popup__allLessons-item-info">
                                <div class="popup__allLessons-item-info-header">
                                    <div class=" aboutTheAuthor popup__allLessons-item-info-header-number available-number">
                                        Урок <?php echo htmlspecialchars($content[0]['query_id'])?>
                                    </div>
                                    <div class="aboutTheAuthor-name">
                                        <?=$content[1]?>
                                    </div>
                                </div>
                                <div class="popup__allLessons-item-info-title">
                                    <?php echo htmlspecialchars($content[0]['content_name'])?>
                                </div>
                                <div class="popup__allLessons-item-info-desc">
                                    <?php echo htmlspecialchars($content[0]['description'])?>
                                </div>
                            </div>
                        </div>
                        <div class="fileDownload_item">
                            <div class="upload__file">
                                <div class="firstRow">
                                    <img src="../img/saveAvatar.svg" alt="Файлик">
                                    <div class="file_name">
                                        <!--Сюда выводим название файла и его размер-->
                                        <p>
                                            Название файла
                                        </p>
                                        <span>
                                            Размер файла - 150кб
                                        </span>
                                    </div>
                                </div>
                                <div class="secondRow">
                                    <a href="<!--Ссылка на файл-->" download>
                                        <button class="download_file">
                                            Скачать файл
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="youWatching Сourse-form">
                    <div class="userPopup__button youWatchingBack backBtn ">
                        <button onclick="window.location.replace('/UserMain')">Назад</button>
                    </div>
                    <div class="Сourse-question userPopup__button ">
                        <button>Есть вопросы?</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/js/playerCourse.js"></script>
</body>
</html>
