<div class="overlay-bonus overlay overlay-<?=$name?>">
    <div class="popup__bonus  popup popup-<?=$name?>">
        <div class="popup__bonus-body">
            <?php if (isset($popup__do->form)) { ?>
                <div class="popup__bonus-title  popup-title">Введите ваш email что бы продолжить просмотр</div>
                <div class="popup__bonus-text popup-text"><span> Бонус:</span> получите книгу - Тысяча способов научиться решать проблемы самостоятельно!</div>
            <?php } else if (isset($popup__do->pay_form)) { ?>
                <div class="popup__bonus-title  popup-title">Введите данные и перейдите к оплате, чтобы продолжить просмотр</div>
            <?php } ?>
            <div class="popup__bonus-form">
                <?php foreach ($form as $input) {
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
                <?php if (isset($popup__do->form)) { ?>
                    <div class="popup__bonus-form-button button-form">
                        <button class="button next-lesson ">Получить подарок</button>
                    </div>
                <?php } else if (isset($popup__do->pay_form)) { ?>
                    <div class="popup__bonus-form-button button-form">
                        <button class="button next-lesson">Оплатить</button>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>