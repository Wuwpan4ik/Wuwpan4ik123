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
    <?php include 'default/sidebar.php';?>
    <div class="feed">
        <?php
        $back = 'OneTimeMailings';
        $title = "Новая рассылка";
        include ('default/header.php');
        ?>
        <div class=" _container">
            <div class="new-mailing__body">
                <form action="/NewMailing/create" method="POST" enctype="multipart/form-data">
                    <?php if ($_SESSION['item_id']) echo "<input hidden name='id' value='{$_SESSION['item_id']}'>"?>
                    <div class="new-mailing__settings">

                        <div class="new-mailing__block">
                            <label class="new-mailing__subtitle" for="text">Настройте ваше письмо</label>
                            <div class="input_focus ">
                                <label for="text" class="label_focus">Тема письма</label>
                                <input required min="3" name="name" type="text" id="social__inpu" minlength="3" value="<?php echo ($content['name']) ?? '' ?>">
                                <span class="clear_input_val">
                                    <img src="/img/clear_input.svg" alt="">
                                </span>
                            </div>
                            <div class="new-mailing__text">
                                <div class="wrapper" style="display: block; width: 75%; margin: 96px auto; position: relative;">
                                    <form name="wc-richTextEditor" id="wc-richTextEditor-form" class="wc-richTextEditor" action="#" method="post">

                                        <!-- Editor Control Box -->
                                        <div class="editor-controls" id="editor-controls">

                                            <!-- Font Family -->
                                            <div class="rte editor button-group" id="fontFamilyGroup">
                                                <div class="rte editor dropdown-label"><i class="fa fa-fw fa-font"></i></div>
                                                <select class="rte dropdown editor" id="fontFamily" title="Font Family"><i class="fa fa-fw fa-font"></i>
                                                    <option value="Arial, Helvetica, sans-serif" style="font-family: Arial, Helvetica, sans-serif">Arial</option>
                                                    <option value="'Arial Black', Gadget, sans-serif" style="font-family: 'Arial Black', Gadget, sans-serif">Arial Black</option>
                                                    <option value="'Times New Roman', serif" style="font-family: 'Times New Roman">Times New Roman</option>
                                                    <option value="'Palatino Linotype', 'Book Antiqua', Palatino, serif" style="font-family: 'Palatino Linotype', 'Book Antiqua', Palatino, serif">Book Antiqua</option>
                                                    <option value="Impact, Charcoal, sans-serif", style="font-family: Impact, Charcoal, sans-serif">Impact</option>
                                                    <option value="'Lucida Sans Unicode', 'Lucida Grande', sans-serif" style="font-family: 'Lucida Sans Unicode', 'Lucida Grande', sans-serif">Lucida Console</option>
                                                    <option value="Tahoma, Geneva, sans-serif" style="font-family: Tahoma, Geneva, sans-serif">Tahoma</option>
                                                    <option value="'Trebuchet MS', Helvetica, sans-serif" style="font-family: 'Trebuchet MS', Helvetica, sans-serif">Trebuchet MS</option>
                                                    <option value="Verdana, Geneva, sans-serif" style="font-family: Verdana, Geneva, sans-serif">Verdana</option>
                                                </select>
                                            </div>

                                            <!-- Header Style -->
                                            <div class="rte editor button-group" id="parStyleGroup">
                                                <div class="rte editor dropdown-label"><i class="fa fa-fw fa-header"></i></div>
                                                <select class="rte dropdown editor" id="parStyle" title="Paragraph Style"><i class="fa fa-fw fa-font"></i>
                                                    <option value="h1" style="font-size: 2em; font-style: bold;" id="heading1">Heading 1</option>
                                                    <option value="h2" style="font-size: 1.75em; font-style: bold;" id="heading2">Heading 2</option>
                                                    <option value="h3" style="font-size: 1.5em; font-style: bold;">Heading 3</option>
                                                    <option value="h4" style="font-size: 1.25em; font-weight: 900;">Heading 4</option>
                                                    <option value="h5" style="font-size: 1.15em; font-weight: bold;">Heading 5</option>
                                                    <option value="h5" style="font-size: 1.15em; font-weight: bold;">Heading 6</option>
                                                    <option selected value="p" style="font-size: 1.0em; font-weight: bold;">Paragraph</option>
                                                </select>
                                            </div>

                                            <!-- Font Size -->
                                            <div class="rte editor button-group" id="textSizeGroup">
                                                <div class="rte editor dropdown-label"><i class="fa fa-fw fa-text-height"></i></div>
                                                <select class="rte dropdown editor" id="fontSize" title="Font Size" onclick=""><i class="fa fa-fw fa-font"></i>
                                                    <option value="1" size="1">1</option>
                                                    <option value="2" size="2">2</option>
                                                    <option value="3" size="3">3</option>
                                                    <option value="4" size="4">4</option>
                                                    <option value="5" size="5">5</option>
                                                    <option value="6" size="6">6</option>
                                                    <option value="7" size="7">7</option>
                                                </select>
                                            </div>

                                            <!-- Font Color -->
                                            <div class="rte editor button-group" id="textColorGroup">
                                                <div class="rte editor dropdown-label"><i class="fa fa-fw fa-pencil"></i></div>
                                                <select class="rte dropdown editor" id="textColor" title="Text Color" onclick=""><i class="fa fa-fw fa-font"></i>
                                                    <!--<option value="#eb5e6c" style="background-color: #eb5e6c; color: black;">Pig</option>-->
                                                    <option value="#eb2538" data-textcolor="white" style="background-color: #eb2538; color: white;">Scarlet</option>
                                                    <option value="#be1e2d" data-textcolor="white" style="background-color: #be1e2d; color: white;">Crimson</option>
                                                    <option value="#eb25a2" data-textcolor="black" style="background-color: #eb25a2; color: black;">Hot Pink</option>
                                                    <option value="#be1e9e" data-textcolor="black" style="background-color: #be1e9e; color: black;">Violet</option>
                                                    <option value="#781363" data-textcolor="white" style="background-color: #781363; color: white;">Plumb</option>
                                                    <option value="#5a25eb" data-textcolor="white" style="background-color: #5a25eb; color: white;">Indigo</option>
                                                    <option value="#491ebe" data-textcolor="white" style="background-color: #491ebe; color: white;">Royal Blue</option>
                                                    <option value="#2e1378" data-textcolor="white" style="background-color: #2e1378; color: white;">Navy</option>
                                                    <option value="#25aceb" data-textcolor="black" style="background-color: #25aceb; color: black;">Sky</option>
                                                    <option value="#1e79be" data-textcolor="white" style="background-color: #1e79be; color: white;">Aqua</option>
                                                    <option value="#135178" data-textcolor="white" style="background-color: #135178; color: white;">Deep Sea</option>
                                                    <option value="#25eb64" data-textcolor="black" style="background-color: #25eb64; color: black;">Lime</option>
                                                    <option value="#1ebe6e" data-textcolor="black" style="background-color: #1ebe6e; color: black;">Emerald</option>
                                                    <option value="#137858" data-textcolor="white" style="background-color: #137858; color: white;">Forest</option>
                                                    <option value="#e8eb35" data-textcolor="black" style="background-color: #e8eb35; color: black;">Lemon</option>
                                                    <option value="#d1be17" data-textcolor="white" style="background-color: #d1be17; color: white;">Mustard</option>
                                                    <option value="#787813" data-textcolor="white" style="background-color: #787813; color: white;">Olive</option>
                                                    <option value="#eb6725" data-textcolor="black" style="background-color: #eb6725; color: black;">Carrot</option>
                                                    <option value="#be511e" data-textcolor="white" style="background-color: #be511e; color: white;">Pumpkin</option>
                                                    <option value="#57391e" data-textcolor="white" style="background-color: #57391e; color: white;">Chocolate</option>
                                                    <option value="#ffffff" data-textcolor="black" style="background-color: #ffffff; color: black;">White</option>
                                                    <option value="#ebebeb" data-textcolor="black" style="background-color: #ebebeb; color: black;">Plaster</option>
                                                    <option value="#bebebe" data-textcolor="black" style="background-color: #bebebe; color: black;">Concrete</option>
                                                    <option value="#787878" data-textcolor="white" style="background-color: #787878; color: white;">Asphalt</option>
                                                    <option value="#000000" data-textcolor="white" style="background-color: #000000; color: white;">Black</option>
                                                    <option value="CUSTOM" style="background-color: white">CUSTOM</option>
                                                </select>
                                            </div>

                                            <!-- Inline Styles -->
                                            <div class="rte editor button-group" id="inlineStyleGroup">
                                                <!-- Bold -->
                                                <a class="rte button editor" id="bold" title="Bold" onclick="boldSel()"><i class="fa fa-fw fa-bold"></i></a>
                                                <!-- Italicize -->
                                                <a class="rte button editor" id="italic" title="Italicize" onclick="italicSel()"><i class="fa fa-fw fa-italic"></i></a>
                                                <!-- Underline -->
                                                <a class="rte button editor" id="underline" title="Underline" onclick="underlineSel()"><i class="fa fa-fw fa-underline"></i></a>
                                                <!-- Strikethrough -->
                                                <a class="rte button editor" id="strikethrough" title="Strikethrough" onclick="strikethroughSel()"><i class="fa fa-fw fa-strikethrough"></i></a>
                                            </div>

                                            <!-- Alignment -->
                                            <div class="button-group" id="alignmentGroup">
                                                <!-- Align Left -->
                                                <a class="rte button editor" id="left" title="Left-align" onclick="alignLeftSel()"><i class="fa fa-fw fa-align-left"></i></a>
                                                <!-- Align Center -->
                                                <a class="rte button editor" id="center" title="Center-align" onclick="alignCenterSel()"><i class="fa fa-fw fa-align-center"></i></a>
                                                <!-- Align Right -->
                                                <a class="rte button editor" id="right" title="Right-align" onclick="alignRightSel()"><i class="fa fa-fw fa-align-right"></i></a>
                                                <!-- Justify -->
                                                <a class="rte button editor" id="justify" title="Justify" onclick="alignJustifySel()"><i class="fa fa-fw fa-align-justify"></i></a>
                                            </div>

                                            <!-- Lists -->
                                            <div class="button-group" id="listsGroup">
                                                <!-- Unordered List -->
                                                <a class="rte button editor" id="unordered" title="Bulleted List" onclick="newUlSel()"><i class="fa fa-fw fa-list-ul"></i></a>
                                                <!-- Ordered List -->
                                                <a class="rte button editor" id="ordered" title="Numbered List" onclick="newOlSel()"><i class="fa fa-fw fa-list-ol"></i></a>
                                            </div>

                                            <!-- Hyperlinks -->
                                            <div class="button-group" id="linkGroup">
                                                <!-- Hyperlink -->
                                                <a class="rte button editor" id="link" title="Add Hyperlink" onclick="linkSel()"><i class="fa fa-fw fa-link"></i></a>
                                                <!-- Remove Hyperlink -->
                                                <a class="rte button editor" id="unlink" title="Remove Hyperlink" onclick="unlinkSel()"><i class="fa fa-fw fa-unlink"></i></a>
                                            </div>

                                        </div>

                                        <!-- Editor text box -->
                                        <textarea class="editor-text-box" id="editor-text-box" name="textareaBox" style="display:none" wrap="hard"></textarea>
                                        <iframe class="editor-richText-box" id="editor-richText-box" name="richTextBox"></iframe>

                                        <!-- Submit Content -->
                                        <a class="rte button main" id="submit" title="Submit" onclick="submitContent()">Save <i class="fa fa-fw fa-check button"></i></a>

                                        <!-- File Upload -->
                                        <div class="rte button main fileUpload">
                                            <span>Upload <i class="fa fa-fw fa-upload"></i></span>
                                            <input type="file" accept=".txt" class="upload" id="fileImport"/>
                                        </div>
                                    </form>
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
                                            <label class="new-mailing__subtitle" for="">Выберите  продукт</label>
                                            <div class="select-account social-network">
                                                <div id="myMultiselect" class="multiselect">
                                                    <div id="mySelectLabel" class="selectBox" onclick="toggleCheckboxArea(this)">
                                                        <select id="Audience" required name="indexs" class="form-select">
                                                            <option class="form-select__social-name" value="" id="name">Выберите группу аудитории</option>
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
                                        <div class="send__block">
                                            <label class="new-mailing__subtitle" for="">Кому отправить сообщение</label>
                                            <div class="select-account social-network">
                                                <div id="myMultiselect" class="multiselect">
                                                    <div id="mySelectLabel" class="selectBox" onclick="toggleCheckboxArea(this)">
                                                        <select id="Audience" required name="indexs" class="form-select">
                                                            <option class="form-select__social-name" value="" id="name">Выберите группу аудитории</option>
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
                                    <div class="new-mailing__block new-mailing__planning">
                                        <label class="new-mailing__subtitle" for="date">Запланировать отправку (мск)</label>
                                        <span style="color: #5A6474; font-size: 12px;">По умолчанию - сейчас</span>
                                        <div class="new-mailing__block_two">
                                            <div class="input_focus">
                                                <input id="date" type="date" name="date_send" value="<?php echo ($content['date_send']) ?? '' ?>">
                                                <span class="clear_input_val">
                                                     <img src="/img/clear_input.svg" alt="">
                                                </span>
                                            </div>
                                            <div class="input_focus ">
                                                <label for="username" class="label_focus"></label>
                                                <input type="time" name="time_send" id="social__inpu" value="<?php echo ($content['time_send']) ?? '' ?>">
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
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="/js/jquery-3.6.1.min.js"></script>
<script src="/js/rich_text_editor.js"></script>
<script src="/js/customInputs.js"></script>
<script src="../js/sidebar.js"></script>
<script src="/js/getNotifications.js"></script>
<script src="/js/autoTextArea.js"></script>
<script>
    var quill = new Quill('#editor', {
        theme: 'snow'
    });
</script>
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