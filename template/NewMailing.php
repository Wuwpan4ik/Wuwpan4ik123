<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Creator - Создать рассылку</title>
    <link rel="stylesheet" href="/css/nullCss.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/aboutuser.css">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <!--Favicon-->
    <link rel="icon" type="image/x-icon" href="/uploads/course-creator/favicon.ico">
</head>
<body>
<div class="new-mailing">
    <?php print_r($_SESSION['error']);?>
    <?php include 'default/sidebar.php';?>
    <div class="feed">
        <?php
        $back = 'OneTimeMailings';
        $title = "Новая рассылка";
        include ('default/header.php');
        ?>
        <div class=" _container">
            <div class="new-mailing__body">
                <form id="form" action="/NewMailing/create" method="POST" enctype="multipart/form-data">
                    <?php if ($_SESSION['item_id']) echo "<input hidden name='id' value='{$_SESSION['item_id']}'>"?>
                    <div class="new-mailing__settings">

                        <div class="new-mailing__block">
                            <label class="new-mailing__subtitle" for="text">Новая рассылка</label>
                            <div class="input_focus ">
                                <label for="text" class="label_focus">Тема письма</label>
                                <input required min="3" name="name" type="text" id="social__inpu" minlength="3" value="<?php echo ($content['mailing']['name']) ?? '' ?>">
                                <span class="clear_input_val">
                                    <img src="/img/clear_input.svg" alt="">
                                </span>
                            </div>
                            <div class="new-mailing__text">
                                <div class="wrapper" style="display: block; margin: 60px auto; position: relative;">
                                    <!-- Editor Control Box -->
                                    <div class="editor-controls" id="editor-controls">
                                    
                                    </div>
                                    
                                    <div id="editor"></div>
                                </div>
                            </div>
                        </div>
                        <h2 class="chapter__title">Кому отправить</h2>

                        <div class="new-mailing__block">
                            <div class="mytabs new-mailing__menu">
                                <input type="radio" id="Audience" name="mytabs" checked="checked"/>
                                <label class="menu-label" for="Audience" id="oplab"><p>Выбрать аудиторию</p></label>
                                <div class="tab">
                                    <div class="send">
                                        <div class="send__block">
                                            <label class="new-mailing__subtitle" for="">Выберите продукт</label>
                                            <div class="select-account social-network">
                                                <div id="myMultiselect" class="multiselect">
                                                    <div id="mySelectLabel" class="selectBox" onclick="toggleCheckboxArea(this)">
                                                        <select id="Audience" required name="product" class="form-select">
                                                            <option class="form-select__social-name" value="" id="name"></option>
                                                        </select>
                                                        <div class="overSelect"></div>
                                                    </div>
                                                    <div class="mySelectOptions">
                                                        
                                                        <?php foreach ($content['products'] as $product) { ?>
                                                        <label class="item audience_item social__item"><span><img src="/img/Proj.svg" alt=""><?=$product['name'] ?></span><input class="custom-radio_two custom-checkbox social__input" type="radio" data-value="<?=$product['name'] ?>" value="<?=$product['id']?>" /><label for="happy"></label></label>
	                                                    <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="send__recipient"></div>
                                        </div>
                                        <div class="send__block">
                                            <label class="new-mailing__subtitle" for="">Выберите аудиторию</label>
                                            <div class="select-account social-network">
                                                <div id="myMultiselect" class="multiselect">
                                                    <div id="mySelectLabel" class="selectBox" onclick="toggleCheckboxArea(this)">
                                                        <select id="Audience" required name="indexs" class="form-select">
                                                            <option class="form-select__social-name" value="" id="name"></option>
                                                        </select>
                                                        <div class="overSelect"></div>
                                                    </div>
                                                    <div class="mySelectOptions">
                                                        <label class="item audience_item social__item"><span><img src="/img/Mailings/people.svg" alt="">Все</span><input class="custom-radio_two custom-checkbox social__input" type="radio" data-value="Все" value="3" /><label for="happy"></label></label>
                                                        <label class="item audience_item social__item"><span><img src="/img/Mailings/people.svg" alt="">Кто оплатил</span><input class="custom-radio_two custom-checkbox social__input" type="radio" data-value="Кто оплатил" value="2" /><label for="happy"></label></label>
                                                        <label class="item audience_item social__item"><span><img src="/img/Mailings/people.svg" alt="">Кто не оплатил</span><input class="custom-radio_two custom-checkbox social__input" type="radio" data-value="Кто не оплатил" value="1" /><label for="happy"></label></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="send__recipient"></div>
                                        </div>
                                    </div>
                                </div>
                                <input min="5" type="radio" id="EnterEmail" name="mytabs"/>
                                <label class="menu-label" for="EnterEmail" id="cllab"><p>Ввести email вручную</p></label>
                                <div class="tab">
                                    <div class="input_focus">
                                        <label for="text" class="label_focus">Email получателя</label>
                                        <input id="date" type="email" name="once_email">
                                        <span class="clear_input_val">
                                             <img src="/img/clear_input.svg" alt="">
                                        </span>
                                    </div>
                                </div>
                                    <div class="new-mailing__block new-mailing__planning">
                                        <label class="new-mailing__subtitle" for="date">Запланировать отправку (мск)</label>
                                        <span style="color: #5A6474; font-size: 12px;">По умолчанию - сейчас</span>
                                        <div class="new-mailing__block_two">
                                            <div class="input_focus">
                                                <input id="date" type="date" name="date_send" value="<?php echo ($content['mailing']['date_send']) ?? '' ?>">
                                                <span class="clear_input_val">
                                                     <img src="/img/clear_input.svg" alt="">
                                                </span>
                                            </div>
                                            <div class="input_focus ">
                                                <label for="username" class="label_focus"></label>
                                                <input type="time" name="time_send" id="social__inpu" value="<?php echo ($content['mailing']['time_send']) ?? '' ?>">
                                                <span class="clear_input_val">
                                                    <img src="/img/clear_input.svg" alt="">
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="about-btn">
                                        <button class="save-btn" id="profile_send" type="submit">Сохранить</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <textarea name="text" id="text__area" cols="30" rows="10" style="display: none"></textarea>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="/js/jquery-3.6.1.min.js"></script>
<script src="/js/rich_text_editor.js"></script>
<script src="/js/customInputs.js"></script>
<script src="../js/sidebar.js"></script>
<script src="/js/getNotifications.js"></script>
<script src="/js/autoTextArea.js"></script>
<script>
    $("#form").submit(function (e) {
        e.preventDefault();
        let div = $('.ql-editor').html()
        $("#text__area").html(div);
        $.ajax({
            url: $(this).attr("action"),
            type: $(this).attr("method"),
            data: new FormData(this),
            processData: false,
            contentType: false,
        });
        location.reload();
    })
</script>
<?php if ($content['mailing']['indexs']) { ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelector(".audience_item:nth-child(<?=$content['mailing']['indexs']?>) .social__input").click();
        })
    </script>
