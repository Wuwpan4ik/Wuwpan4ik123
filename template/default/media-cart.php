<div class="media-cart">

    <video preload="metadata" controls="controls" class="media-cart-img" src="<?=$v['video']?>"></video>

    <form method="POST" class="new_name" action="?option=VideoController&method=renameVideo&id_item=<?=$v['id']?>&id=<?=$content[0][0]['id']?>">
        <div>
            <label for="name">Укажите заголовок:</label>
            <input name="name" class="videoname" type="text" placeholder="<?=$v['name']?>" required>
        </div>
        <div>
            <label for="description">Укажите описание:</label>
            <textarea style="resize: none; height: 60px;" name="description" class="videoname" placeholder="<?=$v['description']?>" required></textarea>
        </div>
        <?php if (in_array($_GET['option'], ['Funnel', 'FunnelEdit'] )) {?>
        <div>
            <label for="button_text">Текст для кнопки:</label>
            <input name="button_text" class="videoname" type="text" placeholder="<?=$v['button_text']?>" required>
        </div>
        <input type="hidden" value="<?=$v['id']?>">
        <button type="button" class="button__edit" style="background: #757D8A;"><img style="width: 22px;" src="../img/printer.png">Действие для кнопки</button>
        <?php } ?>
        <button type="submit">Сохранить</button>

    </form>

</div>