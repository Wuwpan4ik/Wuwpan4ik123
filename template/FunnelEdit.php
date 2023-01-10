<!DOCTYPE html>

<html lang="ru">

<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Course Creator - Редактирование воронки</title>

    <link rel="stylesheet" href="/css/nullCss.css">

    <link rel="stylesheet" href="/css/smallPlayer.css">

    <link rel="stylesheet" href="/css/lessons.css">

    <link rel="stylesheet" href="/css/main.css">

    <link rel="stylesheet" href="/css/aboutuser.css">
    <!--Favicon-->
    <link rel="icon" type="image/x-icon" href="/uploads/course-creator/favicon.ico">

    <link rel="stylesheet" href="">
</head>

<body>

<style>

    .switch_box{
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        justify-content: space-around;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-flex: 1;
        -ms-flex: 1;
        flex: 1;
        margin: 20px 0;
    }

    /* Switch 1 Specific Styles Start */

    input[type="checkbox"].switch_1{
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        width: 3.5em;
        height: 1.5em;
        background: #ddd;
        border-radius: 3em;
        position: relative;
        cursor: pointer;
        outline: none;
        -webkit-transition: all .2s ease-in-out;
        transition: all .2s ease-in-out;
    }

    input[type="checkbox"].switch_1:checked{
        background: #0ebeff;
    }

    input[type="checkbox"].switch_1:after{
        position: absolute;
        content: "";
        width: 1.5em;
        height: 1.5em;
        border-radius: 50%;
        background: #fff;
        -webkit-box-shadow: 0 0 .25em rgba(0,0,0,.3);
        box-shadow: 0 0 .25em rgba(0,0,0,.3);
        -webkit-transform: scale(.7);
        transform: scale(.7);
        left: 0;
        -webkit-transition: all .2s ease-in-out;
        transition: all .2s ease-in-out;
    }

    input[type="checkbox"].switch_1:checked:after{
        left: calc(100% - 1.5em);
    }

    /* Switch 1 Specific Style End */
</style>

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

