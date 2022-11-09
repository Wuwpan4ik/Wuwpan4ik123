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
            <a href="?option=VideoController&method=Delete&item_id=<?=$v['id']?>&folder=<? if ($_GET['option'] == "CourseEdit") {echo 'course';} else {echo 'funnel';}?>"><img src="/img/Delete.svg" alt=""></a>
        </div>
    </div>
    <video id="123" class="media-cart-img" style="object-fit: cover;">
        <source class="video" src=".<?=$v['video']?>"/>
    </video>

    <form method="POST" class="new_name" action="?option=VideoController&method=renameVideo&id_item=<?=$v['id']?>&id=<?=$content[0][0]['id']?>">
        <div>
            <label for="name">Укажите заголовок:</label>
            <input name="name" class="videoname" type="text" placeholder="<?=$v['name']?>" required>
        </div>
        <div>
            <label for="description">Укажите описание:</label>
            <input name="description" class="videoname video-desc" placeholder="<?=$v['description']?>" required></input>
        </div>
        <?php if (in_array($_GET['option'], ['Funnel', 'FunnelEdit'] )) {?>
        <input type="hidden" value="<?=$v['id']?>">
        <button type="button" class="button__edit" style="background: #757D8A;"><img style="width: 22px;" src="../img/printer.png">Действие для кнопки</button>
        <?php } ?>
        <button type="submit">Сохранить</button>

    </form>

</div>