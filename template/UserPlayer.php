<html lang="ru">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo htmlspecialchars($content[0]['name'])?></title>
    <title>Моя тестовая страница</title>
    <link rel="stylesheet" href="/css/nullCss.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/UserMain.css">
    <link rel="stylesheet" href="/css/smallPlayer.css">

    <!--Favicon-->
    <link rel="icon" type="image/x-icon" href="/uploads/course-creator/favicon.ico">

</head>
<body class="body">
<div class=" userVideoContainer UserPlayer">
    <div class="UserPlayer User-header">
        <div class="User-logo user__logo">
            <div class="user__logo-img"><img width="48px" src="../<?=$content[0]['avatar']?>" alt=""></div>
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
        <div class=" userPopup__button courseBackBtn backBtn">
            <button onclick="window.location.replace('/UserMain')">Назад</button>
        </div>
        <div class="Сourse-question userPopup__button questionBtn">
            <button>Есть вопросы?</button>
        </div>
    </div>
    <video class="UserPlayerVideo" controls="controls" controlsList="nodownload">
        <source src=".<?=$content[0]['video']?>" type='video/ogg; codecs="theora, vorbis"'>
    </video>
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

    <div class="youWatching userPopup">
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
                                <div class="popup__allLessons-item-video-play">
                                    <img src="../img/smallPlayer/play.png" alt="">
                                </div>
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
<script>
    /*UserPlayer*/
    const userPlayer = document.body.querySelector('.UserPlayer');
    const userVideo = document.body.querySelector('.UserPlayerVideo');
    const youWatching = document.body.querySelector('.youWatching');
    userVideo.onclick = function () {
        if (userVideo.paused){

            youWatching.classList.remove('active');
            userPlayer.classList.remove('active');
            userVideo.pause();
        }
        else {
            userPlayer.classList.add('active');
            youWatching.classList.add('active');
            userVideo.play();
        }
        }
</script>

</body>
</html>
