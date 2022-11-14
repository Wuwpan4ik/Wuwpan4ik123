<div class="media-cart">
    <div class="media-cart__controller">
        <div class="media-cart__controller-move">
            <div class="media-cart__controller-move-right">
                <button><img src="/img/Arrow-right.svg" alt=""></button>
            </div>
            <div class="media-cart__controller-move-left">
                <button><img src="/img/Arrow-left.svg" alt=""></button>
            </div>
        </div>
        <div class="media-cart__controller-delete">
            <a href="/<?php if(strstr($_SERVER['REQUEST_URI'], 'Course')) {echo 'Course';} else {echo 'Funnel';} ?>/<?=$v['id']?>/delete"><img src="/img/Delete.svg" alt=""></a>
        </div>
    </div>
    <video id="123" class="media-cart-img" style="object-fit: cover;">
        <source class="video" src=".<?=$v['video']?>"/>
    </video>

    <form method="POST" class="new_name" action="/<?php if(strstr($_SERVER['REQUEST_URI'], 'Course')) {echo 'Course';} else {echo 'Funnel';} ?>/<?=$v['id']?>/rename">
        <div>
            <label for="name">Укажите заголовок:</label>
            <input name="name" class="videoname" type="text" value="<?=$v['name']?>">
        </div>
        <div>
            <label for="description">Укажите описание:</label>
            <input name="description" class="videoname video-desc" value="<?=$v['description']?>">
        </div>
        <?php if (strstr($_SERVER['REQUEST_URI'], 'Funnel' )) {?>
        <input type="hidden" value="<?=$v['id']?>">
        <div class="button__do-block <?php if (!isset($v['button_text']) || is_null($v['button_text'])) { ?> display-none <?php } ?>" >
            <label>Текст для кнопки:</label>
            <input name="button_text" class="videoname video-desc" value="<?=$v['button_text']?>">
        </div>
        <button type="button" class="button__edit button__do-block <?php if (!isset($v['button_text']) || is_null($v['button_text'])) { ?> display-none <?php } ?>" style="background: #757D8A;"><img style="width: 22px;"><img style="width: 22px;" src="/img/actions.svg">Действия</button>
        <button type="button" class="button-add-button-edit <?php if (isset($v['button_text']) || !is_null($v['button_text'])) { ?> display-none <?php } ?>">Добавить кнопку</button>
        <?php } ?>
        <button type="submit">Сохранить</button>

    </form>

</div>