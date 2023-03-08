<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Creator - Создать рассылку</title>
    <link rel="stylesheet" href="/css/nullCss.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/aboutuser.css">
    <!--Favicon-->
    <link rel="icon" type="image/x-icon" href="/uploads/course-creator/favicon.ico">
</head>
<body>
<div class="new-mailing">
    <?php include 'default/sidebar.php';?>
    <div class="feed">
        <?php
        $back = 'OneTimeMailings';
        $title = "Новая рассылка";
        include ('default/header.php');
        ?>
        <div class=" _container">
            <div class="new-mailing__body">
                <div class="new-mailing__card ot-mailing">
                    <div class="ot-mailing__info">
                        <p class="new-mailing__title"><?php echo ($content['name']) ?? 'Название' ?></p>
                        <p class="new-mailing__description ot-mailing__limit"><?php echo ($content['description']) ?? 'Описание' ?></p>
                        <div class="ot-mailing__image"><img src="/img/Mailings/one-time_mailing_lists.jpg" alt=""></div>
                    </div>
                </div>
                <form action="/NewMailing/create" method="POST" style="width: 100%" enctype="multipart/form-data">
                    <?php if ($_SESSION['item_id']) echo "<input hidden name='id' value='{$_SESSION['item_id']}'>"?>
                    <div class="new-mailing__settings">

                        <div class="new-mailing__block">
                            <label class="new-mailing__subtitle" for="text">Новая рассылка</label>
                            <div class="input_focus ">
                                <label for="text" class="label_focus">Тема письма</label>
                                <input required min="3" name="name" type="text" id="social__inpu" minlength="3" value="<?php echo ($content['name']) ?? '' ?>">
                                <span class="clear_input_val">
                                    <img src="/img/clear_input.svg" alt="">
                                </span>
                            </div>
                            <div class="input_focus ">
                                <label for="text" class="label_focus">Добавьте описание письма</label>
                                <input required min="3" name="description" type="text" id="social__inpu" minlength="3" value="<?php echo ($content['description']) ?? '' ?>">
                                <span class="clear_input_val">
                                    <img src="/img/clear_input.svg" alt="">
                                </span>
                            </div>
                            <h2 class="chapter__title">Настройки письма</h2>
                            <div class="input_focus ">
                                <label for="text" class="label_focus">Добавьте текст сообщения</label>
                                <input required min="3" name="text" type="text" id="social__inpu" minlength="3" value="<?php echo ($content['text']) ?? '' ?>">
                                <span class="clear_input_val">
                                    <img src="/img/clear_input.svg" alt="">
                                </span>
                            </div>
                            <?php if ($content['buttons']) {
                                $count = 1?>
                                <?php foreach (array_keys($content['buttons']) as $item) { ?>
                                    <div class="new-mailing__block_two">
                                        <div class="input_focus ">
                                            <label for="username" class="label_focus">Кнопка</label>
                                            <input min="3" type="text" name="<?php echo "{$count}_button"?>" id="social__inpu" minlength="3" value="<?php echo ($item) ? $item : '' ?>">
                                            <span class="clear_input_val">
                                            <img src="/img/clear_input.svg" alt="">
                                        </span>
                                        </div>
                                        <div class="input_focus ">
                                            <label for="username" class="label_focus">Ссылка для кнопки</label>
                                            <input min="3" type="text" name="<?php echo "{$count}_link"?>" id="social__inpu" minlength="3" value="<?php echo ($item) ? $content['buttons'][$item] :  '' ?>">
                                            <span class="clear_input_val">
                                            <img src="/img/clear_input.svg" alt="">
                                        </span>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } else { ?>
                                <div class="new-mailing__block_two">
                                    <div class="input_focus ">
                                        <label for="username" class="label_focus">Кнопка</label>
                                        <input min="3" type="text" name="1_button" id="social__inpu" minlength="3" value="">
                                            <span class="clear_input_val">
                                        <img src="/img/clear_input.svg" alt="">
                                        </span>
                                    </div>
                                    <div class="input_focus ">
                                        <label for="username" class="label_focus">Ссылка для кнопки</label>
                                        <input min="3" type="text" name="1_link" id="social__inpu" minlength="3" value="">
                                            <span class="clear_input_val">
                                        <img src="/img/clear_input.svg" alt="">
                                        </span>
                                    </div>
                                </div>
                            <?php } ?>

                            <button type="button" class="Mailings__btn"><img src="/img/Mailings/plus_gray.svg" alt="">Добавить кнопку</button>
                        </div>
                        <label for="file" class="new-mailing__block">
                            <input type="file" name="file" id="file" hidden>
                            <label class="new-mailing__subtitle" for="">Загрузить картинку или видео</label>
                            <div class="add-picture avatar">
                                <div class="add-picture__body avatar-body">
                                    <img src="../img/Mailings/file.svg" alt="">
                                    <div class="add-picture__info avatar-body__info">
                                        <span id="file-name" class="file-box">Добавить файл</span>
                                        <span id="file-size" class="file-box">JPEG, PNG, Gif, mp4 - весом не более 3 MB</span>
                                    </div>
                                </div>
                            </div>
                        </label>
                        <div class="new-mailing__block new-mailing__planning">
                            <label class="new-mailing__subtitle" for="date">Запланировать отправку</label>
                            <span style="color: #5A6474; font-size: 12px;">По умолчанию - сейчас</span>
                            <div class="new-mailing__block_two">
                                <div class="input_focus">
                                    <input id="date" type="date" name="date_send" value="<?php echo ($content['date_send']) ?? '' ?>">
                                    <span class="clear_input_val">
                                         <img src="/img/clear_input.svg" alt="">
                                    </span>
                                </div>
                                <div class="input_focus ">
                                    <label for="username" class="label_focus">Время отправки</label>
                                    <input type="time" name="time_send" id="social__inpu" value="<?php echo ($content['time_send']) ?? '' ?>">
                                    <span class="clear_input_val">
                                    <img src="/img/clear_input.svg" alt="">
                                </span>
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
                                                        <label class="item audience_item social__item"><span><img src="/img/Mailings/people.svg" alt="">Все</span><input class="custom-radio_two custom-checkbox social__input" type="radio" data-value="Все" value="1" /><label for="happy"></label></label>
                                                        <label class="item audience_item social__item"><span><img src="/img/Mailings/people.svg" alt="">Кто оплатил</span><input class="custom-radio_two custom-checkbox social__input" type="radio" data-value="Кто оплатил" value="2" /><label for="happy"></label></label>
                                                        <label class="item audience_item social__item"><span><img src="/img/Mailings/people.svg" alt="">Кто не оплатил</span><input class="custom-radio_two custom-checkbox social__input" type="radio" data-value="Кто не оплатил" value="3" /><label for="happy"></label></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="send__recipient"></div>
                                        </div>
                                    </div>

                                    <div class="about-btn">
                                        <button class="save-btn" id="profile_send" type="submit">Сохранить</button>
                                    </div>
                                </div>

                                <input min="5" type="radio" id="EnterEmail" name="mytabs"/>
                                <label class="menu-label" for="EnterEmail" id="cllab"><p>Ввести email вручную</p></label>
                                <div class="tab">
                                    <div class="about-btn">
                                        <button class="save-btn" id="profile_send" type="submit">Сохранить</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="/js/jquery-3.6.1.min.js"></script>
<script src="/js/customInputs.js"></script>
<script src="../js/sidebar.js"></script>
<script src="/js/getNotifications.js"></script>

<?php if ($content['indexs']) { ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelector(".audience_item:nth-child(<?=$content['indexs']?>) .social__input").click();
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