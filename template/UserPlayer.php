<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo htmlspecialchars($content[0]['name'])?></title>
    <title>Моя тестовая страница</title>
    <link rel="stylesheet" href="/css/nullCss.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/UserMain.css">
    <link rel="stylesheet" href="/css/smallPlayer.css">



</head>
<body class="body">
<?// print_r($content)?>
<div class=" userVideoContainer UserPlayer">
    <div class="UserPlayer User-header">
        <div class="User-logo user__logo">
            <div class="user__logo-img"><img width="48px" src="../<?=$content[0]['avatar']?>" alt=""></div>
            <div class="user__logo-text"><?=$content[0]['first_name']?></div>
        </div>
        <div class="header-main__burger">
            <div class="main__burger">
                <span></span>
            </div>
        </div>
    </div>
    <div class="UserPlayer Сourse-form">
        <div class="Сourse-back userPopup__button courseBackBtn">
            <button onclick="window.location.replace('/UserMain')">Назад</button>
        </div>
        <div class="Сourse-question userPopup__button questionBtn">
            <button>Есть вопросы?</button>
        </div>
    </div>
    <video class="UserPlayerVideo" controls="controls" controlsList="nodownload">
        <source src=".<?=$content[0]['video']?>" type='video/ogg; codecs="theora, vorbis"'>
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
                    <div class="Сourse-back userPopup__button youWatchingBack">
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
