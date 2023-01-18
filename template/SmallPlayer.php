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

</head>
<body class="body">
<div class="display-none">
    <?php print_r($_SESSION['error']) ?>
</div>

<div class="mirror_smallPlayer">
    <div class="mirrorWrap"></div>
    <video id="mirrorVideo" src="" playsinline muted></video>
</div>
<div class="smallPlayer _conatiner">
    <div class="smallPlayer__slick-slider">
        <div class="slider__pagination _conatiner-player">
            <div class="slick-dots"></div>
        </div>
        <?php if (!empty($content['course_content'])) { ?>
        <div class="slider">
            <?php
                foreach ($content['funnel_content'] as $item) {
                    if (isset($item['popup'])) $popup = json_decode($item['popup']);
            ?>
            <div class="slider__item">
                <div class="slider__video">
                    <video playsinline class="slider__video-item video-<?=$item['video_id']?>" data-player="playing" autoplay="false">
                        <source class="video" src="/<?=$item['video']?>" id="sourceVideo"  />
                    </video>
                </div>
                <div class="slider__darkness">

                </div>
                <div class="slider__header _conatiner-player ">
                    <div class="slider__header-logo">
                        <div class="slider__header-logo-img">
                            <img width="48px" src="/<? echo (isset($item['avatar'])  ? $item['avatar'] : "uploads/ava/userAvatar.jpg") ?>" alt="">
                        </div>
                        <div class="slider__header-logo-text">
                            <?=$item['first_name']?>
                        </div>
                    </div>
                    <div class="slider__header-views">
                        <div class="slider__header-views-img">
                            <img src="/img/smallPlayer/views.svg" alt="">
                        </div>
                        <div class="slider__header-views-count">
                            <?php echo rand(100, 300)?>
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
                    <div class="slider__item-title <? echo (json_decode($content['main__settings'], true)['title__font'])?>">
                        <?=$item['content_name']?>
                    </div>
                    <div class="slider__item-text <? echo (json_decode($content['main__settings'], true)['desc__font'])?>">
                        <?=$item['content_description']?>
                    </div>
                    <?php
                    if (isset($item['button_text'])) { ?>
                            <div class="slider__item-button button-open">
                                <button style="<? echo (json_decode($content['main__settings'], true)['button__style-color'])?>; <? echo (json_decode($content['main__settings'], true)['button__style-style'])?>" <?php if ($popup->first_do->next_lesson) echo 'onclick="NextSlide('. $item["video_id"] .')"' ?> <?php if (isset($popup->first_do->link)) if ($popup->first_do->open_in_new == 'open_new_window') { echo "onClick=\"window.open('". $popup->first_do->link ."')\""; } else { echo "onclick=\"window.location = ('". $popup->first_do->link ."')\""; } ?> class="button"><?=$item['button_text']?></button>
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
        <?php }?>
        <?php
        include 'template/default/popup__templates/popup__buy.php';
         ?>
    </div>
</div>

<?php include 'template/default/notificationsPopup.php' ?>

<?php if (empty($content['course_content'])) { ?>
    <h1 style="font-size: 34px; color: white; display:flex; justify-content: center">Вы не добавили курс, к которому будет принадлежать воронка или внутри него нет видео!</h1>
<?php } ?>

<script src="/js/notifications.js"></script>
<script src="/js/jquery-3.6.1.min.js" ></script>
<script src="/js/script.js" ></script>
<script src="/js/slick.min.js"></script>
<script src="/js/sliders.js"></script>
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
    function NextSlide(count) {
        document.querySelector('.slick-active button').style.background = `linear-gradient(to right,white 0%, white 100%,lightgrey 100% , lightgrey 0%)`;
        $('.slick-next').click();
    }
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

                // Каталог курса
                if (item.parentElement.parentElement.querySelector('.overlay-allLessons')) {
                    $('.slick-next').click();
                }

                //
                if (item.parentElement.parentElement.querySelector('.popup__bonus')) {
                    OpenPopup(item.parentElement.parentElement.querySelector('.button').parentElement);
                }
            })
        })
        document.querySelectorAll('.slick-arrow').forEach((item) => {
            item.style.display = 'none';
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
                $.post(e.target.action, $(this).serialize());
                try {
                    $(this)[0].querySelector('.next__lesson');
                    NextSlide();
                    notBuy()
                    if ($(this).hasClass('popup__application')) {
                        AddNotifications('Вы успешно оставили заявку', 'Сообщение отправлено на почту');
                    } else {
                        AddNotifications('Вы успешно купили курс', 'Аккаунт отправлен на почту');
                    }

                } catch {}
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


