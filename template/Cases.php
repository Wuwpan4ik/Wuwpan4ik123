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
                <?php
                $title = "Кейсы";
                include ('default/header.php');
                ?>

                <div class="Case _container">
                    <?php
                    $count = 0;
                    foreach ($content['cases'] as $item) {
                    ?>
                    <div class="cart inst">
                        <div class="service-price">
                            <div class="service">
                                <div class="image-service">
                                    <img src="img/inst.png"/>
                                </div>
                                <div class="service-text">
                                    <h2 class="service-titile"><?=$item['name'] ?></h2>
                                    <div class="starrating">
                                        <p><span class="name"><?=$item['author'] ?></span></p>
                                        <h2><img src="img/Star.svg" class="ico"> <?=$item['rating'] ?></h2>
                                    </div>
                                </div>
                            </div>
                            <div class="price">
                                <h2><?=$item['price'] ?>₽ в месяц</h2>
                                <p><img src="../img/timer.svg" alt=""><?php echo date("d.m.Y", strtotime($item['date'])) ?></p>
                            </div>
                        </div>
                        <div class="status-container">
                            <?php
                            switch ($item['status']) {
                                case '1':
                                    echo '<div class="Cinema status">
                                            Кино
                                         </div>';
                                    break;
                                case '2':
                                case '3':
                                case '4':
                                case '5':
                                    echo '<div class="Boosted status">
                                            Boosted
                                         </div>';
                                    break;
                            }
                            ?>
                        </div>
                        <div class="service-text-2">
                            <p><?=$item['description'] ?></p>
                        </div>
                        <div class="time-more-btn">

                            <a href="/Article/<?=$item['id'] ?>">
                                Узнать больше
                            </a>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <script src="../js/sidebar.js"></script>
        <script src="/js/jquery-3.6.1.min.js"></script>
        <script src="/js/getNotifications.js"></script>
  </body>
</html>