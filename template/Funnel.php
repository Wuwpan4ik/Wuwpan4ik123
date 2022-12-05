<html lang="ru">

<head>
    <meta charset="utf-8">
    <title>Course Creator - Воронки</title>
    <link rel="stylesheet" href="/css/nullCss.css">
    <link rel="stylesheet" href="/css/lessons.css">
    <link rel="stylesheet" href="/css/main.css">
    <!--Favicon-->
    <link rel="icon" type="image/x-icon" href="/uploads/course-creator/favicon.ico">
</head>

<body>

<div class="Project">

    <?php include 'default/sidebar.php'; ?>

    <div class="feed">

        <?php
        $title = "Мои воронки";
        $back = "Project";
        include ('default/header.php');
        ?>

        <div class="Lessons ">

            <div class="media _container">

                <?php

                $k = 1;

                foreach($content[0][0] as $p){?>

                    <div class="media-cart">

                        <div class="media-cart-img">
                            <div class="smallPlayer _conatiner">
                                <div class="smallPlayer__slick-slider">
                                    <div class="slider__pagination _conatiner-player">
                                        <div class="slick-dots"></div>
                                    </div>
                                    <div class="slider">
                            <?

                            $i=1;

                            foreach($content[0][1] as $v){
                                if ($v['funnel_id'] == $p['id']) {?>

                                    <div class="slider__item ">
                                        <div class="slider__video">
                                            <video playsinline id="123" class="slider__video-item"
                                            <source  class="video" src="<?=$v['video']?>" />
                                            </video>
                                        </div>
                                        <div class="slider__darkness">

                                        </div>
                                        <div class="slider__header _conatiner-player ">
                                            <div class="slider__header-logo">
                                                <div class="slider__header-logo-img">
                                                    <img src="<? echo (isset($_SESSION['user']['avatar'])  ? $_SESSION['user']['avatar'] : "/uploads/ava/userAvatar.jpg") ?>" alt="">
                                                </div>
                                                <div class="slider__header-logo-text">
                                                    <?=$_SESSION['user']['first_name']?>
                                                </div>
                                            </div>
                                            <div class="slider__header-views">
                                                <div class="slider__header-views-img">
                                                    <img src="../img/smallPlayer/views.svg" alt="">
                                                </div>
                                                <div class="slider__header-views-count">
                                                    126
                                                </div>
                                            </div>
                                        </div>
                                        <div class="slider__item-info _conatiner-player">
                                            <div class="slider__item-title">
                                                <?=$v['name']?>
                                            </div>
                                            <div class="slider__item-text">
                                                <?=$v['description']?>
                                            </div>
                                        </div>
                                    </div>
                                    <?$i++;}}?>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <p class="funnel__title">Воронка №<?=$k?></p>

                        <h3><?=$p['name']?></h3>

                        <div style="display:flex;">
                            <?php $url = include "settings/site_url.php"; ?>

                            <input id="half_input" value="<?=$url?>/<?=$_SESSION['user']['username']?>/SmallPlayer/<?=$p['id']?>" disabled/>

                            <button class="copy-button" onclick="copy_link(this)" type="submit">Копировать</button>

                        </div>
                        <form action="/Funnel-select/<?=$p['id']?>" method="POST">
                            <input type="text" name="id" hidden="hidden" value="<?=$p['id']?>">
                            <select onfocusout="course__send(this)" name="course_id" class="select__course">
                                <?php if (!is_null($content[1][0]) && isset($content[1][0])) {
                                foreach ($content[1] as $course) { ?>
                                    <option <?php if ($p['course_id'] == $course['id']) echo "selected";?> value="<?=$course['id']?>"><?=$course['name']?> </option>
                                <?php } } else { ?>
                                    <option>Нет курсов для выбора</option>
                                <?php } print_r($content[1]) ?>
                            </select>
                        </form>

                        <div class="btn-delete-edit">

                            <input type="hidden" value="<?=$p['id']?>" >

                            <button type="submit" onclick="window.location.href = '/Funnel/<?=$p['id']?>';"">Изменить</button>

                            <button class="reboot" type="submit" onclick="deleteDirectory(this)">Удалить</button>

                        </div>

                    </div>

                    <?$k++;}?>

                <div class="media-cart placeholder">

                    <div class="btn-upload" style="width: auto;">

                        <a href="/Funnel/create" class="create-new">

                            <img src="../img/Create.svg" class="create-ico">

                            <p>Создать<br> новую воронку</p>

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
<div id="popup__background">
    <div id="popup">
        <div class="popup__container">
            <div class="popup__title">Вы действительно хотите удалить проект?</div>
            <div class="popup__form">
                <button class="popup__btn popup__not-delete">Не удалять</button>
                <button class="popup__btn popup__delete">Удалить</button>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="../js/script.js" ></script>
<script src="../js/slick.min.js"></script>
<script src="../js/sliders.js"></script>

<script>
//   Удалить все кнопки
    document.querySelectorAll('.slick-arrow').forEach(item => {
        item.remove();
    })

    let deleteButtons = document.querySelectorAll('.reboot');
    let notDelete = document.querySelector('.popup__not-delete');
    let deletes = document.querySelector('.popup__delete');
    let entryDisplay = document.querySelector('#popup__background');
    let body = document.querySelector('body');

    function course__send(item) {
        item.parentElement.submit();
    }

    function copy_link(elem) {
        var copyTextarea = document.createElement("textarea");
        copyTextarea.style.position = "fixed";
        copyTextarea.style.opacity = "0";
        copyTextarea.textContent = elem.parentElement.querySelector("#half_input").value;
        document.body.appendChild(copyTextarea);
        copyTextarea.select();
        document.execCommand("copy");
        document.body.removeChild(copyTextarea);
        elem.innerHTML = "Скопировано"
        setTimeout(function (){
            elem.innerHTML = "Копировать"
        }, 10000)
    }


    function toggleOverflow () {
        body.classList.toggle("overflow-hidden");
    }
    function deleteDirectory(elem) {
        entryDisplay.classList.add('display-block');
        toggleOverflow();
        deletes.addEventListener('click',function () {
            window.location.href = '/Funnel-delete/'+ elem.parentElement.children[0].value;
        });
    }
    notDelete.onclick = function (event) {
        if (event.target === notDelete) {
            entryDisplay.classList.remove('display-block');
            toggleOverflow();
        }
    }
    entryDisplay.onclick = function (event) {
        if (event.target === entryDisplay) {
            toggleOverflow();
            entryDisplay.classList.remove('display-block');
        }
    }

    // Удаление лишних пагинаций в слайдерах
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll('.smallPlayer__slick-slider').forEach((elem) => {
            if (elem.querySelectorAll('.slider__item').length === 0) {
                elem.removeChild(elem.querySelector('.slider__pagination'));
                elem.parentElement.parentElement.style = "background: url(./img/FunnelDefault.png);";
            }
        })
    });
</script>
<script src="/js/getNotifications.js"></script>
</body>

</html>