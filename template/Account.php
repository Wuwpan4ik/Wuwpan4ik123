<html>

    <head>

    <meta charset="utf-8">

    <title>Моя тестовая страница</title>


    <link rel="stylesheet" href="/css/nullCss.css">

    <link rel="stylesheet" href="/css/aboutuser.css">

    <link rel="stylesheet" href="/css/main.css">

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

                        <p>Эта информация поможет вам востановить доступ к аккаунту в случае необходимости,

                            и позволит нам давать вам более персонализированный контент который вам поможет в запуске.</p>

                        <div class="mytabs">

                            <input type="radio" id="About" name="mytabs" checked="checked"/>

                            <label for="About" id="oplab"><p>Профиль</p></label>

                            <div class="tab">

                                <div class="about">

                                    <form method="POST" action="/Course-rename/MainSettings">
                                        <h2>Ваши данные</h2>
                                        <div class="field">
                                            <input class="half" name="email" class="full" type="email" placeholder="<? echo $_SESSION['user']['email'] ?>"/>
                                            <?php if(isset($_SESSION['error']['email_message'])) echo $_SESSION['error']['email_message'] ?>
                                            <input class="half" name="num" type="tel" value="+7">
                                        </div>

                                        <h2>Расскажите о себе</h2>

                                        <div class="field">

                                            <input name="first_name" class="inf" placeholder="<? echo $_SESSION['user']['first_name'] ?>"/>

                                            <input name="second_name" class="inf" placeholder="<? echo $_SESSION['user']['second_name'] ?>"/>

                                            <input name="second_name" class="inf" placeholder="Дата рождения"/>
                                            <?php if(isset($_SESSION['error']['first_name_message'])) echo $_SESSION['error']['first_name_message'] ?>

                                            <?php if(isset($_SESSION['error']['second_name_message'])) echo $_SESSION['error']['second_name_message'] ?>

                                        </div>
                                        <h2>Откуда вы?</h2>
                                        <div class="field">
                                            <input class="half" type="text" placeholder="Страна">
                                            <input class="half" type="text" placeholder="Город">
                                        </div>


                                    </form>

                                </div>
                                <div class="ProfileSetting">
                                    <h2>Действие после нажатия:</h2>
                                    <script>
                                        function function_return() {
                                            document.getElementById("hb").style["display"] = "block";
                                        }
                                    </script>

                                    <form method="POST" enctype="multipart/form-data" action="?option=AccountController&method=saveAdditionalSettings">


                                        <div class="ProfileSetting-body">
                                            <div class="ProfileSetting-avatar">
                                                <img src="<?=$content[0][0]['avatar']?>" id="ava_preload">
                                                <div class="ProfileSetting-name">
                                                    Имя
                                                    Фамилия
                                                </div>
                                            </div>
                                            <div class="avatar">
                                                <div class="avatar-body">
                                                    <img src="../img/saveAvatar.svg" alt="">
                                                    <div class="avatar-body__info">
                                                        <span id="file-name" class="file-box"></span>
                                                        <span id="file-size" class="file-box"></span>
                                                    </div>

                                                </div>


                                                <div class="input__wrapper">
                                                    <input  accept="image/img, image/jpeg, image/png" name="file" type="file" id="input__file" class="input input__file" onchange='uploadFile(this)' multiple>
                                                    <label for="input__file" class="input__file-button">

                                                        <span class="input__file-icon-wrapper"><img class="input__file-icon" src="./img/plus.svg"  width="25"></span>
                                                        <span class="input__file-button-text">Добавить</span>
                                                    </label>
                                                </div>

                                            </div>




                                        </div>



                                    </form>

                                </div>

                            </div>

                            <input type="radio" id="Integrations" name="mytabs"/>

                            <label for="Integrations"><p>Настройки</p></label>

                            <div class="tab">

                                <div class="prodamus-input">

									<h2>Основные данные о школе</h2>

									<div class="field">

										<input class="half" type="text" placeholder="Название"/>

                                        <select class="selector" name="niche" >

                                            <?
                                            $options = ["Изотерика", "Обучение", "Дизайн", "Политика", "Спорт", "Игры", "Животные"];
                                            for($i = 0; $i<7; $i++){
                                                if($options[$i] == $content[0][0]['niche']){?><option selected="selected"><?=$options[$i]?></option>
                                                <?}else{?><option><?=$options[$i]?></option><?}
                                            }
                                            ?>

                                        </select>

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
                                                    <input type="text">
                                                </div>
                                            </div>
                                            <div class="tariff-btn">
                                                <button>Сменить тариф</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <input type="radio" id="Tarif" name="mytabs"/>

                            <label for="Tarif" id="cllab"><p>Дополнительно</p></label>

                            <div class="tab">

                                <h2>Подключить Send Plus</h2>

                                <div class="image-carts">
                                  
                                  <?php if(isset($content[1])) { foreach ($content[1] as $tariff) {?>

                                    <div class="cart">

                                        <div class="info-cart">

                                            <span><?=$tariff["price"]?>Р</span>

                                            <h3><?=$tariff["name"]?></h3>

                                            <p><?=$tariff["description"]?></p>

                                            <img src="<?=$tariff["image"]?>"/>

                                            <button>Перейти на этот тариф</button>

                                        </div>

                                    </div>

                                  <?} }?>

                                </div>

                            </div>

                        </div>
                        <div class="about-btn">
                            <button id="profile_send" type="submit">Сохранить</button>
                        </div>
                    </div>


                    </div>
                    </div>

                </div>

            </div>

        </div>
        <? unset($_SESSION['error']) ?>

        <script>
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
