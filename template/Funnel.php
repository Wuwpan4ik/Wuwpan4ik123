<html>

<head>

    <meta charset="utf-8">

    <title>Моя тестовая страница</title>

    <link rel="stylesheet" href="css/project.css">

    <link rel="stylesheet" href="css/feed.css">

    <link rel="stylesheet" href="css/lessons.css">

    <link rel="stylesheet" href="css/main.css">

</head>

<body>

<div class="Project">

    <?php include 'default/sidebar.php'; ?>

    <div class="feed">

        <div class="feed-header">

            <h2>Мои воронки</h2>

            <div class="buttonsFeed">

                <button class="ico_button"><img class="ico" src="img/Shield.svg"></button>

                <button class="ico_button"><img class="ico" src="img/Bell.svg"></button>

                <button id="apps" class="ico_button">Заявки</button>

            </div>

        </div>

        <div class="Lessons">

            <div class="media">

                <?php

                $k = 1;

                foreach($content[0] as $p){?>

                    <div class="media-cart">

                        <div class="media-cart-img">

                            <?

                            $i=1;

                            foreach($content[1] as $v){
                                if ($v['funnel_id'] == $p['id']) {
                                    if($i == 1){?>

                                        <input checked="checked" type="radio" id="<?=$v['id']?>" name="<?=$p['id']?>_video"/>

                                    <?}else{?>

                                        <input type="radio" id="<?=$v['id']?>" name="<?=$p['id']?>_video"/>

                                    <?}?>

                                    <label for="<?=$v['id']?>" style="width: calc(95% / 4);"></label>

                                    <video class="project_video" preload="metadata" controls="controls" src="<?=$v['video']?>">

                                    </video>

                                    <?$i++;}}?>

                        </div>

                        <p>Воронка №<?=$k?></p>

                        <h3><?=$p['name']?></h3>

                        <div style="display:flex;">

                            <input id="half_input" placeholder="https://translate.google.ru"/>

                            <button type="submit">Копировать</button>

                        </div>

                        <div class="btn-delete-edit">

                            <input type="hidden" value="<?=$p['id']?>" >

                            <button type="submit" onclick="window.location.href = '?option=FunnelEdit&id=<?=$p['id']?>';"">Изменить</button>

                            <button class="reboot" type="submit" onclick="deleteDirectory(this)">Удалить</button>

                        </div>

                    </div>

                    <?$k++;}?>

                <div class="media-cart placeholder">

                    <div class="btn-upload">

                        <a  href="?option=DirectoryController&method=Create&folder=funnel" class="create-new">

                            <img src="img/Create.svg" class="create-ico">

                            <p>Создать<br> новую воронку</p>

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
<div id="popup__background">
    <div id="popup">
        <div class="popup__container">
            <div class="popup__title">Вы действительно хотите удалить проект?</div>
            <div class="popup__form">
                <button class="popup__btn popup__not-delete">Не удалять</button>
                <button class="popup__btn popup__delete">Удалить</button>
            </div>
        </div>
    </div>
</div>
<script src="../js/script.js"></script>

<script>
    let deleteButtons = document.querySelectorAll('.reboot');
    let notDelete = document.querySelector('.popup__not-delete');
    let deletes = document.querySelector('.popup__delete');
    let entryDisplay = document.querySelector('#popup__background');
    let body = document.querySelector('body');
    function toggleOverflow () {
        body.classList.toggle("overflow-hidden");
    }
    function deleteDirectory(elem) {
        entryDisplay.classList.add('display-block');
        toggleOverflow();
        deletes.addEventListener('click',function () {
            window.location.href = '?option=DirectoryController&method=Delete&id='+ elem.parentElement.children[0].value + '&folder=funnel';
        });
    }
    notDelete.onclick = function (event) {
        if (event.target === notDelete) {
            entryDisplay.classList.remove('display-block');
            toggleOverflow();
        }
    }
    entryDisplay.onclick = function (event) {
        if (event.target === entryDisplay) {
            toggleOverflow();
            entryDisplay.classList.remove('display-block');
        }
    }
</script>
</body>

</html>