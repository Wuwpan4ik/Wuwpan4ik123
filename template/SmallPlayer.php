<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ccio</title>
    <link rel="stylesheet" href="/css/sidebar.css">

    <link type="text/css" rel="stylesheet" href="/css/smallPlayer.css">

</head>
<body class="body">
<div class="smallPlayer _conatiner">
    <div class="smallPlayer__slick-slider">
        <div class="slider__pagination _conatiner-player">
            <div class="slick-dots"></div>
        </div>
        <?php if (!empty($content['course_content'])) { ?>
        <div class="slider">

            <?php
                foreach ($content['funnel_content'] as $item) {
                $popup = json_decode($item['popup']);
            ?>
            <div class="slider__item ">
                <div class="slider__video">
                    <video id="123" class="slider__video-item">
                         <source class="video" src=".<?=$item['video']?>" />
                    </video>
                </div>
                <div class="slider__header _conatiner-player ">
                    <div class="slider__header-logo">
                        <div class="slider__header-logo-img">
                            <img width="48  px" src="/<?=$item['avatar']?>" alt="">
                        </div>
                        <div class="slider__header-logo-text">
                            <?=$item['first_name']?>
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
                        <?=$item['content_name']?>
                    </div>
                    <div class="slider__item-text">
                        <?=$item['content_description']?>
                    </div>
                    <?php
                    if (isset($item['button_text'])) { ?>
                    <div class="slider__item-button button-open">
                        <button  class="button"><?=$item['button_text']?></button>
                    </div>
                    <?php } ?>
                </div>
                <?php
                // popup при клике
                if (isset($popup->second_do->form) || isset($popup->second_do->pay_form)) {
                    if (isset($popup->second_do->form)) {
                        $form = $popup->second_do->form;
                    } else {
                        $form = $popup->second_do->pay_form;
                    }
                    // Первое или второе действие
                    $name = 'button';
                    $popup__do = $popup->second_do;
                    $id = $item['id'];
                    $author_id = $item['author_id'];
                    include 'template/default/popup__templates/popup__form.php';
                } ?>
                <?php
                if (isset($popup->first_do->form) || isset($popup->first_do->pay_form)) {
                    if (isset($popup->first_do->form)) {
                        $form = $popup->first_do->form;
                    } else {
                        $form = $popup->first_do->pay_form;
                    }
                    // Первое или второе действие
                    $name = 'video';
                    $popup__do = $popup->first_do;
                    $id = $item['id'];
                    $author_id = $item['author_id'];
                    include 'template/default/popup__templates/popup__form.php';
                }
                ?>

                <?php if (isset($popup->second_do->list)) {
                    $name = 'button';
                    include 'template/default/popup__templates/popup__all-lessons.php'; }
                ?>
                <?php if (isset($popup->first_do->list)) {
                    $name = 'video';
                    include 'template/default/popup__templates/popup__all-lessons.php'; }
                ?>
            </div>
            <?php } ?>
        </div>
        <?php }?>
        <?php if (isset($popup->second_do->list) || isset($popup->first_do->list)) {
        include 'template/default/popup__templates/popup__buy.php';
        } ?>
    </div>
</div>

<?php if (empty($content['course_content'])) { ?>
    <h1 style="font-size: 34px; color: white; display:flex; justify-content: center">Вы не добавили курс, к которому будет принадлежать воронка или внутри него нет видео!</h1>
<?php } ?>

<script src="https://code.jquery.com/jquery-3.6.1.min.js" ></script>
<script src="../js/script.js" ></script>
<script src="../js/slick.min.js"></script>
<script src="../js/sliders.js"></script>
<script>

</script>
</body>
</html>


