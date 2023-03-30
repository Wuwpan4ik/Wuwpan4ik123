<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <!--Выдаем вместо этой хуйни нормальный тайтл названия воронки / курса-->
    <title>Course Creator - Плеер</title>
    <link type="text/css" rel="stylesheet" href="/css/smallPlayer.css">
    <link type="text/css" rel="stylesheet" href="/css/UserMain.css">
    <link type="text/css" rel="stylesheet" href="/css/notifications.css">
    <!--Делаем так, чтобы страницы не индексировались в поиске-->
    <meta name="robots" content="noindex" />
    <!--Favicon-->
    <link rel="icon" type="image/x-icon" href="/uploads/course-creator/favicon.ico">

    <?php if (!empty($content['html_code'])) print_r($content['html_code']) ?>

</head>
<body class="body">
<style>
    @keyframes flicker {
        0% {
            box-shadow:
                    0 0 30px <?php echo $content['rgb_button'] ?>
        }
        100% {
            box-shadow:
                    0 0 10px <?php echo $content['rgb_button'] ?>
        }
    }
</style>
<div class="display-none">
	<?php echo $_SESSION['error'] ?>
</div>
<?php if (!empty($content['course_content'])) { ?>
<div class="mirror_smallPlayer">
    <div class="mirrorWrap"></div>
    <video id="mirrorVideo" src="" playsinline muted></video>
</div>
<div class="smallPlayer _conatiner">
    <div class="smallPlayer__slick-slider">
        <div class="slider__pagination _conatiner-player">
            <div class="slick-dots"></div>
        </div>
        <div class="slider">
            <?php
                foreach ($content['funnel_content'] as $item) {
                    if (isset($item['popup'])) $popup = json_decode($item['popup']);
            ?>
            <div class="slider__item">
                <div class="slider__video">
                    <video playsinline class="slider__video-item video-<?=$item['video_id']?> <?php if($item['dis_trans'] == 1 ||    !$item['button_text']) echo 'disable-skip' ?>" data-player="playing">
                        <source class="video" src="/<?=$item['video']?>" id="sourceVideo"  />
                    </video>
                </div>
                <div class="slider__darkness">

                </div>
                <div class="slider__header _conatiner-player ">
                    <div class="slider__header-logo">
                        <div class="slider__header-logo-img">
                            <img width="48px" src="/<? echo (!empty($item['avatar'])  ? $item['avatar'] : "uploads/ava/userAvatar.jpg") ?>" alt="">
                        </div>
                        <div class="slider__header-logo-text">
                            <?=$item['first_name']?>
                        </div>
                    </div>
                    <div class="slider__header-views">
                        <div class="slider__header-views-img">
                            <span>Сейчас смотрят:</span><img src="/img/smallPlayer/views.svg" alt="">
                        </div>
                        <div class="slider__header-views-count">
                        </div>
                    </div>
                </div>
                <div class="play__video active">
                    <img src="/img/smallPlayer/play.svg" alt="">
                </div>
                <div class="pause__video" id="pause_video">
                    <img src="/img/smallPlayer/pause.svg" alt="">
                </div>
                <div class="slider__item-info _conatiner-player">
                    <div class="slider__item-title <? echo (json_decode($content['main__settings'], true)['title__font'])?>" style="<? echo "font-size:" . (json_decode($content['main__settings'], true)['title__size']) . 'px'?>">
                        <?=$item['content_name']?>
                    </div>
                    <div class="slider__item-text <? echo (json_decode($content['main__settings'], true)['desc__font'])?>" style="<? echo "font-size:" . (json_decode($content['main__settings'], true)['desc__size']) . 'px'?>">
                        <?=$item['content_description']?>
                    </div>
                    <?php
                    if (isset($item['button_text']) && !empty($item['button_text'])) { ?>
                            <div class="slider__item-button button-open">
                                <button style="<? echo (json_decode($content['main__settings'], true)['button__style-color'])?>; <? echo (json_decode($content['main__settings'], true)['button__style-style'])?>" <?php if ($popup->first_do->next_lesson) echo 'onclick="NextSlide()"' ?> <?php if (isset($popup->first_do->link)) if ($popup->first_do->open_in_new == 'open_new_window') { echo "onClick=\"window.open('". $popup->first_do->link ."')\""; } else { echo "onclick=\"window.location = ('". $popup->first_do->link ."')\""; } ?> class="button <?php if ((isset($popup->first_do->link) || isset($popup->first_do->next_lesson)) && (int) $item['dis_trans']) echo 'slider__item-button-brightness'?>"><?=$item['button_text']?></button>
                            </div>
                            <?php } else { ?>
                    <?php } ?>
                        </div>
                        <?php
                        // popup при клике
                        if (isset($popup->first_do->form) || isset($popup->first_do->pay_form)) {
                            if (isset($popup->first_do->form)) {
                                $form = $popup->first_do->form;
                            } else {
                                $form = $popup->first_do->pay_form;
                            }
                            if (isset($popup->second_do->file)) {
                                $file = $popup->second_do->file;
                            }
                            // Первое или второе действие
                            $name = 'button';
                            $form__title = $popup->form__title;
                            $form__desc = $popup->form__desc;
                            $submit__text = $popup->button_text;
                            $popup__do = $popup->first_do;
                            $second_link = $popup->second_do->link;
                            $id = $item['id'];
                            $new_window = !is_null($popup->second_do->open_in_new);
                            $new_window = !is_null($popup->first_do->open_in_new);
                            $author_id = $item['author_id'];
                            $funnel_id = $content['course_content'][0]['funnel_id'];
                            $slider_id = $item['count_slider'];
                            include 'template/default/popup__templates/popup__form.php';
                        } ?>
                        <?php if (isset($popup->first_do->list)) {
                            $name = 'video';
                            $course_id = $popup->first_do->course_id;
                            include 'template/default/popup__templates/popup__all-lessons.php';
                        ?>
                        <?php } ?>
            </div>
            <?php } ?>
        </div>

        <?php
        include 'template/default/popup__templates/popup__buy.php';
        ?>
    </div>
</div>
<input type="hidden" id="albato_key" value="<?php if ($content['user_info']['albato_key']) echo $content['user_info']['albato_key'] ?>">
<?php }?>
<?php include 'template/default/notificationsPopup.php' ?>

