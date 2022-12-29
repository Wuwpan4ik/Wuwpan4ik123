<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Creator - Редактирование курса</title>

    <link rel="stylesheet" href="/css/nullCss.css">

    <link rel="stylesheet" href="/css/smallPlayer.css">

    <link rel="stylesheet" href="/css/lessons.css">

    <link rel="stylesheet" href="/css/main.css">

    <!--Favicon-->
    <link rel="icon" type="image/x-icon" href="/uploads/course-creator/favicon.ico">
</head>

<body>

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

<div class="Project app">

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

                        document.getElementById("insert").innerHTML = '<input class="proj_name" name="title" placeholder="Введите новое название" required><button type="submit" class="none"><img id="name_change" src="../img/Pen.svg" class="ico"></button>';


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
    <div id="popup">
        <div class="popup__container">
            <div class="popup-body">
                <div class="popup__title">Вы действительно хотите удалить проект?</div>
                <div class="popup__form">
                    <button class="popup__btn popup__white popup__not-delete" id="popup__not-change">Не удалять</button>
                    <button class="popup__btn popup__blue popup__delete">Удалить</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="popup__background" id="reload__back">
    <div id="popup">
        <div class="popup__container">
            <div class="popup-body">
                <div class="popup__title">Хотите изменить видео?</div>
                <div class="avatar inCourse">
                    <div class="avatar-body">
                        <img src="../img/saveAvatar.svg" alt="">
                        <div class="avatar-body__info">
                            <span id="file-name" class="file-box">
                                Название файла
                            </span>
                            <span id="file-size" class="file-box">
                                0кб из 5мб
                            </span>
                        </div>

                    </div>

                    <div class="input__wrapper">
                        <input name="file" type="file" id="input__file" class="input input__file" onchange="uploadFile(this)" multiple="">
                        <label for="input__file" class="input__file-button" style="">
                            <span class="input__file-icon-wrapper"><img class="input__file-icon" src="/img/plus.svg" width="25"></span>
                            <span class="input__file-button-text">Добавить</span>
                        </label>
                    </div>

                </div>
                <div class="popup__form">
                    <button class="popup__btn popup__white" id="popup__not-change" >Отменить</button>
                    <button class="popup__btn popup__blue ">Заменить</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/js/button__settings.js"></script>
<script src="/js/printFailName.js"></script>
<script>
    let saveBtn = document.querySelector('.save-btn');


    saveBtn.addEventListener('click', function(){
        saveBtn.classList.add('active');
        saveBtn.innerHTML = 'Сохранено';
    })
</script>
<script>


    let entryDisplayDelete = document.querySelector('#delete__back');
    //  Замена видео
    window.onload = () => {
        let reload__video = document.querySelectorAll('.reload_video');
        let reload = document.querySelector('#reload__back');

        let popup__back = document.querySelectorAll('.popup__container');
        let notDelete = document.querySelector('.popup__not-delete');

        reload__video.forEach(item => {
            item.addEventListener('click', function () {
                reload.classList.toggle('display-block');
                _('change__video').action = '/Funnel/'+ item.dataset.id +'/change';
            })
        })
        let notChangeVideo = document.querySelectorAll('#popup__not-change');

        // notChangeVideo.onclick = function (event) {
        //     if (event.target === notChangeVideo) {
        //         reload.classList.remove('display-block');
        //         toggleOverflow();
        //     }
        // }
        notChangeVideo.forEach(item => {
            item.onclick = function (event) {
                if (event.target === item) {
                    reload.classList.remove('display-block');
                    toggleOverflow();
                }
            }
        })
        popup__back.forEach(item => {
            item.onclick = function (event) {
                if (event.target === item) {
                    reload.classList.remove('display-block');
                    entryDisplayDelete.classList.remove('display-block');
                    toggleOverflow();
                }
            }
        })

        notDelete.onclick = function (event) {
            if (event.target === notDelete) {
                entryDisplayDelete.classList.remove('display-block');
                toggleOverflow();
            }
        }
    }
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
<script src="../js/jquery-3.6.1.min.js"></script>
<script>
    let form__submit = $(function() {
        $('.media__form').each(function () {
            $(this).submit(function (e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr("action"),
                    type: $(this).attr("method"),
                    dataType: "JSON",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                });
            })
        });
    });
</script>
<script src="../js/sidebar.js"></script>
<script src="/js/customInputs.js"></script>
</body>

</html>