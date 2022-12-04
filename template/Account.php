<html lang="ru">

<head>

    <meta charset="utf-8">

    <title>Course Creator - Настройки аккаунта</title>
    <link rel="stylesheet" href="/css/nullCss.css">
    <link rel="stylesheet" href="/css/aboutuser.css">
    <link rel="stylesheet" href="/css/main.css">
    <!--Favicon-->
    <link rel="icon" type="image/x-icon" href="/uploads/course-creator/favicon.ico">
  </head>

</head>

<body>

<div class="SettingAccount">

    <?php include 'default/sidebar.php';?>

    <div class="feed">

        <?php
        $title = "Настройки аккаунта";
        include ('default/header.php');
        ?>

        <div class="Components">
            <div class="_container">
                <div class="AboutUser">

                    <h2>Основная информация о вас</h2>

                    <p class="info_account">Эта информация поможет вам востановить доступ к аккаунту в случае необходимости,

                        и позволит нам давать вам более персонализированный контент который вам поможет в запуске.</p>

                    <div class="mytabs">

                        <input type="radio" id="About" name="mytabs" checked="checked"/>

                        <label for="About" id="oplab"><p>Профиль</p></label>

                        <div class="tab">

                            <div class="about">

                                <form method="POST" action="/Account/MainSettings" enctype="multipart/form-data">
                                        <h2>Ваши данные</h2>
                                        <div class="field">
                                            <input class="half" name="email" type="email" placeholder="<? echo $_SESSION['user']['email'] ?>"/>
                                            <?php if(isset($_SESSION['error']['email_message'])) echo $_SESSION['error']['email_message'] ?>
                                            <input class="half" name="phone" type="tel" value="<?php print(htmlspecialchars(isset($_SESSION['user']['phone']) ? $_SESSION['user']['phone'] : '+7')) ?>">
                                        </div>

                                        <h2>Расскажите о себе</h2>

                                        <div class="field">

                                            <input name="first_name" class="inf" placeholder="<? echo $_SESSION['user']['first_name'] ?>"/>

                                            <input name="second_name" class="inf" placeholder="<? if(!isset($_SESSION['user']['second_name'])) { echo "Фамилия";} else { echo $_SESSION['user']['second_name']; }?>"/>

                                            <input type="date" name="birthday" class="inf" placeholder="<? print(htmlspecialchars($_SESSION['user']['birthday'])); ?>"/>
                                            <?php if(isset($_SESSION['error']['first_name_message'])) echo $_SESSION['error']['first_name_message'] ?>

                                            <?php if(isset($_SESSION['error']['second_name_message'])) echo $_SESSION['error']['second_name_message'] ?>

                                        </div>
                                        <h2>Откуда вы?</h2>
                                        <div class="field">
                                            <input class="half" name="country" type="text" placeholder="<?php print(htmlspecialchars(isset($_SESSION['user']['country']) ? $_SESSION['user']['country'] : 'Страна')) ?>">
                                            <input class="half" name="city" type="text" placeholder="<?php print(htmlspecialchars(isset($_SESSION['user']['city']) ? $_SESSION['user']['city'] : 'Город'))?>" >
                                            <select class="select-account currencies" name="currency" id="currency">
                                                <option value="null">Выберите валюту</option>
                                                <option value="dollar">$</option>
                                                <option value="euro">€</option>
                                                <option value="grivna">₴</option>
                                                <option value="rub">₽</option>
                                            </select>
                                        </div>
                                        <h2>Укажите соц сети для клиентов</h2>
                                        <div class="field">
                                            <div class="select-account social-network">
                                                <div id="myMultiselect" class="multiselect">
                                                    <div id="mySelectLabel" class="selectBox" onclick="toggleCheckboxArea()">
                                                        <select class="form-select">
                                                            <option id="name">Выберите соц сеть</option>
                                                        </select>
                                                        <div class="overSelect"></div>
                                                    </div>
                                                    <div id="mySelectOptions">
                                                        <label>Вконтакте<input type="checkbox" value="Вконтакте" /></label>
                                                        <label>Твиттер<input type="checkbox" value="Твиттер" /></label>
                                                        <label>Фейсбук<input type="checkbox" value="Фейсбук" /></label>
                                                        <label>Инстаграм<input type="checkbox"  value="Инстаграм" /></label>
                                                        <label>Ютуб<input type="checkbox"  value="Ютуб" /></label>
                                                        <label>Телеграм<input type="checkbox"  value="Телеграм" /></label>
                                                        <label>Сайт<input type="checkbox" value="Сайт" /></label>
                                                    </div>
                                                </div>
                                            </div>
                                        <input class="half"  type="text" placeholder="Укажите ссылку" >
                                    </div>
                                        <div class="ProfileSetting">
                                            <h2 class="no_margin">Загрузите аватар автора:</h2>
                                            <script>
                                                function function_return() {
                                                    document.getElementById("hb").style["display"] = "block";
                                                }
                                            </script>
                                            <div class="ProfileSetting-body">
                                                <div class="ProfileSetting-avatar">
                                                    <img src="<? echo (isset($_SESSION['user']['avatar'])  ? $_SESSION['user']['avatar'] : "userAvatar.jpg") ?>" id="ava_preload">
                                                    <div class="ProfileSetting-name">
                                                        <?=$_SESSION["user"]["first_name"]?>
                                                        <? if (!isset($_SESSION["user"]["second_name"])) {echo "Фамилия";} else {echo $_SESSION["user"]["second_name"];} ?>
                                                    </div>
                                                </div>
                                                <div class="avatar">
                                                    <div class="avatar-body">
                                                        <img src="../img/saveAvatar.svg" alt="">
                                                        <div class="avatar-body__info">
                                                            <span id="file-name" class="file-box">Название файла</span>
                                                            <span id="file-size" class="file-box">0 кб из доступных 5 мб</span>
                                                        </div>

                                                    </div>


                                                    <div class="input__wrapper">
                                                        <input name="avatar" type="file" id="input__file" class="input input__file" onchange='uploadFile(this)' multiple>
                                                        <label for="input__file" class="input__file-button">

                                                            <span class="input__file-icon-wrapper"><img class="input__file-icon" src="./img/plus.svg"  width="25"></span>
                                                            <span class="input__file-button-text">Добавить</span>
                                                        </label>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>

                                        <div class="about-btn">
                                            <button id="profile_send" type="submit">Сохранить</button>
                                        </div>

                                    </form>

                                </div>
                            </div>

                            <input type="radio" id="Integrations" name="mytabs"/>

                            <label for="Integrations"><p>Настройки</p></label>

                            <div class="tab">

                                <div class="prodamus-input">
                                    <form action="/Account/SaveSchoolSettings" method="POST">
                                        <h2>Основные данные о школе</h2>

                                        <div class="field">

                                            <input class="half" name="school_name" type="text" placeholder="<? print(htmlspecialchars(isset($_SESSION['user']['school_name']) ? $_SESSION['user']['school_name'] : 'Название')) ?>"/>

                                            <select class="selector" name="niche">

                                                <?
                                                $options = ["Изотерика", "Обучение", "Дизайн", "Политика", "Спорт", "Игры", "Животные"];
                                                for($i = 0; $i<7; $i++){
                                                    if($options[$i] == $content[0][0]['niche']){?><option selected="selected"><?=$options[$i]?></option>
                                                    <?}else{?><option><?=$options[$i]?></option><?}
                                                }
                                                ?>

                                            </select>


                                        </div>
                                        <div class="about_school">
                                            <textarea name="school_desc" placeholder="<? print(htmlspecialchars(isset($_SESSION['user']['school_desc']) ? $_SESSION['user']['school_desc'] : 'Описание для школы')) ?>"></textarea>
                                        </div>
                                        <h2>Данные вашего тарифа:</h2>
                                        <div class="field">
                                            <div class="tariff-card">
                                                <div class="tariff-plan">
                                                    <div class="tariff-price">2 600 ₽</div>
                                                </div>
                                                <div class="tariff-name">
                                                    Для новичков
                                                </div>
                                                <div class="tariff-img">
                                                    <img src="/img/tarif-Image.jpg" alt="">
                                                </div>
                                                <div class="tariff-btn">
                                                    <button>Сменить тариф</button>
                                                </div>
                                            </div>
                                            <div class="tariff-card">
                                                <div class="tariff-current">
                                                    <div class="tariff-header">
                                                        <p>Тариф оплачен до:</p>
                                                        <div class="tariff-price">22.10.2022</div>
                                                    </div>

                                                </div>
                                                <div class="tariff__active-user">
                                                    <p class="text">Активных пользователей:</p>
                                                    <span>200 из 250</span>
                                                </div>
                                                <div class="storage-rate">
                                                    <p class="text">Файловое хранилище:</p>
                                                    <div class="storage-rate-body">
                                                        <div class="progress-storage">
                                                            <progress  max="1000" value="<?php print_r(round($content[2]))?>">
                                                            </progress>
                                                            <div class="progress-storage__info">
                                                                <div class="progress-storage__current-value">
                                                                    <?php print_r(round($content[2]))?> мб
                                                                </div>
                                                                <div class="progress-storage__max-value">
                                                                    1000 мб
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tariff-btn">
                                                    <button>Сменить тариф</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="about-btn">
                                            <button id="profile_send" type="submit">Сохранить</button>
                                        </div>
                                    </form>

                            </div>

                        </div>

                        <input type="radio" id="Tarif" name="mytabs"/>

                        <label for="Tarif" id="cllab"><p>Дополнительно</p></label>

                        <div class="tab">

                            <h2>Скрипты для HEAD:  </h2>

                            <textarea class="additionally" placeholder="Default" name="head_additional"></textarea>

                            <h2>Скрипты для Body:  </h2>

                            <textarea class="additionally" placeholder="Default" name="body_additional"></textarea>

                            <div class="about-btn">
                                <button id="profile_send" type="submit">Сохранить</button>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>

    </div>

