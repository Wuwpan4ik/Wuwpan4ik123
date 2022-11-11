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
            <a href="<?php if(strstr($_SERVER['REQUEST_URI'], 'Course')) {echo 'Course';} else {echo 'Funnel';} ?>/<?=$v['id']?>/delete"><img src="/img/Delete.svg" alt=""></a>
        </div>
    </div>
    <video id="123" class="media-cart-img" style="object-fit: cover;">
        <source class="video" src=".<?=$v['video']?>"/>
    </video>

    <form method="POST" class="new_name" action="/<?php if(strstr($_SERVER['REQUEST_URI'], 'Course')) {echo 'Course';} else {echo 'Funnel';} ?>/<?=$v['id']?>/rename">
        <div>
            <label for="name">Укажите заголовок:</label>
            <input name="name" class="videoname" type="text" placeholder="<?=$v['name']?>" required>
        </div>
        <div>
            <label for="description">Укажите описание:</label>
            <input name="description" class="videoname video-desc" placeholder="<?=$v['description']?>" required></input>
        </div>
        <?php if (strstr($_SERVER['REQUEST_URI'], 'Funnel' )) {?>
        <input type="hidden" value="<?=$v['id']?>">
        <button type="button" class="button-add-button-edit" onclick="onButtonEdit(this)">Добавить кнопку</button>
        <button type="button" class="button__edit display-none" style="background: #757D8A;"><img style="width: 22px;" src="/img/printer.png">Действие для кнопки</button>
        <?php } ?>
        <button type="submit">Сохранить</button>

    </form>

</div>