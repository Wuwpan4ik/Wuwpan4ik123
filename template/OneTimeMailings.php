<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Creator - Разовая рассылка</title>
    <link rel="stylesheet" href="/css/nullCss.css">
    <link rel="stylesheet" href="/css/main.css">
    <!--Favicon-->
    <link rel="icon" type="image/x-icon" href="/uploads/course-creator/favicon.ico">
</head>
<body>
<div class="ot-mailings">
    <?php include 'default/sidebar.php';?>
    <div class="feed">
        <?php
        $back = 'Mailings';
        $title = "Разовые рассылки";
        include ('default/header.php');
        ?>
        <div class=" _container">
            <div class="ot-mailings__body">
                <?php foreach ($content['mailings'] as $mail) { ?>
                <div class="ot-mailing">
                    <div class="ot-mailing__header">
                        <span class="ot-mailing__date">Отправлено <?= date("d.m.Y", strtotime($mail['date_send'])) ?> в <?= date("g:i", strtotime($mail['date_send'])) ?></span>
                        <a href="/mailing-delete/<?=$mail['id']?>" class="delete_btn"><img src="/img/Delete.svg" alt=""></a>
                    </div>

                    <div class="ot-mailing__info">
                        <p class="ot-mailing__limit">Текст рассылки до 150 символов тут</p>
                        <div class="ot-mailing__image"><img src="/img/Mailings/one-time_mailing_lists.jpg" alt=""></div>
                        <div class="ot-mailing__recipients">
                            <p class="ot-mailing__subtitle">Сообщение отправиться:</p>
                            <?php
                                switch ($mail['indexs']) {
                                    case 1:
                                        echo '<div class="ot-mailing__recipient ot-mailing__recipient_all">
                                                  Всем <img src="/img/x.svg" alt="">
                                              </div>';
                                        break;
                                    case 2:
                                        echo '<div class="ot-mailing__recipient">
                                                 Тем кто оплатил <img src="/img/x.svg" alt="">
                                              </div>';
                                        break;
                                    case 3:
                                        echo '<div class="ot-mailing__recipient ot-mailing__recipient_didnt-pay">
                                                 Тем кто не оплатил <img src="/img/x.svg" alt="">
                                              </div>';
                                        break;
                                }
                            ?>
                        </div>
                    </div>
                    <a href="/NewMailing/<?=$mail['id']?>" class="ot-mailing__btn"><img src="/img/Pen.svg" alt="">Редактировать</a>
                </div>
                <?php } ?>
                <div class="mailing__create" style="width: auto;">

                    <a href="/NewMailing" class="mailing_new">

                        <img src="/img/Create_mailing.svg" class="create-ico">

                        <p>Создать рассылку</p>

                    </a>

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