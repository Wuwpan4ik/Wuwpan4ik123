<div class="media-cart">
    <div class="media-cart__controller">
        <div class="media-cart__controller-delete">
            <button class="button" onclick="deleteDirectory(this)"><img src="/img/Delete.svg" alt=""></button>
        </div>
    </div>
    <video id="123" class="media-cart-img" style="object-fit: cover;">
        <source class="video" src=".<?=$v['video']?>"/>
    </video>
    <img src="<?=$v['thubnails'] ?>" alt="">

    <form method="POST" class="new_name" action="/<?php if(strstr($_SERVER['REQUEST_URI'], 'Course')) {echo 'Course';} else {echo 'Funnel';} ?>/<?=$v['id']?>/rename">
        <input type="text" name="id" hidden="hidden" value="<?=$v['id']?>">
        <div class="funnel-input">
            <label for="name">Укажите заголовок:</label>
            <input name="name" class="videoname" type="text" value="<?=$v['name']?>">
        </div>
        <div class="funnel-input">
            <label for="description">Укажите описание:</label>
            <textarea name="description" class="videoname video-desc"><?=$v['description']?></textarea>
        </div>
        <?php if (strstr($_SERVER['REQUEST_URI'], 'Funnel' )) {?>
        <input type="hidden" value="<?=$v['id']?>">
        <div class="button__do-block <?php if (!isset($v['button_text']) || is_null($v['button_text'])) { ?> display-none <?php } ?>" >
            <label>Текст для кнопки:</label>
            <input name="button_text" class="videoname video-desc" value="<?=$v['button_text']?>">
        </div>
         <button type="button" class="button__edit button__do-block <?php if (!isset($v['button_text'])) { ?> display-none <?php } ?>" style="background: #757D8A;text-align: center"><img style="width: 25px; transform: translate(0, 0)" src="/img/actions.svg">Действия</button>
            <?php if (!isset($v['button_text'])) { ?> <button type="button" class="button-add-button-edit">Добавить кнопку</button><?php } ?>
        <?php } ?>
        <button type="submit">Сохранить</button>

    </form>

</div>