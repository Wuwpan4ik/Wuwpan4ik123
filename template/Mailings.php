<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Creator - Рассылки</title>
    <link rel="stylesheet" href="/css/nullCss.css">
    <link rel="stylesheet" href="/css/main.css">
    <!--Favicon-->
    <link rel="icon" type="image/x-icon" href="/uploads/course-creator/favicon.ico">
</head>
<body>
<div class="Mailings ">
    <?php include 'default/sidebar.php';?>
    <div class="feed">
        <?php
        $title = "Рассылки";
        include ('default/header.php');
        ?>
        <div class=" _container">
            <div class="Mailings__types">
                <div class="Mailings__item">
                    <div class="Mailings__image"><img src="/img/Mailings/one-time_mailing_lists.jpg" alt=""></div>
                    <div class="Mailings__title">
                        Разовые рассылки
                    </div>

                    <a class="Mailings__btn" href="/OneTimeMailings">Открыть</a>

                </div>
                <div class="Mailings__item">
                    <div class="Mailings__image"><img src="/img/Mailings/mailing_chain.jpg" alt=""></div>
                    <div class="Mailings__title">
                        Цепочки рассылок
                        <span class="Mailings__status">В разработке</span>
                    </div>

                    <a class="Mailings__btn" href="#">Открыть</a>

                </div>
            </div>
        </div>
    </div>
</div>
<script src="/js/jquery-3.6.1.min.js"></script>
<script src="../js/sidebar.js"></script>
<script src="/js/getNotifications.js"></script>
</body>
</html>