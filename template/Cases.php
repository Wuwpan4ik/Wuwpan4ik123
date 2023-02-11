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
        <div class="Cases ">
            <?php include 'default/sidebar.php';?>
            <div class="feed">

                <div class="Case _container">
                    <?php
                    $title = "Кейсы";
                    include ('default/header.php');
                    foreach($content as $case):

                    ?>
                    <div class="cart inst">
                        <div class="service-price">
                            <div class="service">
                                <div class="image-service">
                                    <img src="img/inst.png"/>
                                </div>
                                <div class="service-text">
                                    <h2 class="service-titile"><?php echo htmlspecialchars($case['name']); ?></h2>
                                    <div class="starrating">
                                        <p><span class="name"><?php echo htmlspecialchars($case['avatar']); ?></span></p>
                                        <h2><img src="img/Star.svg" class="ico"><?php echo htmlspecialchars($case['rating']); ?></h2>
                                    </div>
                                </div>
                            </div>
                            <div class="price">
                                <h2>109 100Р - 160 000Р в месяц</h2>
                                <p><img src="../img/timer.svg" alt=""><?php echo date("d.m.Y", strtotime($case['date'])); ?></p>
                            </div>
                        </div>
                        <div class="status-container">
<!--                            <div class="Cinema status">Кино</div>-->
                            <div class="Boosted status"><?php echo htmlspecialchars($case['status']); ?></div>
                        </div>
                        <div class="service-text-2">
                            <p><?php echo htmlspecialchars($case['description']); ?></p>
                        </div>
                        <div class="time-more-btn">

                            <a href="/Article/<?php echo htmlspecialchars($case['id']); ?>">
                                Узнать больше
                            </a>
                        </div>
                    </div>
                    <?php endforeach; ?>
<!--                    <div class="cart">-->
<!--                        <div class="service-price">-->
<!--                            <div class="service">-->
<!--                                <div class="image-service">-->
<!--                                    <img src="img/Netflix.jpeg"/>-->
<!--                                </div>-->
<!--                                <div class="service-text">-->
<!--                                    <h2 class="service-titile">Курсы по режиссуре</h2>-->
<!--                                    <div class="starrating">-->
<!--                                        <p><span class="name">Lexa</span></p>-->
<!--                                        <h2><img src="img/Star.svg" class="ico"> 4.4</h2>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="price">-->
<!--                                <h2>109 100Р - 160 000Р в месяц</h2>-->
<!--                                <p><img src="../img/timer.svg" alt="">26.01.2022</p>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="status-container">-->
<!--                            <div class="Cinema status">Кино</div>-->
<!--                        </div>-->
<!--                        <div class="service-text-2">-->
<!--                            <p>Калинин В.С. – руководитель мастерских режиссуры ВГИК, доцент режиссуры кино и телевидения,-->
<!--                                режиссёр, федеральный эксперт в области профессионального образования, сценарист,-->
<!--                                лауреат отечественных, зарубежных премий. «Можно долго говорить о том, что я уникален и это факт!-->
<!--                                За меня всё скажет интернет». Читай отзывы, смотри YouTube</p>-->
<!--                        </div>-->
<!---->
<!--                        <div class="time-more-btn">-->
<!---->
<!---->
<!--                                <a href="/Article">-->
<!--                                    Узнать больше-->
<!--                                </a>-->
<!---->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
            </div>
        </div>
        <script src="../js/sidebar.js"></script>
        <script src="/js/getNotifications.js"></script>
  </body>
</html>