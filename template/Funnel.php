<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Creator - Воронки</title>

    <link rel="stylesheet" href="/css/nullCss.css">
    <link rel="stylesheet" href="/css/font.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/lessons.css">


    <!--Favicon-->
    <link rel="icon" type="image/x-icon" href="/uploads/course-creator/favicon.ico">
</head>

<body>

<div class="Project app">

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

                                <button type="submit" class="change_btn" onclick="window.location.href = '/Funnel/<?=$p['id']?>';"">Изменить</button>

                                <button class="delete_btn" type="submit" onclick="deleteDirectory(this)" style="background: none;border: solid 1px #4E73F8;color: #4E73F8;">Удалить</button>

                            </div>
                            <div class="btn-all-settings">
                                <button  class="settingsBtn general-settings">
                                    <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2.90275 9.62209C4.01875 10.0051 4.90775 10.9391 5.27975 12.1231L5.31975 12.2431C5.74575 13.4991 5.57275 14.8511 4.85875 15.8651C4.72875 16.0491 4.75775 16.2691 4.89475 16.3731L6.96675 17.9471C7.03975 18.0021 7.11075 18.0021 7.15475 17.9971C7.20475 17.9891 7.27775 17.9621 7.33675 17.8781L7.56775 17.5501C8.25675 16.5731 9.36675 15.9701 10.5387 15.9361C11.8547 15.9091 13.0367 16.5121 13.7727 17.5751L13.8907 17.7461C13.9497 17.8301 14.0217 17.8581 14.0727 17.8661C14.1167 17.8751 14.1887 17.8721 14.2607 17.8161L16.3217 16.2611C16.4657 16.1531 16.4977 15.9221 16.3907 15.7671L16.1307 15.3921C15.4607 14.4241 15.2617 13.1681 15.5987 12.0331C15.9647 10.7971 16.8957 9.81909 18.0907 9.41909L18.2917 9.35109C18.4527 9.29809 18.5397 9.09809 18.4827 8.91409L17.6957 6.39309C17.6587 6.27509 17.5827 6.22209 17.5407 6.20009C17.4807 6.16909 17.4157 6.16409 17.3537 6.18509L17.0137 6.29809C15.8507 6.68509 14.5677 6.47509 13.5827 5.73409L13.4747 5.65309C12.5387 4.94909 11.9817 3.81409 11.9857 2.61809L11.9877 2.33809C11.9877 2.20509 11.9247 2.12209 11.8867 2.08409C11.8507 2.04709 11.7897 2.00309 11.7037 2.00309L9.15675 2.00009C9.00075 2.00009 8.87375 2.14909 8.87275 2.33309L8.87175 2.57509C8.86675 3.79009 8.29775 4.94609 7.34975 5.66909L7.22075 5.76709C6.17775 6.56009 4.81775 6.78409 3.58575 6.36409C3.53875 6.34809 3.49475 6.35109 3.45275 6.37309C3.42075 6.38909 3.36275 6.43009 3.33475 6.52109L2.51775 9.11709C2.45875 9.30609 2.55575 9.50309 2.73875 9.56609L2.90275 9.62209ZM7.11375 20.0001C6.62775 20.0001 6.15575 19.8421 5.75775 19.5391L3.68575 17.9661C2.69575 17.2161 2.47675 15.7731 3.19675 14.7501C3.57075 14.2201 3.64775 13.5391 3.42775 12.8931L3.37275 12.7251C3.18975 12.1431 2.77175 11.6911 2.25475 11.5141H2.25375L2.09075 11.4571C0.872746 11.0401 0.222746 9.74909 0.609746 8.51709L1.42575 5.92209C1.61075 5.33509 2.00975 4.86109 2.54975 4.58809C3.07775 4.32209 3.67475 4.28109 4.23275 4.47209C4.83175 4.67609 5.49675 4.56509 6.00975 4.17509L6.13875 4.07709C6.59475 3.72909 6.86975 3.16409 6.87175 2.56709L6.87275 2.32609C6.87775 1.04209 7.90275 9.15527e-05 9.15575 9.15527e-05H9.15975L11.7067 0.00309155C12.3087 0.00409155 12.8767 0.242092 13.3047 0.673092C13.7477 1.11809 13.9897 1.71309 13.9877 2.34809L13.9857 2.62709C13.9837 3.19309 14.2427 3.72809 14.6797 4.05609L14.7867 4.13709C15.2457 4.48209 15.8437 4.58109 16.3807 4.40109L16.7197 4.28809C17.2967 4.09609 17.9107 4.14309 18.4517 4.42009C19.0067 4.70409 19.4167 5.19309 19.6047 5.79809L20.3917 8.31909C20.7717 9.53709 20.1137 10.8511 18.9267 11.2481L18.7257 11.3151C18.1497 11.5091 17.6967 11.9891 17.5157 12.6011C17.3497 13.1621 17.4457 13.7791 17.7747 14.2531L18.0347 14.6281C18.7487 15.6601 18.5207 17.1081 17.5267 17.8571L15.4657 19.4131C14.9707 19.7871 14.3637 19.9381 13.7547 19.8411C13.1407 19.7421 12.6047 19.4021 12.2457 18.8841L12.1277 18.7121C11.7777 18.2081 11.2177 17.9021 10.6307 17.9351C10.0427 17.9511 9.53475 18.2301 9.20275 18.7021L8.97175 19.0301C8.60975 19.5431 8.07275 19.8781 7.46175 19.9741C7.34475 19.9921 7.22875 20.0001 7.11375 20.0001ZM10.4999 8.49999C9.67295 8.49999 8.99995 9.17299 8.99995 9.99999C8.99995 10.827 9.67295 11.5 10.4999 11.5C11.3269 11.5 11.9999 10.827 11.9999 9.99999C11.9999 9.17299 11.3269 8.49999 10.4999 8.49999ZM10.4999 13.5C8.56995 13.5 6.99995 11.93 6.99995 9.99999C6.99995 8.06999 8.56995 6.49999 10.4999 6.49999C12.4299 6.49999 13.9999 8.06999 13.9999 9.99999C13.9999 11.93 12.4299 13.5 10.4999 13.5Z" fill="#757D8A"/>
                                    </svg>
                                    Общие настройки
                                </button>
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
                <div class="popup-body">
                    <div class="popup__title">Вы действительно хотите удалить проект?</div>
                    <div class="popup__form">
                        <button class="popup__btn popup__delete popup__white">Удалить</button>
                        <button class="popup__btn popup__not-delete popup__blue">Не удалять</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'default/popupGeneralSettings.php'?>



