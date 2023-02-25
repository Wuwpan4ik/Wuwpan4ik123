<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Creator - Кейсы</title>
    <link rel="stylesheet" href="/css/nullCss.css">
    <link rel="stylesheet" href="/css/main.css">
    <!--Favicon-->
    <link rel="icon" type="image/x-icon" href="/uploads/course-creator/favicon.ico">
</head>
<body>
<div class="new-mailing">
    <?php include 'default/sidebar.php';?>
    <div class="feed">
        <?php
        $title = "Новая рассылка";
        include ('default/header.php');
        ?>
        <div class=" _container">
            <div class="new-mailing__body">
                <div class="new-mailing__card ot-mailing">
                    <div class="ot-mailing__info">
                        <p class="new-mailing__title">Акция на пицы</p>
                        <p class="new-mailing__description ot-mailing__limit">Описание если нужно</p>
                        <div class="ot-mailing__image"><img src="/img/Mailings/one-time_mailing_lists.jpg" alt=""></div>
                    </div>
                </div>

                <div class="new-mailing__settings">

                    <div class="new-mailing__block">
                        <label class="new-mailing__subtitle" for="">Новая рассылка</label>

                        <div class="input_focus ">
                            <label for="username" class="label_focus">Добавьте текст сообщения</label>
                            <input min="3" type="text" id="social__inpu" minlength="3">
                            <span class="clear_input_val">
                                <img src="/img/clear_input.svg" alt="">
                            </span>
                        </div>

                        <div class="new-mailing__block_two">
                            <div class="input_focus ">
                                <label for="username" class="label_focus">Кнопка</label>
                                <input min="3" type="text" id="social__inpu" minlength="3">
                                <span class="clear_input_val">
                                <img src="/img/clear_input.svg" alt="">
                            </span>
                            </div>
                            <div class="input_focus ">
                                <label for="username" class="label_focus">Ссылка для кнопки</label>
                                <input min="3" type="text" id="social__inpu" minlength="3">
                                <span class="clear_input_val">
                                <img src="/img/clear_input.svg" alt="">
                            </span>
                            </div>
                        </div>

                        <button class="Mailings__btn"><img src="/img/Mailings/plus_gray.svg" alt="">Добавить кнопку</button>
                    </div>

                    <div class="new-mailing__block">
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
                    </div>

                    <div class="new-mailing__block">
                        <label class="new-mailing__subtitle" for="">Запланировать отправку</label>

                        <div class="new-mailing__block_two">
                            <div class="input_focus ">
                                <label for="username" class="label_focus"></label>
                                <input id="username" type="date" required  name="birthday" value="">
                                <span class="clear_input_val">
                                                     <img src="/img/clear_input.svg" alt="">
                                                </span>
                            </div>
                            <div class="input_focus ">
                                <label for="username" class="label_focus">Ссылка для кнопки</label>
                                <input min="3" type="time" required id="social__inpu" minlength="3">
                                <span class="clear_input_val">
                                <img src="/img/clear_input.svg" alt="">
                            </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/js/customInputs.js"></script>
<script src="../js/sidebar.js"></script>
<script src="/js/getNotifications.js"></script>
</body>
</html>