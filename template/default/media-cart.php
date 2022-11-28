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
            <button class="button" onclick="deleteDirectory(this)"><img src="/img/Delete.svg" alt=""></button>
        </div>
    </div>
    <video id="123" class="media-cart-img" style="object-fit: cover;">
        <source class="video" src=".<?=$v['video']?>"/>
    </video>
    <img src="<?=$v['thubnails'] ?>" alt="">

    <form method="POST" class="new_name" action="/<?php if(strstr($_SERVER['REQUEST_URI'], 'Course')) {echo 'Course';} else {echo 'Funnel';} ?>/<?=$v['id']?>/rename">
        <input type="text" name="id" hidden="hidden" value="<?=$v['id']?>">
        <div class="funnel-input input_focus">
            <?php if (isset($v['name'])) { ?>
                <label for="name" class="label_focus activeLabel">Укажите заголовок:</label>
                <input name="name" class="videoname" type="text" value="<?=$v['name']?>">
                <span class="clear_input_val">
                <img src="/img/clear_input.svg" alt="">
                </span>
            <? } else { ?>
                <label for="name" class="label_focus">Укажите заголовок:</label>
                <input name="name" class="videoname" type="text" value="">
                <span class="clear_input_val">
                <img src="/img/clear_input.svg" alt="">
                </span>
            <? } ?>
        </div>
        <div class="funnel-input input_focus">
            <?php if (isset($v['description'])) { ?>
                <label for="description" class="label_focus activeLabel">Укажите описание:</label>
                <textarea name="description" class="videoname video-desc"><?=$v['description']?></textarea>
                <span class="clear_input_val">
                    <img src="/img/clear_input.svg" alt="">
                </span>
            <? } else {?>
                <label for="description" class="label_focus">Укажите описание:</label>
                <textarea name="description" class="videoname video-desc"></textarea>
                <span class="clear_input_val">
                <img src="/img/clear_input.svg" alt="">
            </span>
            <? } ?>
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

    <!--For Input Holders-->
    <script src="/js/jquery-3.6.1.min.js"></script>
    <script>
        window.onload = () =>{
            let inputs = document.querySelectorAll('.input_focus input, textarea');
            let inputsLabel = document.querySelectorAll('.input_focus label');
            let inputClear = document.querySelectorAll('.input_focus span');
            let textAreas = document.querySelectorAll('.input_focus textarea');

            for(let i =0; i < inputs.length; i++){
                inputs[i].addEventListener('input', function(){
                    if(inputs[i].value != ""){
                        inputsLabel[i].classList.add('activeLabel');
                        inputClear[i].classList.add('has_content');
                    }
                    else {
                        inputsLabel[i].classList.remove('activeLabel');
                        inputClear[i].classList.remove('has_content');
                    }
                });

                inputClear[i].onclick = () =>{
                    inputsLabel[i].classList.remove('activeLabel')
                    inputs[i].value = "";
                    inputClear[i].classList.remove('has_content')
                }
            }
        }
    </script>
</div>