</div>

</div>
<?php unset($_SESSION['error']) ?>

<script>
    /*Select*/
    function checkboxStatusChange() {
        let multiselectOption =  document.getElementById("name");
        let values = [];
        let checkboxes = document.getElementById("mySelectOptions");
        let checkedCheckboxes = checkboxes.querySelectorAll('input');

        checkedCheckboxes.forEach(item =>{
            item.addEventListener('click', function(){
                if(item.checked = true){
                    checkedCheckboxes.forEach(el =>{
                        el.checked = false
                        el.parentElement.classList.remove('active')
                    })
                    item.checked = true
                    item.parentElement.classList.add('active')
                    values = ( item.getAttribute('value'));
                }
                multiselectOption.innerText = values;
            })
        })
    }

    checkboxStatusChange()
    function toggleCheckboxArea(onlyHide = false) {
        let checkboxes = document.getElementById("mySelectOptions");
        const displayValue = checkboxes.style.display;

        if (displayValue != "flex") {
            if (onlyHide == false) {
                checkboxes.style.display = "flex";
            }
        } else {
            checkboxes.style.display = "none";
        }
    }

    const button_submit = document.querySelector('#profile_send');
    const check_url = document.querySelector('#check_url');
    const check_button = document.querySelector('#check_button');
    const message = document.querySelector('#message');

    button_submit.addEventListener('click', function () {
        let second_button = document.querySelector('#apps');
        console.log(second_button);
        second_button.click();
    });
    check_button.addEventListener('click', function () {
        const request = new XMLHttpRequest();

        const url = "?option=UrlController&site_url=" + check_url.value;

        /* Здесь мы указываем параметры соединения с сервером, т.е. мы указываем метод соединения GET,
        а после запятой мы указываем путь к файлу на сервере который будет обрабатывать наш запрос. */
        request.open('GET', url);

        // Указываем заголовки для сервера, говорим что тип данных, - контент который мы хотим получить должен быть не закодирован.
        request.setRequestHeader('Content-Type', 'application/x-www-form-url');
        request.addEventListener("readystatechange", () => {
            if (request.readyState === 4 && request.status === 200) {
                message.innerHTML = request.responseText;
            }
        });
        request.send();
    });

</script>
<script src="/js/getNotifications.js"></script>
<script src="/js/printFailName.js" ></script>
</body>

</html>