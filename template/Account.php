<html lang="ru" xmlns="http://www.w3.org/1999/html">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Creator - Настройки аккаунта</title>
    <link rel="stylesheet" href="/css/nullCss.css">
    <link rel="stylesheet" href="/css/aboutuser.css">
    <link rel="stylesheet" href="/css/main.css">
    <!--Favicon-->
    <link rel="icon" type="image/x-icon" href="/uploads/course-creator/favicon.ico">

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

                            <label class="menu-label" for="About" id="oplab"><p>Профиль</p></label>

                            <div class="tab">

                                <div class="about">

                                    <form method="POST" action="/Account/MainSettings" enctype="multipart/form-data">
                                        <h2>Ваши данные</h2>
                                        <div class="field">
                                            <div class="input_focus ">
                                                <label for="username" class="label_focus ">Электронная почта</label>
                                                <input class="half" type="email" name="email" value="<? echo $_SESSION['user']['email'] ?>">
                                                <span class="clear_input_val">
                                                     <img src="/img/clear_input.svg" alt="">
                                                </span>
                                            </div>

                                            <?php if(isset($_SESSION['error']['email_message'])) echo $_SESSION['error']['email_message'] ?>
                                            <div class="input_focus ">
                                                <label for="username" class="label_focus">Телефон</label>
                                                <input class="half" id="phone" name="phone" value="<?php print(htmlspecialchars(isset($_SESSION['user']['phone']) ? $_SESSION['user']['phone'] : '')) ?>">
                                                <span class="clear_input_val">
                                                     <img src="/img/clear_input.svg" alt="">
                                                </span>
                                            </div>


                                        </div>

                                        <h2>Расскажите о себе</h2>

                                        <div class="field">
                                            <div class="input_focus ">
                                                <label for="username" class="label_focus ">Имя</label>
                                                <input id="username" type="text" name="first_name" value="<? echo $_SESSION['user']['first_name'] ?>">
                                                <span class="clear_input_val">
                                                     <img src="/img/clear_input.svg" alt="">
                                                </span>
                                            </div>

                                            <div class="input_focus ">
                                                <label for="username" class="label_focus ">Фамилия</label>
                                                <input id="username" type="text" name="second_name" value="<? echo $_SESSION['user']['second_name'] ?>">
                                                <span class="clear_input_val">
                                                     <img src="/img/clear_input.svg" alt="">
                                                </span>
                                            </div>

                                            <div class="input_focus ">
                                                <label for="username" class="label_focus "></label>
                                                <input id="username" type="date" name="birthday" value="<? echo (htmlspecialchars($_SESSION['user']['birthday'])); ?>">
                                                <span class="clear_input_val">
                                                     <img src="/img/clear_input.svg" alt="">
                                                </span>
                                            </div>

                                            <?php if(isset($_SESSION['error']['first_name_message'])) echo $_SESSION['error']['first_name_message'] ?>

                                            <?php if(isset($_SESSION['error']['second_name_message'])) echo $_SESSION['error']['second_name_message'] ?>

                                        </div>
                                        <h2>Откуда вы?</h2>
                                        <div class="field">
                                            <div class="input_focus ">
                                                <label for="username" class="label_focus">Страна</label>
                                                <input type="text" name="country" value="<?php print(htmlspecialchars(isset($_SESSION['user']['country']) ? $_SESSION['user']['country'] : '')) ?>">
                                                <span class="clear_input_val">
                                                     <img src="/img/clear_input.svg" alt="">
                                                </span>
                                            </div>
                                            <div class="input_focus ">
                                                <label for="username" class="label_focus">Город</label>
                                                <input type="text" name="city" value="<?php print(htmlspecialchars(isset($_SESSION['user']['city']) ? $_SESSION['user']['city'] : ''))?>">
                                                <span class="clear_input_val">
                                                     <img src="/img/clear_input.svg" alt="">
                                                </span>
                                            </div>

                                            <div class="select-account social-network">
                                                <div id="myMultiselect" class=" multiselect">
                                                    <div id="mySelectLabel" class="selectBox" onclick="toggleCheckboxArea(this)">
                                                        <select name="currency" class="form-select">
                                                            <option id="name" value=""><?php echo ($_SESSION['user']['currency']) ?? "Выберите валюту"; ?></option>
                                                        </select>
                                                        <div class="overSelect"></div>
                                                    </div>
                                                    <div class="mySelectOptions">
                                                        <label class="item">$<input class="custom-checkbox" type="radio" value="$" /><img class="checkMark" src="../img/checkMark.svg" alt=""></label>
                                                        <label class="item">€<input class="custom-checkbox" type="radio" value="€" /><img class="checkMark" src="../img/checkMark.svg" alt=""></label>
                                                        <label class="item">₴<input class="custom-checkbox" type="radio" value="₴" /><img class="checkMark" src="../img/checkMark.svg" alt=""></label>
                                                        <label class="item">₽<input class="custom-checkbox" type="radio" value="₽" /><img class="checkMark" src="../img/checkMark.svg" alt=""></label>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <h2>Укажите соц сети для клиентов</h2>
                                        <div class="field">
                                            <div class="select-account social-network">
                                                <div id="myMultiselect" class="multiselect">
                                                    <div id="mySelectLabel" class="selectBox" onclick="toggleCheckboxArea(this)">
                                                        <select class="form-select">
                                                            <option class="form-select__social-name" id="name">Выберите соц сеть</option>
                                                        </select>
                                                        <div class="overSelect"></div>
                                                    </div>
                                                    <div class="mySelectOptions">
                                                        <label class="item social__item">Вконтакте<input class="custom-checkbox social__input" type="radio" value="vk" /><label for="happy"></label></label>
                                                        <label class="item social__item">WhatsApp<input class="custom-checkbox social__input" type="radio" value="whatsapp" /><label for="happy"></label></label>
                                                        <label class="item social__item">Твиттер<input class="custom-checkbox social__input" type="radio" value="twitter" /><label for="happy"></label></label>
                                                        <label class="item social__item">Фейсбук<input class="custom-checkbox social__input" type="radio" value="facebook" /><label for="happy"></label></label>
                                                        <label class="item social__item">Инстаграм<input class="custom-checkbox social__input" type="radio" value="instagram" /><label for="happy"></label></label>
                                                        <label class="item social__item">Ютуб<input class="custom-checkbox social__input" type="radio" value="youtube" /><label for="happy"></label></label>
                                                        <label class="item social__item">Телеграм<input class="custom-checkbox social__input" type="radio" value="telegram" /><label for="happy"></label></label>
                                                        <label class="item social__item">Сайт<input class="custom-checkbox social__input" type="radio" value="site" /><label for="happy"></label></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="input_focus ">
                                                <label for="username" class="label_focus">Укажите ссылку</label>
                                                <input type="text" id="social__inpu" minlength="10">
                                                <span class="clear_input_val">
                                                     <img src="/img/clear_input.svg" alt="">
                                                </span>
                                            </div>
                                        </div>
                                        <button type="button" id="social__submit" class="add-social-network"><img src="../img/addSocialNetwork.svg" alt=""> Добавить соц сеть</button>
                                        <div class="ProfileSetting">
                                            <h2 class="no_margin">Загрузите аватар автора:</h2>
                                            <script>
                                                function function_return() {
                                                    document.getElementById("hb").style["display"] = "block";
                                                }
                                            </script>
                                            <div class="ProfileSetting-body">
                                                <div class="ProfileSetting-avatar">
                                                    <img src="<? echo (isset($_SESSION['user']['avatar'])  ? $_SESSION['user']['avatar'] : "/uploads/ava/userAvatar.jpg") ?>" id="ava_preload">
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

                            <label class="menu-label" for="Integrations"><p>Настройки</p></label>

                            <div class="tab">

                                <div class="prodamus-input">
                                    <form action="/Account/SaveSchoolSettings" method="POST">
                                        <h2>Основные данные о школе</h2>

                                        <div class="field">

                                            <div class="input_focus ">
                                                <label for="username" class="label_focus">Страна</label>
                                                <input class="inf" type="text" name="school_name" value="<? echo (htmlspecialchars(isset($_SESSION['user']['school_name']) ? $_SESSION['user']['school_name'] : '')) ?>">
                                                <span class="clear_input_val">
                                                     <img src="/img/clear_input.svg" alt="">
                                                </span>
                                            </div>

                                            <div class="select-account social-network">
                                                <div id="myMultiselect" class="multiselect">
                                                    <div id="mySelectLabel" class="selectBox" onclick="toggleCheckboxArea(this)">
                                                        <select name="niche" class="form-select">
                                                            <option id="name" selected><?php echo ($_SESSION['user']['niche']) ?? "Выберите вашу нишу"?></option>
                                                        </select>
                                                        <div class="overSelect"></div>
                                                    </div>
                                                    <div class="mySelectOptions">
                                                        <?php
                                                        $options = ["Изотерика", "Обучение", "Дизайн", "Политика", "Спорт", "Игры", "Животные"];
                                                        for($i = 0; $i<7; $i++){?>
                                                          <label class="item"><?=$options[$i]?><input class="custom-checkbox" type="radio" value="<?=$options[$i]?>" /><img class="checkMark" src="../img/checkMark.svg" alt=""></label>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>

                                        <div class="about_school">
                                            <textarea name="school_desc" placeholder="Описание школы"><?php echo $_SESSION['user']['school_desc']?></textarea>
                                        </div>
                                        <h2>Данные вашего тарифа:</h2>
                                        <div class="field">
                                            <div class="tariff-card">

                                                <div class="tariff-name">
                                                    У вас выбран тариф:
                                                    <p>Starter</p>
                                                </div>
                                                <div class="tariff-plan">
                                                    Стоимость тарифа:
                                                    <div class="tariff-price">2 990 ₽/ мес  <?=isset($_SESSION["user"]['currency']) ? $_SESSION["user"]['currency'] : '₽'?></div>
                                                </div>
                                                <div class="tariff-img">
                                                    <img src="/img/Starter.jpg" alt="">
                                                </div>
                                                <div  class="tariff-btn">
                                                    <a id="change-tariff">Сменить тариф</a>
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
                                                    <a id="improvement-tariff">Увеличить хранилище</a>
                                                </div>
                                            </div>
                                            <?php include 'template/default/popup__templates/popup__tariffs.php'?>
                                            <div class="improvement-tariff-popup popup-tariff">
                                                <div class="popup-tariff-body">
                                                    <div class="popup__title">
                                                        Хотите больше <br>
                                                        возможностей?
                                                    </div>

                                                    <div class="popup-tariff__cards">
                                                        <div class="popup-tariff__card">
                                                            <div class="popup-tariff__card-body">
                                                                <div class="popup-tariff__subtitle">
                                                                    Вам доступно:
                                                                </div>

                                                                <div class="popup-tariff__info">
                                                                    <div class="popup-tariff__info-users popup-tariff-info-body">
                                                                            <p class="text">Пользователей:</p>
                                                                            <div class="popup-tariff__info-users-body">
                                                                                <div class="progress-users progress">
                                                                                    <progress max="300" value="200">
                                                                                    </progress>
                                                                                    <div class="progress__info">
                                                                                        <div class="progress__current-value">
                                                                                            200
                                                                                        </div>
                                                                                        <div class="progress__max-value">
                                                                                            300
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        <div class="button-add">
                                                                            <button><img src="../img/addSocialNetwork.svg" alt="">Добавить 100</button>
                                                                        </div>

                                                                    </div>
                                                                    <div class="popup-tariff__info-place-memory popup-tariff-info-body">
                                                                            <p class="text">Места на хостинге:</p>
                                                                            <div class="popup-tariff__info-users-body">
                                                                                <div class="progress-memory progress">
                                                                                    <progress max="1000" value="225">
                                                                                    </progress>
                                                                                    <div class="progress__info">
                                                                                        <div class="progress__current-value">
                                                                                            225 мб
                                                                                        </div>
                                                                                        <div class="progress__max-value">
                                                                                            1 000 мб
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="button-add">
                                                                                <button><img src="../img/addSocialNetwork.svg" alt="">Добавить 100</button>
                                                                            </div>
                                                                    </div>
                                                                </div>
                                                                <div class="popup-tariff__price">
                                                                    К оплате
                                                                    <div class="tariff-price">2 990 ₽/ мес </div>
                                                                </div>
                                                                <div class="popup-tariff-button ">
                                                                    <button>
                                                                        Перейти к оплате
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
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

                            <input type="radio" id="Tarif" name="mytabs"/>
                            <label class="menu-label" for="Tarif" id="cllab"><p>Дополнительно</p></label>

                            <div class="tab">
                        <div class="prodamus-input col">
                            <div class="inner_row">
                                <h2>Подключение Prodamus:  </h2>
                                <div class="row">
                                    <div class="input_focus ">
                                        <label for="username" class="label_focus">API Ключ</label>
                                        <input class="inf" type="text"  name="prodamus_api" value="<? print(htmlspecialchars(isset($_SESSION['user']['school_name']) ? $_SESSION['user']['school_name'] : '')) ?>">
                                        <span class="clear_input_val">
                                                     <img src="/img/clear_input.svg" alt="">
                                                </span>
                                    </div>
                                    <div class="input_focus ">
                                        <label for="username" class="label_focus">API Ключ</label>
                                        <input class="inf" type="text"  name="prodamus_api" value="<? print(htmlspecialchars(isset($_SESSION['user']['school_name']) ? $_SESSION['user']['school_name'] : '')) ?>">
                                        <span class="clear_input_val">
                                                     <img src="/img/clear_input.svg" alt="">
                                                </span>
                                    </div>
                                </div>
                            </div>
                            <div class="inner_row">
                                <h2>Подключение Albato:  </h2>
                                <div class="row">
                                    <div class="input_focus ">
                                        <label for="username" class="label_focus">API Ключ</label>
                                        <input class="inf" type="text"  name="albato_api" value="<? print(htmlspecialchars(isset($_SESSION['user']['school_name']) ? $_SESSION['user']['school_name'] : '')) ?>">
                                        <span class="clear_input_val">
                                                     <img src="/img/clear_input.svg" alt="">
                                                </span>
                                    </div>
                                    <div class="input_focus ">
                                        <label for="username" class="label_focus">API Ключ</label>
                                        <input class="inf" type="text"  name="albato_api" value="<? print(htmlspecialchars(isset($_SESSION['user']['school_name']) ? $_SESSION['user']['school_name'] : '')) ?>">
                                        <span class="clear_input_val">
                                                     <img src="/img/clear_input.svg" alt="">
                                                </span>
                                    </div>
                                </div>
                            </div>
                            <div class="inner_row scripts">
                                <div class="script">
                                    <h2>Скрипты для HEAD:  </h2>
                                    <div class="row">
                                        <textarea class="additionally" placeholder="Default" name="head_additional"></textarea>
                                    </div>
                                </div>
                                <div class="script">
                                    <h2>Скрипты для Body:  </h2>
                                    <div class="row">
                                        <textarea class="additionally" placeholder="Default" name="body_additional"></textarea>
                                    </div>
                                </div>

                            </div>

                            <div class="about-btn">
                                <button id="profile_send" type="submit">Сохранить</button>
                            </div>
                        </div>
                    </div>


                </div>
                        <div class="exit-settings popup-tariff">
                            <div class="popup-tariff-body">
                                <div class="popup__title">
                                    Если вы покинете страницу </br>введенные  вами данные </br> не сохраняться
                                </div>
                                <div class="popup__buttons">
                                    <button id="close-popup" class="popup__btn popup__white">Покинуть</button>
                                    <button class="popup__btn popup__blue">Сохранить</button>
                                </div>
                            </div>
                        </div>
            </div>

    </div>

</div>

</div>
<?php unset($_SESSION['error']) ?>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery.maskedinput@1.4.1/src/jquery.maskedinput.min.js" type="text/javascript"></script>
<script>
    /*Popups*/
    let changeTariff = document.querySelector('.change-tariff-popup');
    let improvementTariff = document.querySelector('.improvement-tariff-popup');
    let exitSettings = document.querySelector('.exit-settings');
    let exitSettingsClose = document.querySelector('#close-popup');
    let changeTariffOpen = document.querySelector('#change-tariff');
    let improvementTariffOpen = document.querySelector('#improvement-tariff');

    exitSettingsClose.addEventListener('click', function(){
        exitSettings.classList.remove('active');
    })

    changeTariffOpen.addEventListener('click', function(){
        changeTariff.classList.add('active');
    })
    improvementTariffOpen.addEventListener('click', function(){
        improvementTariff.classList.add('active');
    })

    document.querySelectorAll('.popup-tariff').forEach(item => {
        item.addEventListener('click', function(){
            improvementTariff.classList.remove('active');
            changeTariff.classList.remove('active');
        })
    })

    document.getElementById('social__inpu').addEventListener('input', function (){
        console.log(this.value)
        document.getElementById('social__link').value = this.value;
    })

    document.getElementById('social__submit').addEventListener('click', function (){
        document.getElementById('social__button').click();
    })

    console.log()
    const button_submit = document.querySelector('#profile_send');
    const check_url = document.querySelector('#check_url');
    const check_button = document.querySelector('#check_button');
    const message = document.querySelector('#message');

    button_submit.addEventListener('click', function () {
        let second_button = document.querySelector('#apps');
        second_button.click();
    });

</script>

<script src="/js/getNotifications.js"></script>
<script src="/js/customInputs.js"></script>
<script src="/js/customSelect.js"></script>
<script src="/js/printFailName.js" ></script>
<script>
    let form__submit = $(function() {
        $('#social__form').each(function (){
            $(this).submit(function(e) {
                e.preventDefault();
                if (($(this).find('#social__link')[0].value.length) <= 10) {
                    // Событие при нехватки длины
                    alert("Не хватает длины");
                    return;
                }
                try {
                    // Alert
                    $('#social__input')[0].value = $('.form-select__social-name')[0].value;
                    $.post(e.target.action, $(this).serialize());
                    alert("Ваши данные сохранены");
                    GetSocial();
                } catch {}
            });
        })
    });
</script>

<script>
    function GetSocial() {
        $.ajax({
            url: "/Account/SocialUrls",
            type: "POST",
            success: function (data) {
                let social__url = JSON.parse(data)
                let social__button = document.querySelectorAll('.social__item');
                console.log(social__url)
                social__button.forEach(item => {
                    item.addEventListener('click', function () {
                        let val = item.querySelector('.social__input').value;
                        document.querySelector('#social__inpu').value = social__url[0][val];
                        CheckInputs();
                    })
                })
            }
        });
    }
    GetSocial();
</script>
<script src="../js/sidebar.js"></script>
<form id="social__form" class="social__form display-none" action="/Account/SaveSocialSettings" method="POST">
    <input id="social__input" type="text" name="social" value="">
    <input id="social__link" type="text" name="link" value="">
    <button id="social__button" type="submit"></button>
</form>
</body>

</html>