<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ccio</title>

    <link type="text/css" rel="stylesheet" href="../css/smallPlayer.css">
</head>
<body>
<div class="smallPlayer _conatiner">
    <div class="smallPlayer__slick-slider">
        <div class="slider__pagination _conatiner-player">
            <div class="slick-dots"></div>
        </div>
        <div class="slider">

            <?php foreach ($content['funnel_content'] as $item) {
                $popup = json_decode($item['popup']);
            ?>
            <div class="slider__item ">
                <div class="slider__video">
                    <video id="123" class="slider__video-item"
                    <source  class="video" src=".<?=$item['video']?>" />
                    </video>
                </div>
                <div class="slider__header _conatiner-player ">
                    <div class="slider__header-logo">
                        <div class="slider__header-logo-img">
                            <img width="48  px" src="<?=$item['avatar']?>" alt="">
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
                    if (isset($popup)) { ?>
                    <div class="slider__item-button button-open">
                        <button  class="button"><?=$item['button_text']?></button>
                    </div>
                    <?php } ?>
                </div>
                <?php
                if (isset($popup->form)) { ?>
                <div class="overlay-bonus overlay">
                    <div class="popup__bonus  popup">
                        <div class="popup__bonus-body">
                            <div class="popup__bonus-title  popup-title">Введите ваш email что бы продолжить просмотр</div>
                            <div class="popup__bonus-text popup-text"><span> Бонус:</span> получите книгу - Тысяча способов научиться решать проблемы самостоятельно!</div>
                            <div class="popup__bonus-form">
                                <?php foreach ($popup->form as $input) {
                                    ?>
                                <div class="popup__bonus-form-input input">
                                    <div class="popup__bonus-form-input-email input-img">
                                        <?php
                                        $value = '';
                                        if ($input == 'email') {
                                            $value = 'email';
                                        } elseif ($input == 'name') {
                                            $value = 'account';
                                        } elseif ($input == 'tel') {
                                            $value = 'phone';
                                        }?>
                                        <img src="../img/smallPlayer/<?=$value ?>.svg" alt="">
                                    </div>
                                    <input name="<?=$input?>" type="text" placeholder="Ваш <?=$input?>">
                                </div>
                                    <?php } ?>
                                <div class="popup__bonus-form-button button-form">
                                    <button class="button">Получить подарок</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pause__video">
                    <img src="../img/smallPlayer/pause.svg" alt="">
                </div>
            <?php } ?>

                <?php if (isset($popup->list)) { ?>
                    <div class="overlay-allLessons overlay">
                        <div class="popup__allLessons popup">
                            <div class="popup__allLessons-body">
                                <div class="popup__allLessons-title popup-title">Все уроки курса:</div>
                                <div class="popup__allLessons-text popup-text">Курс состоит из <?=count($content['course_content']); ?> уроков</div>
                                <div class="popup__allLessons-body">
                                    <?php $count = 1; foreach ($content['course_content'] as $item) { ?>
                                    <div class="popup__allLessons-item popup-item">
                                        <div class="popup__allLessons-item-video">
                                            <div class="popup__allLessons-item-video-play">
                                                <img src="../img/smallPlayer/play.png" alt="">
                                            </div>
                                            <img src="../img/smallPlayer/Group1426.png" alt="">
                                        </div>
                                        <div class="popup__allLessons-item-info">
                                            <div class="popup__allLessons-item-info-header">
                                                <div class="popup__allLessons-item-info-header-number">
                                                    0<?=$count ?>
                                                </div>
<!--                                                <div class="popup__allLessons-item-info-header-time">-->
<!--                                                    22 минуты-->
<!--                                                </div>-->
                                            </div>
                                            <div class="popup__allLessons-item-info-title">
                                                <?=$item['name']?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php $count += 1; } ?>
                                </div>
                            </div>
                            <div class="popup__allLessons-form">
                                <div class="popup__allLessons-form-buy button-open">
                                    <button class="button button-buy">Купить весь курс за <?php print_r($content['course_sum']) ?> руб.</button>
                                </div>
                                <div class="popup__allLessons-form-notBuy">
                                    <button class="button button-notBuy">Пока не хочу покупать</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <? } ?>
            </div>
            <? } ?>
        </div>
        <div class="popup__buy popup">
            <div class="popup__buy-body">
                <div class="popup__buy-title popup-title">Вы выбрали:</div>
                <div class="popup__buy-body">
                    <div class="popup__buy-item popup-item">
                        <div class="popup__allLessons-item-video">
                            <div class="popup__allLessons-item-video-play">
                                <img src="../img/smallPlayer/play.png" alt="">
                            </div>
                            <img src="../img/smallPlayer/Group1426.png" alt="">
                        </div>
                        <div class="popup__allLessons-item-info">
                            <div class="popup__allLessons-item-info-header">
                                <div class="popup__allLessons-item-info-header-number">
                                    01
                                </div>
                                <div class="popup__allLessons-item-info-header-time">
                                    22 минуты
                                </div>
                            </div>
                            <div class="popup__allLessons-item-info-title">
                                Управление гневом внутри себя
                            </div>
                        </div>
                    </div>
                </div>
                <div class="popup__buy-price">
                    <div class="popup__buy-price-title">
                        Стоимость урока:
                    </div><div class="popup__buy-price-cost">
                        250 руб.
                    </div>
                </div>
                <div class="popup__buy-register">
                    <div class="popup__buy-body-form input">
                        <div class="popup__bonus-form-input-account input-img">
                            <img src="../img/smallPlayer/account.svg" alt="">
                        </div>
                        <input type="text" placeholder="Ваше имя">
                    </div>
                    <div class="popup__buy-body-form  input">
                        <div class="popup__bonus-form-input-email input-img">
                            <img src="../img/smallPlayer/email.svg" alt="">
                        </div>
                        <input type="text" placeholder="Ваш email">
                    </div>
                    <div class="popup__buy-body-form  input">
                        <div class="popup__bonus-form-input-phone input-img">
                            <img src="../img/smallPlayer/phone.svg" alt="">
                        </div>
                        <input type="text" placeholder="Ваш телефон">
                    </div>
                </div>

                <div class="popup__buy-form-buy-button">
                    <div class="popup__buy-form-buy button-form">
                        <button class="button button-back">Назад</button>
                    </div>
                    <div class="popup__buy-form-back button-form">
                        <button class="button">Перейти к оплате</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.1.min.js" ></script>
<script src="../js/script.js" ></script>
<script src="../js/slick.min.js"></script>
<script src="../js/sliders.js"></script>


</body>
</html>


