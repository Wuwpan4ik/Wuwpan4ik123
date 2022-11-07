<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Моя тестовая страница</title>
    <link rel="stylesheet" href="css/nullCss.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/settingsAccountUser.css">
    <link rel="stylesheet" href="css/UserMain.css">
    <link rel="stylesheet" href="css/UserMenu.css">
    <link rel="stylesheet" href="css/smallPlayer.css">



</head>

<body class="body">
<div class=" userVideoContainer UserPlayer">
    <div class="UserPlayer User-header">
        <div class="User-logo user__logo">
            <div class="user__logo-img"><img src="../img/Logo.svg" alt=""></div>
            <div class="user__logo-text">Центр Ратнера</div>
        </div>
        <div class="header-main__burger">
            <div class="main__burger">
                <span></span>
            </div>
        </div>
    </div>
    <div class="UserPlayer Сourse-form">
        <div class="Сourse-back userPopup__button courseBackBtn">
            <button>Назад</button>
        </div>
        <div class="Сourse-question userPopup__button questionBtn">
            <button>Есть вопросы?</button>
        </div>
    </div>
    <video class="UserPlayerVideo" preload="none" autoplay="autoplay" controls="controls" controlsList="nodownload">
        <source src="/videoTest/mafioznik-zubenko.mp4" type='video/ogg; codecs="theora, vorbis"'>
    </video>

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
                                <img src="../img/smallPlayer/Group1426.png" alt="">
                                <div class="popup__allLessons-item-video-play">
                                    <img src="../img/smallPlayer/play.png" alt="">
                                </div>
                            </div>
                            <div class="popup__allLessons-item-info">
                                <div class="popup__allLessons-item-info-header">
                                    <div class=" aboutTheAuthor popup__allLessons-item-info-header-number available-number">
                                        Урок 1
                                    </div>
                                    <div class="aboutTheAuthor-name">
                                        10:44
                                    </div>
                                </div>
                                <div class="popup__allLessons-item-info-title">
                                    Управление гневом внутри себя
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="youWatching Сourse-form">
                    <div class="userPopup__button">
                        <button>Назад</button>
                    </div>
                    <div class=" userPopup__button">
                        <button>Есть вопросы?</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    /*UserPlayer*/
    const userVideo = document.body.querySelector('.UserPlayerVideo');
    const youWatching = document.body.querySelector('.youWatching');

    if (userVideo.paused) {
        youWatching.classList.add('active');
        userVideo.play();
    }
    else {
        youWatching.classList.remove('active');
        userVideo.pause();
    }



</script>

</body>
</html>
