<div class="overlay-bonus overlay overlay-<?=$name?>">
    <div class="popup__bonus  popup popup-<?=$name?>">
        <div class="popup__bonus-body">
            <form class="popup__form" method="POST" action="<?php if (isset($popup__do->form)) { echo '/ClientsController/application';} else { echo '/ClientsController/CourseBuy';}?>">
                <input type="text" hidden="hidden" name="course_id" value="<?=$id?>">
                <input type="text" hidden="hidden" name="creator_id" value="<?=$author_id?>">
            <?php if (isset($file)) { ?>
                <input type="text" hidden="hidden" name="second_file" value="<?=$file?>">
            <?php } ?>
            <?php if (isset($second_link)) { ?>
                <input class="second_link" type="text" hidden="hidden" name="second_link" value="<?=$second_link?>">
            <?php } ?>
            <?php if (isset($popup->second_do->next__lesson)) { ?>
                <input class="next__lesson" type="text" hidden="hidden" name="second_link" value="<?=$next__lesson?>">
            <?php } ?>
            <?php if (isset($popup__do->form)) { ?>
                <div class="popup__bonus-title  popup-title">Введите ваш email что бы продолжить просмотр</div>
                <div class="popup__bonus-text popup-text"><span> Бонус:</span> получите книгу - Тысяча способов научиться решать проблемы самостоятельно!</div>
            <?php } else if (isset($popup__do->pay_form)) { ?>
                <div class="popup__bonus-title  popup-title">Введите данные для покупки курса</div>
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
                                $input_name = 'email';
                            } elseif ($input == 'name') {
                                $value = 'account';
                                $input_name = 'first_name';
                            } elseif ($input == 'tel') {
                                $value = 'phone';
                                $input_name = 'phone';
                            }?>
                            <img src="../img/smallPlayer/<?=$value ?>.svg" alt="">
                        </div>
                        <input name="<?=$input_name?>" type="text" placeholder="Ваш <?=$input?>">
                    </div>
                <?php } ?>
                <?php if (isset($popup__do->form)) { ?>
                    <div class="popup__bonus-form-button button-form">
                        <button class="button next-lesson">Получить подарок</button>
                    </div>
                <?php } else if (isset($popup__do->pay_form)) { ?>
                    <div class="popup__bonus-form-button button-form">
                        <button type="submit" class="button next-lesson2">Оплатить</button>
                    </div>
                <?php } ?>
            </div>
            </form>
        </div>
    </div>
</div>