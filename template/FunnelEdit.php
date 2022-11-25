<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">

    <title>Course Creator - Редактирование воронки</title>

    <link rel="stylesheet" href="/css/nullCss.css">

    <link rel="stylesheet" href="/css/smallPlayer.css">

    <link rel="stylesheet" href="/css/lessons.css">

    <link rel="stylesheet" href="/css/main.css">

    <!--Favicon-->
    <link rel="icon" type="image/x-icon" href="/uploads/course-creator/favicon.ico">
</head>

<body>

<style>
    .input__wrapper {
        text-align: center;
    }

    .input__file {
        display: none;
    }

    .inputfile-box {
        position: relative;
    }

    .file-box {
        display: inline-block;
        width: 100%;
        padding: 5px 0px 5px 5px;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        color: #000;
        height: calc(2rem - 2px);
    }
    .input__file-button {
        width: 132px;
        height: 60px;
        background: -webkit-gradient(linear, left top, left bottom, from(#08B395), to(#0C977F));
        background: -o-linear-gradient(top, #08B395 0%, #0C977F 100%);
        background: linear-gradient(180deg, #08B395 0%, #0C977F 100%);
        font-size: 1.125rem;
        font-weight: 700;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: start;
        -ms-flex-pack: start;
        justify-content: center;
        border-radius: 3px;
        cursor: pointer;
        margin: 0 auto;
    }

    .avatar {
        width: 100%;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
        flex-direction: column;
        margin: 32px 0 0 0;
    }

    .avatar-body {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        width: 100%;
        overflow: hidden;
        gap: 5px;
    }

    #file-name {
        font-size: 20px;
        font-weight: 600;
    }

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

                <a class="button__back" href="/Funnel">
                    <img src="/img/ArrowLeft.svg" alt="">
                </a>

                <form action="/Funnel-rename/<?=$content[0][0]['id']?>" method="POST" id="insert">

                    <h2 id="display_name"><?=$content[0][0]['name']?></h2>

                    <button class="none"><img id="name_change" src="/img/Pen.svg" class="ico" onclick="changeName()"></button>

                </form>

                <script>

                    function changeName(){

                        document.getElementById("insert").innerHTML = '<input class="proj_name" name="title" placeholder="Введите новое название"><button type="submit" class="none"><img id="name_change" src="/img/Pen.svg" class="ico"></button>';

                    }

                </script>

            </div>

            <div class="buttonsFeed">
                <button class="ico_button button-bell"><img class="ico" src="/img/Bell.svg">  <div id="msg">5</div></button>

                <button id="apps" class="ico_button">Заявки</button>

            </div>

        </div>

        <div class="Lessons">

            <div class="media _container">

                <?php
                foreach($content[1] as $v){?>

                    <?php include 'default/media-cart.php'?>

                <?}?>

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
                <button class="popup__btn popup__delete">Удалить</button>
            </div>
        </div>
    </div>
</div>
<?php include 'default/popupEditVideo.php';?>

<script type="text/javascript" src="../js/button__settings.js"></script>
<script>
    let entryDisplayDelete = document.querySelector('#delete__back');
    let deletes = document.querySelector('.popup__delete');

    function toggleOverflow () {
        body.classList.toggle("overflow-hidden");
    }
    function deleteDirectory(elem) {
        toggleOverflow();
        entryDisplayDelete.classList.add('display-block');
        deletes.addEventListener('click',function () {
            window.location.href = '/Funnel/' + elem.parentElement.parentElement.parentElement.querySelector('.new_name').children[0].value + "/delete";
        });
    }
    let notDelete = document.querySelector('.popup__not-delete');
    notDelete.onclick = function (event) {
        if (event.target === notDelete) {
            entryDisplay.classList.remove('display-block');
            toggleOverflow();
        }
    }


    function uploadFile(target) {
        console.log(1)
        document.getElementById("file-name").innerHTML = (target.files[0].name);
        document.getElementById("file-size").innerHTML = Math.round(target.files[0].size / 1024) + "кБ" + " из доступных 5Мб" ;
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
        ajax.open("POST", "/Funnel/<?=$content[0][0]['id']?>/create");
        ajax.send(formdata);
        window.location.replace("/Funnel");
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

<script>
    document.querySelector('.button-click').addEventListener('click', function (){
        let popup__block = document.querySelector('.test__block');
        popup__block.classList.toggle('active');
        if (popup__block.classList.contains('active')) {
            popup__block.querySelector('.overlay').classList.toggle('active');
            setTimeout(function () {
                popup__block.querySelector('.popup').classList.toggle('active');
            }, (20));
        } else {
            popup__block.querySelector('.popup').classList.toggle('active');
            setTimeout(function () {
                popup__block.querySelector('.overlay').classList.toggle('active');
            }, (550));
        }
    })
</script>
<script src="/js/getNotifications.js"></script>
</body>

</html>