<?php if (empty($content['course_content'])) { ?>
    <style>
        body {
            position: relative !important;
            height: 100vh !important;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex !important;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            text-align: center;
            background: -o-linear-gradient(285.58deg, #3E8AFB 2.4%, #7024C4 97.34%);
            background: linear-gradient(164.42deg, #3E8AFB 2.4%, #7024C4 97.34%);
        }
    </style>
        <div class="block">
            <div class="site_logo" style="display:flex;justify-content: center; align-items: center">
                <img src="/img/Logo.svg" alt="" style="border-radius: 50%">
                <span style="color:white;font-weight: 700;margin-left:10px;">
                    Course Creator
                </span>
            </div>
            <div class="site_additional" style="padding: 30px 24px;
margin: 25px auto;background-color: #fff;width:320px;border-radius: 20px;font-weight: 500">
                Автор не добавил курс, к которому будет принадлежать воронка, или в нём нет видео!
            </div>
            <div class="site_link">
                <a href="/" style="color: #fff;
opacity: 0.6;
cursor: pointer;text-decoration: none;">Вернуться на сайт</a>
            </div>
        </div>
<?php } ?>

<script src="/js/notifications.js"></script>
<script src="/js/jquery-3.6.1.min.js" ></script>
<script src="/js/script.js" ></script>
<script src="/js/slick.min.js"></script>
<script src="/js/sliders.js"></script>
<!-- Adaptive Fix -->
<script>
    let actualHeight = window.innerHeight;
    let slider = document.querySelectorAll('.slider__item');
    slider.forEach((item)=>{
        item.style.height = actualHeight + 'px';
    })
</script>
<!--На некст слайд-->
<script>
    let request = new XMLHttpRequest();
    let url = "/Funnel/"+ <?php echo $_SESSION['item_id']?> +"/AddView";
    request.open('POST', url);
    request.setRequestHeader('Content-Type', 'application/x-www-form-url');
    request.addEventListener("readystatechange", () => {
        if (request.readyState === 4 && request.status === 200) {
        }
    });
    request.send();

    // Проверка на запрет
    LoadAButtons();
    $('.slick-next').click(function (){
        NextSlide();
    })
    $('.slick-prev').click(function (){
        PrevSlide();
    })

    function LoadAButtons() {
        let video = document.querySelector('.slick-active video')
        if (video.classList.contains("disable-skip")) {
            document.querySelectorAll('.slick-arrow').forEach((item) => {
                item.classList.add('slick-disabled');
            })
        } else {
            document.querySelectorAll('.slick-arrow').forEach((item) => {
                if (!item.classList.contains('slick-disabled')) {
                    item.classList.remove('slick-disabled');
                }
            })
        }
    }
    // Проверка на запрет
    function NextSlide() {
        document.querySelector('.slick-active button').style.background = `linear-gradient(to right,white 0%, white 100%,lightgrey 100% , lightgrey 0%)`;
        PauseVideo();
        LoadAButtons();
    }
    function PrevSlide() {
        document.querySelector('.slick-active button').style.background = `linear-gradient(to right,white 0%, white 100%)`;
        PauseVideo();
        LoadAButtons();
    }

</script>
<!---->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let randomNumber = Math.floor(Math.random() * (92 - 20 + 1) + 20);
        let counter = 0;
        let increase = false;

        document.querySelectorAll(".slider__header-views-count").forEach(item => {
            item.innerHTML = randomNumber;

            setInterval(function() {
                if (!increase && counter < 4) {
                    randomNumber--;
                    counter++;
                } else if (increase && counter < 10) {
                    randomNumber++;
                    counter++;
                } else {
                    increase = !increase;
                    counter = 0;
                }
                item.innerHTML = randomNumber;
            }, 1500);
        })
    })