<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="../js/slick.min.js"></script>
<script src="../js/script.js" ></script>
<script src="../js/sliders.js"></script>
<script src="../js/customSelect.js"></script>

<script>


    let colors = document.querySelectorAll('.popup-styles-color');
    let buttons = document.querySelectorAll('.popup-styles-button');
    let videoBtns = document.querySelectorAll('.general-popup__button');
    let shadowDown = document.querySelector('.button-shadow-down a');
    let shadowLite = document.querySelector('.button-shadow-lite a');
    let shadowNone = document.querySelector('.button-shadow-none a');



        let title = document.querySelector('.slider__item-title');
        let text = document.querySelector('.slider__item-text');

        title.style.fontFamily = heading.value.style.fontFamily;
        title.style.fontWeight = '900px';


    function changeStyleBtn (item, color, shadow = null) {
        item.style.background = color;
        if (document.querySelector('.button-shadow-down').classList.contains('active')) {

            document.querySelector('.button-video').style.boxShadow = '0px 3px 0px ' + shadow;
        }
        else if (document.querySelector('.button-shadow-lite').classList.contains('active')) {

            document.querySelector('.button-video').style.boxShadow = '0px 10px 30px ' + shadow;
        }
        else if (document.querySelector('.button-shadow-none').classList.contains('active')){

            document.querySelector('.button-video').style.boxShadow = null;
        }
        if (shadow != null) {

        }

    }
    let color = null;
    let shadow = null;

        colors.forEach(item => {
            item.addEventListener('click', () => {
                item.classList.toggle('active')
                color = item.style.background;
                shadow = item.style.color;
                shadowDown.style.boxShadow = '0px 3px 0px ' + shadow;
                shadowLite.style.boxShadow = '0px 10px 30px ' + shadow;
                shadowNone.style.boxShadow = '';
                if (item.classList.contains('active')) {
                    videoBtns.forEach(item => {



                        colors.forEach(el => {
                            el.classList.remove('active');
                            item.classList.add('active');
                            changeStyleBtn(item, color, shadow)
                        })

                    })
                }

            })

        })
    buttons.forEach(button => {
        button.addEventListener('click', () => {

            button.classList.toggle('active')
            if (button.classList.contains('active')) {
                buttons.forEach(b => {
                    changeStyleBtn(document.querySelector('.button-video'), color, shadow)
                    b.classList.remove('active');
                    button.classList.add('active');
                })

            }

        })
    })


</script>
<script>
    let generalSettings = document.querySelectorAll('.general-settings');
    let popupGeneralClose = document.querySelectorAll('.close__btn');

    generalSettings.forEach(item =>{
        item.addEventListener('click', () => {
            document.querySelector('.popup__general').style.display = 'flex';
            let slider = item.parentElement.parentElement.querySelector('.media-cart-img').cloneNode(true);
            document.querySelector('.popup-video').appendChild(slider);
            document.querySelector('.popup-video').querySelector('.slider__item-info').style.bottom = "18%";
            sliders();
        })
    })
    popupGeneralClose.forEach(item =>{
        item.addEventListener('click', () => {
            document.querySelector('.popup__general').style.display = 'none';
        })
    })
</script>
<script>






    //   Удалить все кнопки
    document.querySelectorAll('.slick-arrow').forEach(item => {
        item.remove();
    })

    let deleteButtons = document.querySelectorAll('.reboot');
    let notDelete = document.querySelector('.popup__not-delete');
    let deletes = document.querySelector('.popup__delete');
    let entryDisplay = document.querySelector('#popup__background');
    let entryContainer = document.querySelector('.popup__container');
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
    entryContainer.onclick = function (event) {
        if (event.target === entryContainer) {
            entryDisplay.classList.remove('display-block');
            toggleOverflow();

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
<script src="../js/sidebar.js"></script>
<script src="../js/getNotifications.js"></script>


</body>

</html>