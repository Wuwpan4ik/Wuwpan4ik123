<div class="media-cart">
    <div class="media-cart__controller">
        <div class="media-cart__controller-move reload_video" data-id="<?=$v['id']?>">
            <div class="media-cart__controller-move-left">
                <button><img src="/img/changeVideo.svg" alt=""></button>
            </div>
        </div>
        <div class="media-cart__controller-delete">
            <button onclick="deleteDirectory(this)"><img src="/img/Delete.svg" alt=""></button>
        </div>
    </div>
    <video id="123" class="media-cart-img" style=" object-fit: cover;">
        <source class="video" src=".<?=$v['video']?>"/>
    </video>
    <img src="<?=$v['thubnails'] ?>" alt="">

    <form method="POST" class="new_name media__form" enctype="multipart/form-data" action="/<?php if(strstr($_SERVER['REQUEST_URI'], 'Course')) {echo 'Course';} else {echo 'Funnel';} ?>/<?=$v['id']?>/rename">

        <input class="funnel__content-id" type="hidden" value="<?=$v['id']?>">
        <?php if (strstr($_SERVER['REQUEST_URI'], 'Funnel' )) {?>
        <div class="funnel-input input_focus">
            <label for="name" class="label_focus activeLabel">Укажите заголовок:</label>
            <input name="name" maxlength="30" class="videoname video-desc" type="text" value="<?=$v['name']?>">
            <span class="clear_input_val">
        <img src="/img/clear_input.svg" alt="">
        </span>
        </div>
        <div>
            <textarea name="description" class="videoname video-desc textarea-info " maxlength="100"><?=$v['description']?></textarea>
            <span class="placeholder-textarea">Укажите описание</span>
        </div>
        <div class="button__do-block <?php if (!isset($v['button_text']) || is_null($v['button_text'])) { ?> display-none <?php } ?>" >
            <div class="funnel-input input_focus">
                <label for="name" class="label_focus">Текст для кнопки:</label>
                <input name="button_text" maxlength="15" class="videoname video-desc" type="text" value="<?=$v['button_text']?>">
                <span class="clear_input_val">
            <img src="/img/clear_input.svg" alt="">
            </span>
            </div>

        </div>
         <button onclick="click_settings(this)" type="button" class="button__edit button__do-block <?php if (!isset($v['button_text'])) { ?> display-none <?php } ?>" style="background: #757D8A;text-align: center"><img style="width: 25px; transform: translate(0, 0)" src="/img/actions.svg">Действия</button>
            <?php if (!isset($v['button_text'])) { ?> <button type="button" class="button-add-button-edit"><img src="../img/addSocialNetwork.svg" alt="">Добавить кнопку</button><?php } ?>
        <?php } else { ?>
            <div class="funnel-input input_focus">
                <label for="name" class="label_focus">Укажите заголовок:</label>
                <input name="name" maxlength="30" class="videoname video-desc" type="text" value="<?=$v['name']?>">
                <span class="clear_input_val">
            <img src="/img/clear_input.svg" alt="">
            </span>
            </div>

            <div>
                <textarea name="description" class="videoname video-desc textarea-info " maxlength="100"><?=$v['description']?></textarea>
                <span class="placeholder-textarea">Укажите описание</span>
            </div>


            <div class="funnel-input input_focus" style="display:none;">
                <label for="name" class="label_focus">Укажите стоимость урока:</label>
                <input name="price" class="videoname video-desc" type="number" min="100" max="100000" maxlength="6" value="<?=$v['price'] ?>">
                <span class="clear_input_val">
            <img src="/img/clear_input.svg" alt="">
            </span>
            </div>

            <div class="file_input">
                <span>
                    Прикрепите файл к уроку:
                </span>
                <div class="avatar inCourse">
                    <div class="avatar-body">
                        <img src="../img/saveAvatar.svg" alt="">
                        <div class="avatar-body__info">
                            <span id="file-name" class="file-box file_name">
                                <?php if (isset($v['file_url'])) {print_r(substr(basename($v['file_url']), 0, 10));} else {echo 'Название файла';}?>
                            </span>
                            <span id="file-size" class="file-box file_size">
                                <?php if (isset($v['file_url'])) {print_r(round(filesize($v['file_url']) / 1024));} else {echo '0';} ?>кб из 5мб
                            </span>
                        </div>
                    </div>
                    <div class="input__wrapper">
                        <input name="file" type="file" id="input__file" class="input input__file" onchange="uploadFile(this)" multiple="">
                        <label for="input__file" class="input__file-button" style="">
                            <span class="input__file-icon-wrapper"><img class="input__file-icon" src="/img/plus.svg" width="25"></span>
                            <span class="input__file-button-text ">Добавить</span>
                        </label>
                    </div>
                </div>
            </div>
        <?php } ?>
        <button class="blue-button save-btn" type="submit">Сохранить</button>
    </form>
</div>
