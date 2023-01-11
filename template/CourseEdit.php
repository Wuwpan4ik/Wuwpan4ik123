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

                <button style="width:48px;" class="ico_button button-bell"><svg width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2.51436 14.0001L3.69436 12.8181C4.07236 12.4401 4.28036 11.9381 4.28036 11.4041V6.72708C4.28036 5.37008 4.87036 4.07308 5.90036 3.17108C6.93836 2.26108 8.26036 1.86108 9.63736 2.04208C11.9644 2.35108 13.7194 4.45508 13.7194 6.93708V11.4041C13.7194 11.9381 13.9274 12.4401 14.3044 12.8171L15.4854 14.0001H2.51436ZM10.9994 16.3411C10.9994 17.2401 10.0834 18.0001 8.99936 18.0001C7.91536 18.0001 6.99936 17.2401 6.99936 16.3411V16.0001H10.9994V16.3411ZM17.5204 13.2081L15.7194 11.4041V6.93708C15.7194 3.45608 13.2174 0.499077 9.89936 0.0600774C7.97736 -0.195923 6.03736 0.391077 4.58236 1.66708C3.11836 2.94908 2.28036 4.79308 2.28036 6.72708L2.27936 11.4041L0.478359 13.2081C0.00935877 13.6781 -0.129641 14.3771 0.124359 14.9901C0.379359 15.6041 0.972359 16.0001 1.63636 16.0001H4.99936V16.3411C4.99936 18.3591 6.79336 20.0001 8.99936 20.0001C11.2054 20.0001 12.9994 18.3591 12.9994 16.3411V16.0001H16.3624C17.0264 16.0001 17.6184 15.6041 17.8724 14.9911C18.1274 14.3771 17.9894 13.6771 17.5204 13.2081Z" fill="#757D8A"/>
                    </svg>
                    <div id="msg">0</div></button>

                <button id="apps" class="ico_button" onclick="window.location.replace('Analytics')">Заявки</button>

                <div class="popupBell">
                    <div class="popupBell-body">
                        <div class="popupBell-item not-bell">
                            <div class="popupBell-item__info ">
                                <p>У вас пока нет уведомлений</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="Lessons">

            <div class="media _container">

                <?php
                $count = 1;
                foreach($content[1] as $v){
                    ?>


                    <?php include 'default/media-cart.php'; ?>

                <? $count += 1;} ?>
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
                <form method="POST" action="/Course/$item_id/rename" class="upload__form" id="change__video" enctype="multipart/form-data">
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
                            <input class="input input__file" id="video_change" name="video_change" type="file" onchange="uploadFile(this)"/>
                            <label for="video_change" class="input__file-button" style="">
                                <span class="input__file-icon-wrapper"><img class="input__file-icon" src="/img/plus.svg" width="25"></span>
                                <span class="input__file-button-text">Добавить</span>
                            </label>
                        </div>

                    </div>
                    <div class="popup__form">
                        <button type="button" class="popup__btn popup__white" id="popup__not-change" >Отменить</button>
                        <button type="submit" class="popup__btn popup__blue ">Заменить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="/js/button__settings.js"></script>
<script>
    function uploadFile(target) {
        console.log(target.parentElement.parentElement)
        target.parentElement.parentElement.querySelector("#file-name").innerHTML = (target.files[0].name);
        target.parentElement.parentElement.querySelector("#file-size").innerHTML = Math.round(target.files[0].size / 1024) + "кБ из доступных 5мб" ;
    }
</script>
<script>
    let saveBtn = document.querySelectorAll('.save-btn');
    saveBtn.forEach(item => {
        item.addEventListener('click', function(){
            item.classList.add('active');
            item.innerHTML = 'Сохранено';
        })
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
                let file = document.getElementById("video_change").files[0];
                _('change__video').action = '/Course/'+ item.dataset.id +'/change';
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
    let deletes = document.querySelector('.popup__delete');

    function toggleOverflow () {
        body.classList.toggle("overflow-hidden");
    }

    function deleteDirectory(elem) {
        toggleOverflow();
        entryDisplayDelete.classList.add('display-block');
        console.log(deletes)
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
        _("progressTitle").classList.add('active');
        _("progressSubTitle").classList.add('active');
        _("progress-values").classList.add('active');
        document.querySelector('.upload__form').classList.add('active');
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


<script src="/js/getNotifications.js"></script><script>
    let buttonBell =  document.querySelector('.button-bell');
    let popupBell =  document.querySelector('.popupBell')
    let popupBellBody = document.querySelector('.popupBell-body')
    function popupBellActive() {
        popupBell.classList.add('active');
    }
    function popupBellDisable() {
        setTimeout(function () {
            if (!popupBellBody.onmouseover) {
                popupBell.classList.remove('active');
            }
        }, 1000)
    }
    buttonBell.addEventListener('mouseover', popupBellActive)
    buttonBell.addEventListener('mouseout', popupBellDisable)
    buttonBell.addEventListener('click', function () {
        buttonBell.removeEventListener('mouseover', popupBellActive)
        popupBellDisable();
        buttonBell.removeEventListener('mouseout', popupBellDisable)
        let request = new XMLHttpRequest();
        let url = "/NotificationsController/checkout";
        document.querySelector('#msg').innerHTML = '0';

        request.open('POST', url);

        request.setRequestHeader('Content-Type', 'application/x-www-form-url');
        request.addEventListener("readystatechange", () => {
        });
        request.send();
    })
</script>
</body>

</html>