</script>

<!--Закрытие AllLessons-->
<script>
    function notBuy() {
        document.querySelectorAll('.overlay').forEach(item => {
            item.classList.remove('active');
        })
        document.querySelectorAll('.popup').forEach(item => {
            item.classList.remove('active');
        })
    }
</script>

<script>
    let mirrorVideo = document.getElementById('mirrorVideo');
    let sourceVideo = document.querySelectorAll('#sourceVideo');

    document.addEventListener('DOMContentLoaded', function () {
        mirrorVideo.src = sourceVideo[0].src;

        document.querySelectorAll('.slider__video-item').forEach((item) => {
            item.addEventListener('playing', function (){
                if(mirrorVideo.src === item.parentElement.querySelector('source').src){
                    return;
                }else{
                    mirrorVideo.src = item.parentElement.querySelector('source').src;
                }
            })

            // События при конце видео
            item.addEventListener('ended', function (){
                // Каталог
                if (!item.classList.contains("disable-skip")) {

                    NextSlide();
                } else {

                    OpenPopup(item.parentElement.parentElement.querySelector('.button').parentElement);
                }
            })
        })
    })
    
    //отключает таб
    $(document).ready(function() {

        //gather all inputs of selected types
        var inputs = $('input, textarea, select, button');

        //bind on keydown
        inputs.on('keydown', function(e) {

            //if we pressed the tab
            if (e.keyCode == 9 || e.which == 9) {

                //prevent default tab action
                e.preventDefault();

                //get next input based on the current input we left off
                var nextInput = inputs.get(inputs.index(this) + 1);

                //if we have a next input, go to it. or go back
                if (nextInput) {
                    nextInput.focus();
                }
                else{
                    inputs[0].focus();
                }
            }
        });
    });
    $(function() {
        $('.popup__form').each(function (){
            $(this).submit(function(e) {
                e.preventDefault();
                let form = $(this);
                let form_data = $(this).serialize();
                let albato_key;
                if (document.getElementById('albato_key').value.length > 0) {
                    albato_key = document.getElementById('albato_key').value;
                } else {
                    albato_key = null;
                }
                $.ajax({
                    type: 'POST',
                    url: $(this).attr("action"),
                    data: form_data,
                    success: function (data) {
                        if (albato_key !== null) {
                            $.ajax({
                                url: albato_key,
                                type: "POST",
                                data: JSON.stringify(form_data),
                                dataType: 'JSON',
                                success: function(response) {
                                    alert(response);
                                }
                            });
                        }
                        form[0].querySelector('.next__lesson');
                        NextSlide();
                        notBuy()
                        if (form.hasClass('popup__application')) {
                            AddNotifications('Вы успешно оставили заявку', 'Сообщение отправлено на почту');
                        } else {
                            window.open(data);
                            AddNotifications('Вы успешно купили курс', 'Аккаунт отправлен на почту');
                        }
                    },
                    error: function(data) {
                        form[0].querySelector('.next__lesson');
                        NextSlide();
                        notBuy()
                        if (form.hasClass('popup__application')) {
                            AddNotifications('Произошла ошибка', 'Вы уже получали заявку');
                        } else {
                            AddNotifications('Произошла ошибка', 'Вы уже покупали этот курс');
                        }

                    }
                });
                try {
                    if ($(this)[0].querySelector('.new_window')) {
                        window.open($(this)[0].querySelector('.second_link').value);
                    } else {
                        window.location = $(this)[0].querySelector('.second_link').value;
                    }
                } catch {}
            });
        })
    });
</script>
<script>
    function startAccordion() {
        let accordionButton = document.querySelectorAll(".accordion-button");
        let accordionInner = document.querySelectorAll(".accordion .accordion-item .accordion-content");

        for(let i = 0; i < accordionButton.length; i++){
            accordionButton[i].onclick = () =>{
                if(accordionInner[i].classList.contains('active')){
                    accordionInner[i].classList.remove('active')
                    accordionButton[i].classList.remove('active')
                }else{
                    accordionInner[i].classList.add('active')
                    accordionButton[i].classList.add('active')
                }
            }
        }
    }
    startAccordion()
</script>
</body>
</html>


