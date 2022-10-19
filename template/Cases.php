<html>
  <head>
    <meta charset="utf-8">
    <title>Моя тестовая страница</title>
    <link rel="stylesheet" href="css/nullCss.css">
    <link rel="stylesheet" href="css/cases.css">
    <link rel="stylesheet" href="css/feed.css">
    <link rel="stylesheet" href="css/case.css">
    <link rel="stylesheet" href="css/main.css">
  </head>
  <body>
        <div class="Cases">
            <?php include 'default/sidebar.php';?>
            <div class="feed">
                <div class="feed-header">
                    <div class="header__arrow">
                        <a class="button__back" href="?option=Main">
                             <img src="/img/ArrowLeft.svg" alt="">
                        </a>

                        <h2>Доступные проекты</h2>
                    </div>
                    <div class="buttonsFeed">
                        <button class="ico_button"><img class="ico" src="img/Shield.svg"></button>
                        <button class="ico_button"><img class="ico" src="img/Bell.svg"></button>
                        <button id="apps" class="ico_button">Заявки</button>
                    </div>
                </div>
                <div class="Case">
                    <div class="cart inst">
                        <div class="service-price">
                            <div class="service">
                                <div class="image-service">
                                    <img src="img/inst.png"/>
                                </div>
                                <div class="service-text">
                                    <h2 class="service-titile">Курс менеджер инстаграм</h2>
                                    <div class="starrating">
                                        <p><span class="name">InstaKilogram</span> из Москвы</p>
                                        <h2><img src="img/Star.svg" class="ico"> 4.1</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="price">
                                <h2>109 100Р - 160 000Р в месяц</h2>
                                <div class="timer">
									<img src="img/Time.svg" class="ico">
                                    <p> недавно</p>
                                </div>
                            </div>
                        </div>
                        <div class="status-container">
                            <div class="Boosted status">Boosted</div>
                            <div class="Boosted status">Boosted</div>
                        </div>
                        <div class="service-text-2">
                            <p>Этот кейс – это история о том, как прокачать языковую онлайн школу для детей, запустив
                                проект с нуля с начала пандемии, и увеличить количество преподавателей в 7 раз, получив
                                3061 заявку из таргета Инстаграм. Об этом кейсе мы и рассказываем в этой статье.</p>
                        </div>
                        <div class="time-more-btn">
                            <p>29 января 2022</p>
                            <button>
                                Узнать больше
                            </button>
                        </div>
                    </div>
                    <div class="cart">
                        <div class="service-price">
                            <div class="service">
                                <div class="image-service">
                                    <img src="img/Netflix.jpeg"/>
                                </div>
                                <div class="service-text">
                                    <h2 class="service-titile">Курсы по режиссуре</h2>
                                    <div class="starrating">
                                        <p><span class="name">Lexa</span> из Армении</p>
                                        <h2><img src="img/Star.svg" class="ico"> 4.4</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="price">
                                <h2>109 100Р - 160 000Р в месяц</h2>
                                <div class="timer">
									<img src="img/Time.svg" class="ico">
                                    <p>4 дня назад</p>
                                </div>
                            </div>
                        </div>
                        <div class="status-container">
                            <div class="Cinema status">Кино</div>
                        </div>
                        <div class="service-text-2">
                            <p>Калинин В.С. – руководитель мастерских режиссуры ВГИК, доцент режиссуры кино и телевидения,
                                режиссёр, федеральный эксперт в области профессионального образования, сценарист,
                                лауреат отечественных, зарубежных премий. «Можно долго говорить о том, что я уникален и это факт!
                                За меня всё скажет интернет». Читай отзывы, смотри YouTube</p>
                        </div>
                        <div class="time-more-btn">
                            <p>29 января 2022</p>
                            <button>
                                Узнать больше
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  </body>
</html>