<?php } ?>


<script>
    /*Select*/
    function checkboxStatusChange(block = document) {

        let multiselect = block.querySelectorAll(".multiselect");


        multiselect.forEach(element =>{
            let checkboxes = element.querySelector(".mySelectOptions");
            let checkedCheckboxes = checkboxes.querySelectorAll('.custom-checkbox');
            let multiselectOption =  element.querySelector("#name");
            let container = element.parentElement.parentElement.querySelector('.send__recipient')

            checkedCheckboxes.forEach(item =>{
                let title = block.querySelectorAll('.slider__item-title');
                let text = block.querySelectorAll('.slider__item-text');

                let values = [];
                let data_info;
                item.addEventListener('click', function(){
                    if(item.checked = true){
                        checkedCheckboxes.forEach(el =>{
                            el.checked = false
                            el.parentElement.classList.remove('active')
                            item.parentElement.parentElement.classList.remove('display-flex');

                        })
                        item.checked = true
                        title.forEach(t=>{
                            t.style.fontFamily = item.parentElement.style.fontFamily;
                            t.style.fontWeight = '900px';
                        })
                        item.parentElement.classList.add('active')
                        values = (item.getAttribute('value'));
                        data_info = item.dataset.value;

                    }
                    multiselectOption.innerText = data_info;
                    container.innerHTML = `
                            <div class="ot-mailing__recipient">
                                            ${data_info} <img src="/img/x.svg" alt="">
                            </div>
                        `

                    multiselectOption.value = values;
                    multiselectOption.selected = true;
                    if (item.parentElement.parentElement.classList.contains('first_do_list')) {
                        checkFirstSelect()
                    }

                    if (item.parentElement.parentElement.classList.contains('second_do_list')) {
                        checkSecondSelect()
                    }
                })
            })
        })
    }

    checkboxStatusChange()

    function deleteFlex() {
        document.querySelectorAll('.mySelectOptions').forEach(item => {
            item.classList.remove('display-flex')
        })
    }

    function toggleCheckboxArea(select) {
        if (!select.parentElement.querySelector('.mySelectOptions').classList.contains('display-flex')) {
            deleteFlex();
        }
        let option = select.parentElement.querySelector('.mySelectOptions');
        option.classList.toggle("display-flex");
        option.style.flexDirection = "column";
    }

</script>
</body>
</html>