<div class="Project app">

    <?php include 'default/sidebar.php';?>

    <div class="feed">

        <div class="feed-header">

            <div class="feed-menu">

                <a class="button__back" href="/Funnel">
                    <img src="/img/ArrowLeft.svg" alt="">
                </a>

                <form action="/Funnel-rename/<?=$content[0][0]['id']?>" method="POST" id="insert">

                    <h2 id="display_name"><?=$content[0][0]['name']?></h2>

                    <button class="none" type="submit"><img id="name_change" src="/img/Pen.svg" class="ico" onclick="changeName()"></button>

                </form>

                <script>

                    function changeName(){

                        document.getElementById("insert").innerHTML = '<input class="proj_name" name="title" placeholder="Введите новое название" required type="text" class="none"><button type="submit"><img id="name_change" src="/img/Pen.svg" class="ico"></button>';

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
                foreach($content[1] as $v){?>

                    <?php include 'default/media-cart.php'?>

                <?php } ?>

                <?php include 'default/add_new_video.php'?>

            </div>

        </div>

    </div>

</div>
<div class="exit-funnel-edit popup-tariff">
    <div class="popup-tariff-body">
        <div class="popup__title">
            У вас остались  не <br> сохраненные данные
        </div>
        <div class="popup__buttons">
            <button id="close-popup" class="popup__btn popup__white">Выйти</button>
            <button id="save-popup" class="popup__btn popup__blue">Сохранить</button>
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
                <form method="POST" action="" class="upload__form" id="change__video" enctype="multipart/form-data">
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
                            <input name="video_change" type="file" id="input__file" class="input input__file" onchange="uploadFile(this)" multiple="">
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
                </form>
            </div>
        </div>
    </div>

</div>


<?php include 'default/popupEditVideo.php';?>
<script src="/js/jquery-3.6.1.min.js"></script>
<script type="text/javascript" src="../js/button__settings.js"></script>
<script src="../js/sidebar.js"></script>

<!--Уведомления-->
<script>
    let buttonBell =  document.body.querySelector('.button-bell');
    let popupBell =  document.body.querySelector('.popupBell')
    function popupBellActive() {
        popupBell.classList.add('active');
    }
    function popupBellDisable() {
        popupBell.classList.remove('active');
    }
    buttonBell.addEventListener('mouseover', popupBellActive)
    buttonBell.addEventListener('mouseout', popupBellDisable)
    buttonBell.addEventListener('click', function () {
        buttonBell.removeEventListener('mouseover', popupBellActive)
        popupBellDisable();
        buttonBell.removeEventListener('mouseout', popupBellDisable)
        let request = new XMLHttpRequest();
        let url = "/NotificationsController/checkout";

        request.open('POST', url);

        request.setRequestHeader('Content-Type', 'application/x-www-form-url');
        request.addEventListener("readystatechange", () => {
        });
        request.send();
    })
</script>
<script src="/js/getNotifications.js"></script>
<!--Уведомления-->

<script src="/js/customInputs.js"></script>
<script src="../js/customSelect.js"> </script>
<script>
    function uploadFile(target) {
        document.getElementById("file-name").innerHTML = (target.files[0].name);
        document.getElementById("file-size").innerHTML = Math.round(target.files[0].size / 1024) + "кБ" + " из доступных 5Мб" ;
    }
    let form__submit = $(function() {
        $('.media__form').each(function (){
            $(this).submit(function(e) {
                e.preventDefault();
                let saveBtn = $(this).find('.save-btn');
                saveBtn.addClass("active");
                saveBtn.text('Сохранено');
                setTimeout(function () {
                    saveBtn.removeClass("active");
                    saveBtn.text('Сохранить');
                }, 1500)
                $.post(e.target.action, $(this).serialize());
            });
        })
    });
</script>
<script>
    function CloseFunnelPopup() {
        if (document.querySelector('.popup__bonus')) {
            document.querySelector('.popup__bonus').classList.remove('active');
        }
        if (document.querySelector('.exit-funnel-edit')) {
            document.querySelector('.exit-funnel-edit').classList.remove('display-flex');
        }
        if (document.querySelector('.checkbox__wrapper')) {
            document.querySelector('.checkbox__wrapper').remove();
        }
        toggleOverflow();
        closePopup();
        clearPopup();
        defaultPopup(first_select);
        defaultPopup(second_select);
    }

    let exitFunnelEdit = document.querySelector('.exit-funnel-edit');
    let exitFunnelEditClose = document.querySelector('#close-popup');
    let saveFunnelEditClose = document.querySelector('#save-popup');

    async function DeleteSave() {
        exitFunnelEditClose.addEventListener('click', function(){
            return false;
        })

        saveFunnelEditClose.addEventListener('click', function(){
            return true;
        })
    }

    var promiseSave;

    function newPromise(){
        promiseSave = new Promise(async function(resolve) {

            exitFunnelEditClose.addEventListener('click', function(){
                resolve("1");
            })

            saveFunnelEditClose.addEventListener('click', function(){
                resolve("save");
            })
        });
    }
    newPromise();

    function promise() {
        promiseSave.then(function (result) {
            if (result === 'save') {
                document.querySelector('#initButton').action = "/Funnel/"+ document.querySelector('#initButton').parentElement.querySelector('input[type="hidden"]').value +"/settings"
                save();
            } else {
                CloseFunnelPopup();
            }
            newPromise();
        });
    }

    function SaveOrRemoveSettings() {

        document.querySelector('#initButton').action = "/Funnel/"+ document.querySelector('#initButton').parentElement.querySelector('input[type="hidden"]').value +"/checkSettings"

        $.ajax({
            url: "/Funnel/"+ document.querySelector('#id_item').value +"/checkSettings",
            method: 'POST',             /* Метод передачи (post или get) */
            dataType: 'html',          /* Тип данных в ответе (xml, json, script, html). */
            data: $("#initButton").serialize(),     /* Параметры передаваемые в запросе. */
            success: function(data){   /* функция которая будет выполнена после успешного запроса.  */
                if (data == 0) {
                    document.querySelector('.exit-funnel-edit').classList.add('display-flex');
                    document.querySelector('.exit-funnel-edit').style.zIndex = '1000';
                    promise();
                } else {
                    CloseFunnelPopup();
                }
            }
        });
    }

    const close = document.querySelector('.close__btn');
    const entryDisplay = document.querySelector('#popup__background');
    function closeBtn() {
        close.addEventListener('click', async function () {
            SaveOrRemoveSettings();
        });

        entryDisplay.onclick = async function (event) {
            if (event.target === entryDisplay) {
                SaveOrRemoveSettings();
            }
        }
    }
    closeBtn();

    window.onload = () => {
        let inputs = document.querySelectorAll('.input_focus input, textarea');
        let inputsLabel = document.querySelectorAll('.input_focus label');
        let inputClear = document.querySelectorAll('.input_focus span');

        for(let i =0; i < inputs.length; i++) {
            inputs[i].addEventListener('input', function() {
                if (inputs[i].value != "") {
                    inputsLabel[i].classList.add('activeLabel');
                    inputClear[i].classList.add('has_content');
                }
                else {
                    inputsLabel[i].classList.remove('activeLabel');
                    inputClear[i].classList.remove('has_content');
                }
            });

            inputClear[i].onclick = () => {
                inputsLabel[i].classList.remove('activeLabel')
                inputs[i].value = "";
                inputClear[i].classList.remove('has_content')
            }
        }
    }
</script>
<script>
    let entryDisplayDelete = document.querySelector('#delete__back');
    //  Замена видео
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

    let deletes = document.querySelector('.popup__delete');

    function toggleOverflow () {
        body.classList.toggle("overflow-hidden");
    }
    function deleteDirectory(elem) {
        toggleOverflow();
        entryDisplayDelete.classList.add('display-block');
        deletes.addEventListener('click', function () {
            window.location.href = '/Funnel/' + elem.parentElement.parentElement.parentElement.querySelector('.new_name').children[0].value + "/delete";
        });
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
        ajax.open("POST", "/Funnel/<?=$content[0][0]['id']?>/create");
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



<!-- Получить popup funnel_content -->
<script>
    function getFunnelPopup(funnel_content_id) {
        let request = new XMLHttpRequest();

        let url = "/Funnel/"+ funnel_content_id +"/getFunnelPopup";

        request.open('GET', url);

        request.setRequestHeader('Content-Type', 'application/x-www-form-url');
        request.addEventListener("readystatechange", () => {
            if (request.readyState === 4 && request.status === 200) {
                let popup = JSON.parse(JSON.parse(request.responseText))
                if (popup) {
                    let first_do = document.getElementById('first_do');

                    // first_do
                    let option_1 = Object.keys(popup['first_do'])[0];
                    let option_item_1 = first_do.querySelector('option[value="' + option_1 + '"]')
                    option_item_1.selected = true;
                    option_item_1.setAttribute('selected', 'selected')

                    switch (option_1) {
                        case 'pay_form':
                        case 'form':
                            if (popup['form__title']) {
                                document.querySelector('input[name="form__title"]').value = popup['form__title'];
                            }
                            if (popup['form__desc']) {
                                document.querySelector('input[name="form__desc"]').value = popup['form__desc'];
                            }
                            if (popup['button_text']) {
                                document.querySelector('input[name="button__send"]').value = popup['button_text'];
                            }
                            let div = document.querySelector('#first_do-list');
                            if (option_1 === 'form') {
                                for (let item of popup['first_do']['form']) {
                                    console.log(item)
                                    addFormItem(div, item);
                                }
                            } else if (option_1 === 'pay_form') {
                                for (let item of popup['first_do']['pay_form']) {
                                    addFormItem(div, item);
                                }
                            }
                            break;
                        case 'link':
                            addFormLink(true, document.querySelector('#first_do'))
                            if (popup['first_do']['open_in_new']) {
                                document.querySelector('input[name="open_new_window"]').checked = true;
                            }
                            break;
                    }

                    // /first_do

                    checkBothSelect();

                    if (popup['first_do']['link']) {
                        document.querySelector('input[name="link-1"]').value = popup['first_do']['link']
                    }

                    // second_do

                    let option_2;
                    let second_do;
                    let option_item_2;

                    if (popup['second_do'] != null) {
                        second_do = document.getElementById('second_do');
                        option_2 = Object.keys(popup['second_do'])[0];
                        option_item_2 = second_do.querySelector('option[value="' + option_2 + '"]')
                        option_item_2.selected = true;
                        option_item_2.setAttribute('selected', 'selected')
                        switch (option_2) {
                            case 'link':
                                document.querySelector('input[name="link-2"]').value = popup['second_do']['link'];
                                addCheckbox(second_do);
                                if (popup['second_do']['open_in_new']) {
                                    document.querySelector('input[name="open_new_window"]').checked = true;
                                }
                                break;
                            case 'file':
                                document.querySelector('#file-name').innerHTML = popup['second_do']['file'].toString().match(/.*\/(.+?)\./)[1];
                                break;
                        }
                    }

                    // /second_do

                    checkSecondSelect();

                    setTimeout(function (){
                        if (popup['form__title']) {
                            let form__title = document.querySelector('.popup-title');
                            form__title.innerHTML = popup['form__title'];
                        }
                        if (popup['form__desc']) {
                            let form__desc = document.querySelector('.popup-text');
                            form__desc.innerHTML = popup['form__desc'];
                        }
                    }, 400)
                }
            }
        })
        request.send();
    }

</script>

<!-- Форма списков курса -->
<script>
    function initListCourse(){
        setTimeout(function (){
            document.querySelector('.button-buy').addEventListener('click', function (){
                document.querySelector('.popup__allLessons').classList.remove('active');
                document.querySelector('.overlay-allLessons').classList.remove('active');
                document.querySelector('.popup__buy').classList.add('active');
                document.querySelector('.popup__buy').style.zIndex = 100;
                document.querySelector('.popup__buy-footer').style.padding = 0;
            })
        }, 500)
    }
</script>

</body>

</html>