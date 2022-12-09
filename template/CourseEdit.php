<html>

<head>

    <meta charset="utf-8">

    <title>Course Creator - Редактирование курса</title>

    <link rel="stylesheet" href="/css/nullCss.css">

    <link rel="stylesheet" href="/css/smallPlayer.css">

    <link rel="stylesheet" href="/css/lessons.css">

    <link rel="stylesheet" href="/css/main.css">

    <!--Favicon-->
    <link rel="icon" type="image/x-icon" href="/uploads/course-creator/favicon.ico">
</head>

<body>
<?=$_SESSION['error']?>

<style>
    .popup__background {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        display: none;
        background: rgba(102, 102, 102, 0.5);
        z-index: 10000;
    }
    .popup__background .popup {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        width: 430px;
        height: 220px;
        border-radius: 20px;
        padding: 20px 30px 20px !important;
        margin: auto;
        text-align: center;
        background: #fff;
        opacity: 1 !important;
    }
</style>

<div class="Project">

    <?php include 'default/sidebar.php';?>

    <div class="feed">

        <div class="feed-header">

            <div class="feed-menu">

                <a class="button__back" href="/Course">
                    <img src="/img/ArrowLeft.svg" alt="">
                </a>

                <form action="/Course-rename/<?=$content[0][0]['id']?>" method="POST" id="insert">

                    <h2 id="display_name"><?=$content[0][0]['name']?></h2>

                    <button class="none"><img id="name_change" src="/img/Pen.svg" class="ico" onclick="changeName()"></button>

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

                <button class="ico_button button-bell"><img class="ico" src="/img/Bell.svg">  <div id="msg">5</div></button>

                <button id="apps" class="ico_button" onclick="window.location.replace('/Analytics')">Заявки</button>

            </div>

        </div>

        <div class="Lessons">

            <div class="media _container">

                <?php
                foreach($content[1] as $v){?>

                    <?php include 'default/media-cart.php'; ?>

                <?}

                ?>
                <?php include 'default/add_new_video.php'?>
            </div>

        </div>

    </div>

</div>
<div class="popup__background" id="delete__back">
    <div class="popup">
        <div class="popup__container">
            <div class="popup__title">Вы действительно хотите удалить проект?</div>
            <div class="popup__form">
                <button class="popup__btn popup__not-delete">Не удалять</button>
                <button class="popup__btn popup__delete" id="popup__delete">Удалить</button>
            </div>
        </div>
    </div>
</div>
<div class="popup__background" id="reload__back">
    <div class="popup" style="height: 400px; width: 600px;">
        <div class="popup__container">
            <div class="popup__title">Вы действительно хотите изменить видео?</div>
            <div class="popup__form" style="justify-content: center">
                <form method="POST" action="" class="upload__form" id="change__video" enctype="multipart/form-data">

                    <input class="upload_video" style="display:block;" id="video" name="video_change" type="file"/>

                    <button type="submit" class="popup__btn popup__delete popup__change">Изменить</button>
                    <button type="button" class="popup__btn popup__not-delete" id="popup__not-change">Отменить</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="/js/button__settings.js"></script>
<script src="/js/printFailName.js"></script>
<script>
//  Замена видео
    window.onload = () => {
        let reload__video = document.querySelectorAll('.reload_video');
        let reload__back = document.querySelector('#reload__back');
        reload__video.forEach(item => {
            item.addEventListener('click', function () {
                reload__back.classList.toggle('display-block');
                _('change__video').action = '/Course/'+ item.dataset.id +'/change';
            })
        })
        let notChangeVideo = document.querySelector('#popup__not-change');
        notChangeVideo.onclick = function (event) {
            if (event.target === notChangeVideo) {
                reload__back.classList.remove('display-block');
                toggleOverflow();
            }
        }
    }

    let entryDisplayDelete = document.querySelector('#delete__back');
    let deletes = document.querySelector('#popup__delete');

    function toggleOverflow () {
        body.classList.toggle("overflow-hidden");
    }

    function deleteDirectory(elem) {
        toggleOverflow();
        entryDisplayDelete.classList.add('display-block');
        deletes.addEventListener('click',function () {
            window.location.href = '/Course/' + elem.parentElement.parentElement.parentElement.querySelector('.new_name').children[0].value + "/delete";
        });
    }
    let notDelete = document.querySelector('.popup__not-delete');
    notDelete.onclick = function (event) {
        if (event.target === notDelete) {
            entryDisplayDelete.classList.remove('display-block');
            toggleOverflow();
        }
    }
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
        _("progressText").classList.add('active');
        document.querySelector('.btn-upload').classList.add('active');
        var formdata = new FormData();
        formdata.append("video_uploader", file);
        var ajax = new XMLHttpRequest();
        ajax.upload.addEventListener("progress", progressHandler, false);
        ajax.addEventListener("load", completeHandler, false)
        ajax.open("POST", "/Course/<?=$content[0][0]['id']?>/create");
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
<script src="/js/getNotifications.js"></script>
</body>

</html>