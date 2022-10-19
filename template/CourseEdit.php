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

    <?php include 'default/sidebar.php';?>

    <div class="feed">

        <div class="feed-header">

            <div class="feed-menu">

                <a href="?option=Project"><button class="back_button"><img class="ico" src="img/StickLeft.svg"></button></a>

                <form action="?option=DirectoryController&method=setName&id=<?=$content[0][0]['id']?>&folder=course" method="POST" id="insert">

                    <h2 id="display_name"><?=$content[0][0]['name']?></h2>

                    <button class="none"><img id="name_change" src="img/Pen.svg" class="ico" onclick="changeName()"></button>

                </form>

                <script>

                    function changeName(){

                        document.getElementById("insert").innerHTML = '<input class="proj_name" name="title" placeholder="Введите новое название"><button type="submit" class="none"><img id="name_change" src="img/Pen.svg" class="ico"></button>';

                        document.getElementById("name_change").style.background = "linear-gradient(180deg, #6989FE 0%, #3C64F4 100%)";

                        document.getElementById("name_change").style.borderRadius = "8px";

                    }

                </script>

            </div>

            <div class="buttonsFeed">

                <button class="ico_button"><img class="ico" src="img/Shield.svg"></button>

                <button class="ico_button"><img class="ico" src="img/Bell.svg"></button>

                <button id="apps" class="ico_button">Заявки</button>

            </div>

        </div>

        <div class="Lessons">

            <div class="media">

                <?php
                foreach($content[1] as $v){?>

                    <div class="media-cart">

                        <video preload="metadata" controls="controls" class="media-cart-img" src="<?=$v['video']?>"></video>

                        <form method="POST" class="new_name" action="?option=FunnelController&method=renameVideo&id_item=<?=$v['id']?>&id=<?=$content[0][0]['id']?>">
                            <div>
                                <label for="name">Укажите заголовок:</label>
                                <input name="name" class="videoname" type="text" placeholder="<?=$v['name']?>" required>
                            </div>
                            <div>
                                <label for="description">Укажите описание:</label>
                                <textarea style="resize: none; height: 60px;" name="description" class="videoname" placeholder="<?=$v['description']?>" required></textarea>
                            </div>
                            <input type="hidden" value="<?=$v['id']?>">
                            <button type="submit">Сохранить</button>

                        </form>

                    </div>

                <?}

                ?>

                <div class="media-cart placeholder">

                    <div class="btn-upload">

                        <form class="upload__form" id="upload_form" enctype="multipart/form-data" method="post">

                            <input class="upload_video" accept=".mp4" style="display:none;" id="video" name="video_uploader" type="file"/>

                            <label class="upload_video upload__label" for="video"><img src="img/Create.svg" class="create-ico"><span>Добавьте видео</span></label>

                            <div class="progress" id="progressDiv">
                                <progress id="progressBar" value="0" max="100" style="width:100%; height: 1.2rem;">
                                </progress>
                            </div>

                            <button class="upload_video" type="button" onclick="uploadFileHandler()">Сохранить</button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
<script src="../js/button__settings.js"></script>
<script>
    function _(abc) {
        return document.getElementById(abc);
    }
    function uploadFileHandler() {
        var file = document.getElementById("video").files[0];
        if (file.length === 0) {
            return false;
        }
        document.querySelectorAll('.upload_video').forEach((elem) => {
            elem.style.display = 'none';
        })
        _("progressBar").classList.add('active');
        var formdata = new FormData();
        formdata.append("video_uploader", file);
        var ajax = new XMLHttpRequest();
        ajax.upload.addEventListener("progress", progressHandler, false);
        ajax.addEventListener("load", completeHandler, false)
        ajax.open("POST", "?option=VideoController&method=addVideo&id=<?=$content[0][0]['id']?>&folder=course");
        ajax.send(formdata);
    }
    function progressHandler(event) {
        var loaded = new Number((event.loaded / 1048576));//Make loaded a "number" and divide bytes to get Megabytes
        var total = new Number((event.total / 1048576));//Make total file size a "number" and divide bytes to get Megabytes
        var percent = (event.loaded / event.total) * 100;//Get percentage of upload progress
        _("progressBar").value = Math.round(percent);//Round value to solid
    }
    function completeHandler(event) {
       _("progressBar").value = 0;//Set progress bar to 0
        document.getElementById('progressDiv').style.display = 'none';//Hide progress bar
        location.reload();
    }
</script>
</body>

</html>