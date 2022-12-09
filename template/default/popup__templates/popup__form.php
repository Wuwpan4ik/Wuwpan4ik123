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
            <div class="popup__bonus-title  popup-title"><?=$form__title?></div>
            <div class="popup__bonus-text popup-text"><?=$form__desc?></div>
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
                            <img src="/img/smallPlayer/<?=$value?>.svg" alt="">
                        </div>
                        <input name="<?=$input_name?>" type="text" placeholder="Ваш <?=$input?>">
                    </div>
                <?php } ?>
                <?php if (isset($popup__do->form)) { ?>
                    <div class="popup__bonus-form-button button-form">
                        <button class="button next-lesson"><?=$submit__text?></button>
                    </div>
                <?php } else if (isset($popup__do->pay_form)) { ?>
                    <div class="popup__bonus-form-button button-form">
                        <button type="submit" class="button next-lesson2"><?=$submit__text?></button>
                    </div>
                <?php } ?>
            </div>
            </form>
        </div>
    </div>
</div>