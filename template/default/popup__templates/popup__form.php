<div class="overlay-bonus overlay overlay-<?=$name?>">
    <div class="whiteSpace" style="position: absolute;top: 0;width: 100%;">

    </div>
    <div class="popup__bonus  popup popup-<?=$name?>">
        <div class="popup__bonus-body">
            <form class="popup__form <?php if (isset($popup__do->form)) echo 'popup__application' ?>" method="POST" action="<?php if (isset($popup__do->form)) { echo '/ClientsController/application';} else { echo '/ClientsController/CourseBuy';}?>">
                <input type="text" hidden="hidden" name="course_id" value="<?=$id?>">
                <input type="text" hidden="hidden" name="creator_id" value="<?=$author_id?>">
                <?php if (isset($funnel_id)) { ?>
                    <input type="text" hidden="hidden" name="funnel_id" value="<?=$funnel_id?>">
                <?php } ?>
                <?php if (isset($slider_id)) { ?>
                    <input type="text" hidden="hidden" name="slide_id" value="<?=$slider_id?>">
                <?php } ?>
                <?php if (isset($file)) { ?>
                    <input type="text" hidden="hidden" name="second_file" value="<?=$file?>">
                <?php } ?>
                <?php if (isset($second_link)) { ?>
                    <input class="second_link" type="text" hidden="hidden" name="second_link" value="<?=$second_link?>">
                <?php } ?>
                <?php if ($new_window) { ?>
                    <input class="new_window" type="text" hidden="hidden" name="second_link" value="<?=$new_window?>">
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
                                    $type = 'email';
                                    $input_name = 'email';
                                    $text = 'Ваша почта';
                                } elseif ($input == 'name') {
                                    $value = 'account';
                                    $type = 'text';
                                    $input_name = 'first_name';
                                    $text = 'Ваше имя';
                                } elseif ($input == 'tel') {
                                    $value = 'phone';
                                    $type = 'tel';
                                    $input_name = 'phone';
                                    $text = 'Ваш номер телефона';
                                }?>
                                <img src="/img/smallPlayer/<?=$value?>.svg" alt="">
                            </div>
                            <input name="<?=$input_name?>" type="<?=$type?>" placeholder="<?=$text?>" required>
                        </div>
                    <?php } ?>
                    <?php if (isset($popup__do->form)) { ?>
                        <div class="popup__bonus-form-button button-form">
                            <button class="button next-lesson" style="<? echo (json_decode($content['main__settings'], true)['button__style-color'])?>; <? echo (json_decode($content['main__settings'], true)['button__style-style'])?>"><?=$submit__text?></button>
                        </div>
                    <?php } else if (isset($popup__do->pay_form)) { ?>
                        <div class="popup__bonus-form-button button-form">
                            <button type="submit" class="button next-lesson2" style="<? echo (json_decode($content['main__settings'], true)['button__style-color'])?>; <? echo (json_decode($content['main__settings'], true)['button__style-style'])?>"><?=$submit__text?></button>
                        </div>
                    <?php } ?>
                </div>
            </form>
        </div>
    </div>
</div>