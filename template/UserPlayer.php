<!DOCTYPE HTML>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
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
<style>
    .accordion-button {
        position: absolute;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
    }
</style>
<body class="body">

    <div class="mirror_smallPlayer">
        <div class="mirrorWrap"></div>
        <img src=".<?php echo $content[0]['thubnails'] ?>" alt="">
    </div>

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
            <button onclick="window.location.replace('/UserMain?course_id=' + <?=$content[0]['id'] ?> + '&author_id=' + <?=$content[0]['user_id'] ?>)">Назад</button>
        </div>
        <div class="Сourse-question userPopup__button">
            <button id="send__questions">Есть вопросы?</button>
        </div>
    </div>
    <div class="firstPauseButton" id="pauseBtn">
        <div class="pauseBtn">
            <img src="../img/pausePlayer.svg" alt="">
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
                </li>
            </ul>
        </div>
        <video class="UserPlayerVideo" id="UserPlayerVideo" playsinline src=".<?=$content[0]['video']?>" preload="auto">
        </video>

    </div>
    <div class="slider__darkness">

    </div>
    <?php if(isset($content[0]['file_url'])) { ?>
    <div class="youWatching has__file"><?}  else {?>
    <div class="youWatching non__file">
    <? } ?>
        <div class="userPopup__title">
            Вы смотрите:
        </div>
        <div class="userPopup__body">
            <div class="youChosen availableToYou__body">
                <div class="popup__allLessons-item ">
                    <div class="popup__allLessons-item__header">
                        <div class="popup-item">
                            <div class="popup__allLessons-item-video__img">
                                <img src=".<?php echo isset($content[0]['thubnails']) ? $content[0]['thubnails'] : "/img/preview.jpg" ?>" alt="">
                            </div>
                            <div class="popup__allLessons-item-info" style="position: relative;margin:0px !important;">
                                <div class="popup__allLessons-item-info-header">
                                    <div class=" aboutTheAuthor popup__allLessons-item-info-header-number available-number">
                                        Урок <?php echo htmlspecialchars($content[0]['query_id'])?>
                                    </div>
                                    <div class="aboutTheAuthor-name">
                                        <?=$content[1]?>
                                    </div>
                                </div>
                                <div class="popup__allLessons-item-info-title" style="font-size: 14px;margin-top:10px;">
                                    <?php echo htmlspecialchars($content[0]['content_name'])?>
                                </div>
                                <div class="infoLesson">
                                    <p><?=$content[0]['content_description'] ?></p>
                                </div>
                            </div>
                        </div>
                        <?php if(isset($content[0]['file_url'])) { ?>
                        <div class="fileDownload_item">
                            <div class="upload__file">
                                <div class="firstRow">
                                    <img src="../img/saveAvatar.svg" alt="Файлик">
                                    <div class="file_name">
                                        <!--Сюда выводим название файла и его размер-->
                                        <span id="file-name" class="file-box">
                                            <?php if (isset($content[0]['file_url'])) {print_r(substr(basename($content[0]['file_url']), 0, 10));} else {echo 'Название файла';}?>
                                        </span>
                                                    <span id="file-size" class="file-box">
                                            <?php if (isset($content[0]['file_url'])) {print_r(round(filesize($content[0]['file_url']) / 1024 / 1024));} else {echo '0';} ?>мб из 5мб
                                        </span>
                                    </div>
                                </div>
                                <div class="secondRow">
                                    <?php $url = include "settings/site_url.php"; ?>
                                    <button type="button" onclick="get_file_url('<?php echo "{$url}/{$content[0]['file_url']}"?>')" class="download_file">
                                    Скачать файл
                                    </button></div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="question userPopup ">
        <div class="youPick userPopup__title button__questions">
            Есть вопросы?
        </div>
        <div class="question  userPopup__body">
            <div class=" question ">
                <div class="popup__buy-register">
                    <form id="formQuest" method="POST" action="/ContactController/sendQuestions">
                        <input type="hidden" value="<?=$content[0]['user_id'] ?>" name="author_id" id="question_author-id">
                        <?php if (!isset($_SESSION['user']['first_name'])) { ?>
                            <div class="popup__buy-body-form question input">
                                <div class="popup__bonus-form-input-account input-img">
                                    <img src="../img/smallPlayer/account.svg" alt="">
                                </div>
                                <input name="name" type="text" <?php echo isset($_SESSION['user']['first_name']) ? "value='" . $_SESSION['user']['first_name'] . "'" : 'placeholder="Введите имя" '?> <?php echo isset($_SESSION['user']['first_name']) ? "readonly" : ''?>>
                            </div>
                        <?php } ?>
                        <div class="popup__buy-body-form question input">
                            <div class="popup__bonus-form-input-email input-img">
                                <img src="../img/smallPlayer/email.svg" alt="">
                            </div>
                            <input name="email" type="email" value="<?php echo isset($_SESSION['user']['email']) ? $_SESSION['user']['email'] : 'Введите имя '?>" readonly>
                        </div>
                        <div class="popup__buy-body-form question-textarea">
                            <div class="popup__bonus-form-input-email input-img">
                                <img src="../img/smallPlayer/email.svg" alt="">
                            </div>
                            <textarea name="question" placeholder="Ваш вопрос"></textarea>
                        </div>
                    </form>
                </div>
                <div class="question-form">
                    <div class="userPopup__button questionBack backBtn">
                        <button id="close__question" class="courseBackBtn">Назад</button>
                    </div>
                    <div class="Сourse-question userPopup__button">
                        <button id="sendQuest" type="submit">Отправить</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="file_name-download display-none">
        <?=$content[0]['content_name']?>
    </div>
    <script>
        function get_file_url(url) {
            const a = document.createElement('a')
            a.href = url
            a.download = document.querySelector('.file_name-download').innerHTML.trim()
            document.body.appendChild(a)
            a.click()
            document.body.removeChild(a)

        }
    </script>
    <script>
        let mirrorVideo = document.getElementById('mirrorVideo');
        let sourceVideo = document.querySelectorAll('#UserPlayerVideo');

        if (sourceVideo.ended) {
            let request = new XMLHttpRequest();
            let url = "/Course/"+ <?php $content[0]['count'] ?> +"/AddView";
            request.open('POST', url);
            request.setRequestHeader('Content-Type', 'application/x-www-form-url');
            request.addEventListener("readystatechange", () => {
                if (request.readyState === 4 && request.status === 200) {
                }
            });
            request.send();
        }

        mirrorVideo.src = sourceVideo[0].src;
    </script>

<!--Открытие попапа Вопроса-->
    <script>
        function toggleQuestions() {
            document.querySelector('.mirror_smallPlayer').classList.toggle('display-none');
            document.querySelector('.userVideoContainer').classList.toggle('display-none');
            document.querySelector('.userVideoContainer').classList.toggle('active');
            document.querySelector('.question').classList.toggle('active');
        }
        document.getElementById('send__questions').addEventListener('click', function (){
            toggleQuestions();
        })
        document.querySelector('#close__question').addEventListener('click', function (){
            toggleQuestions();
        })
    </script>

    <script>
    function startAccordion() {
        let accordionButton = document.querySelectorAll(".accordion-button");
        accordionButton.forEach( item => {


            item.onclick = function () {

                item.classList.toggle('active');
                item.parentElement.querySelectorAll(".accordion-content").forEach( el => {
                    el.classList.toggle('active');
                })
                if(item.classList.contains('active')){
                    accordionButton.forEach(el => {
                        el.classList.remove('active');
                        el.parentElement.querySelectorAll(".accordion-content").forEach( el => {
                            el.classList.remove('active');
                        })
                        item.classList.add('active');
                        item.parentElement.querySelectorAll(".accordion-content").forEach( el => {
                            el.classList.add('active');
                        })
                    })
                }


            }

        })
    }
    startAccordion()
</script>
<script src="/js/playerCourse.js"></script>
</body>
</html>
