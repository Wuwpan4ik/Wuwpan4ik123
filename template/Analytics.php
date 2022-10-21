<html>

  <head>

    <meta charset="utf-8">

    <title>Моя тестовая страница</title>

    <link rel="stylesheet" href="css/sidebar.css">

    <link rel="stylesheet" href="css/nullCss.css">

    <link rel="stylesheet" href="css/analytics.css">

    <link rel="stylesheet" href="css/feed.css">

    <link rel="stylesheet" href="css/main.css">

  </head>

  <body>

        <div class="Analytics">

            <?php include 'default/sidebar.php';?>

            <div class="feed">

                <div class="feed-header">

                    <h2>Доступные проекты</h2>

                    <div class="buttonsFeeda ">


                        <button class="ico_button"><img class="ico" src="img/Shield.svg"></button>

                        <button class="ico_button"><img class="ico" src="img/Bell.svg"></button>

                        <button id="apps" class="ico_button">Заявки</button>

                    </div>

                </div>

                <div class="mytabs">

                    <input type="radio" id="About" name="mytabs" checked="checked"/>

                    <label id="oplab" for="About"><p>Клиенты</p></label>

                    <div class="tab _container">

                        <div class="Tableusers">

                            <div class="header">
                                <div class="header__title">
								    <h2>Список ваших клиентов</h2>
                                </div>
                                <div class="head_buttons">
                                    <button class="ico_button "><img class="ico" src="img/Filter.svg">Фильтры</button>

                                    <button class="ico_button "><img class="ico" src="img/Download.svg">Выгрузить</button>

                                    <input style="display:block; padding-left:35px;" class="ico_button" placeholder="Поиск">
                                </div>

							</div>

                            <table class="table" cellSpacing="0">

                                <thead class="fixedHeader">

                                <tr >

                                    <th id="thop">ФИО</th>

                                    <th> <div class="th-title"> <img class="table_ico" src="img/StickDown.svg">Сумма</div></th>

                                    <th><div class="th-title"> <img class="table_ico" src="img/StickDown.svg">Email</div></th>

                                    <th><div class="th-title"> <img class="table_ico" src="img/StickDown.svg">Телефон</div></th>

                                    <th> <div class="th-title"> <img class="table_ico" src="img/StickDown.svg">Комментарий</div></th>

                                    <th id="thcl"><div class="th-title"> <img class="table_ico" src="img/StickDown.svg">Источник клиента</div></th>

                                </tr>

                                </thead>

                                <tbody>

                                <tr>

                                    <td class="nick"> <input class="checkbox" type="checkbox">UserUser</td>
                                    
                                    <td>1300 ₽</td>

                                    <td>UserUser@mail.ru</td>

                                    <td>8982323404</td>

                                    <td>WhoWhoWho</td>

                                    <td class="iconed">Соц. сети

                                        <img class="basket_delete" src="../img/basket_delete.svg" alt="">

									</td>

                                </tr >

                               

                                </tbody>

                            </table>

                        </div>

                    </div>

                    <input type="radio" id="Integrations" name="mytabs"/>

                    

                    

                    <input type="radio" id="Tarif" name="mytabs"/>

                    <label id="cllab" for="Tarif"><p>Статистика</p></label>

                    <div class="tab">


                        <div class="geo__profit">
                            <div class="profit__leftSide">
                                <div class="profit__row">
                                    <div class="profit__item">
                                        <div class="profit_header"><h3>Доход за неделю</h3><span>Неделя</span></div>
                                        <div class="profit_sum">50 893 ₽ <span class="green_profit">14.6%</span>
                                        </div> 
                                        <div class="profit_footer">На  <span class="green_text">10,256 ₽ </span>больше</div>         
                                    </div>
                                    <div class="profit__item profit_down">
                                        <div class="profit_header"><h3>Доход за месяц</h3><span>Месяц</span></div>
                                        <div class="profit_sum">210 893 ₽ <span class="red_profit">4.16%</span>
                                        </div> 
                                        <div class="profit_footer">На  <span class="red_text">20,597 ₽ </span>меньше</div>         
                                    </div>
                                </div>
                                <div class="allprofit">
                                    <div class="profit_header"><h3>Общий доход</h3><div class="profit_header_dots"></div>
                                    </div>
                                    <div class="profit_sum">1 390 164 ₽ <span class="red_profit">14.6%</span></div>
                                    <div class="numbers">
                                        <div class="numbers_item">0-5000 <span class="color1"></span></div>
                                        <div class="numbers_item">>50 000<span class="color2"></span></div>
                                        <div class="numbers_item">>100000<span class="color3"></span></div>
                                    </div>
                                    <div class="device"></div>
                                </div>  
                            </div>
                            <div class="profit_rightSide">
                                <div class="rightSideFirst">
                                    <div class="rightSideFirst_header">
                                        <img src="/img/credit-card.svg" alt="">
                                        <div class="rightSideFirstText1">
                                            <h3>50 893 ₽</h3>
                                            <span>Общая прибыль</span>
                                        </div>
                                        <div class="rightSideFirstText2">
                                            <span>Неделя</span>
                                            <span class="green_profit">14.6%</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="rightSideSecond"></div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>
        <script src="../js/script.js" ></script>
  </body>

</html>