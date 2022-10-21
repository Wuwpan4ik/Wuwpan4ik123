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

									<tr>

										<th id="thop"><input id="main_check" type="checkbox" style="display:inline-block;">ФИО</th>

										<th><button class="order_button" value="give_money"><img class="table_ico" src="img/StickDown.svg"></button>Сумма</th>

										<th><button class="order_button" value="email"><img class="table_ico" src="img/StickDown.svg"></button>Email</th>

										<th><button class="order_button" value="tel"><img class="table_ico" src="img/StickDown.svg"></button>Телефон</th>

										<th><button class="order_button" value="quest"><img class="table_ico" src="img/StickDown.svg"></button>Задача</th>
										
										<th><button class="order_button" value="date"><img class="table_ico" src="img/StickDown.svg"></button>Дата создания</th>

										<th id="thcl"><button class="order_button" value="source"><img class="table_ico" src="img/StickDown.svg"></button>Источник клиента</th>

									</tr>

                                </thead>

                                <tbody id="conTab">

									<?php $i = 0;
									foreach($content[0] as $client){?>
										
										<tr>

											<td class="nick"> <input type="checkbox" class="check_user"><?=$content[1][$i]["first_name"] . " " . $content[1][$i]["second_name"]?></td>

											<td><?=$client["give_money"]?> ₽</td>

											<td><?=$content[1][$i]["email"]?></td>

											<td><?=$content[1][$i]["telephone"]?></td>

											<td><?=$client["comment"]?></td>
											
											<td><?=$client["achivment_date"]?></td>

											<td class="iconed">Соц. сети

												<span>

													<button class="del_but"  value="<?=$client["id"]?>"><img class="table_ico" src="img/Option.svg"></button>

													<img class="table_ico" src="img/Dots.svg">

												</span>

											</td>

										</tr>
										
									<?$i++;}?>

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

  </body>
  
  <script>
			// удаление клиента (не робит)
			const client_del = document.querySelectorAll('del_but');
				
				for (var i = 0; i < client_del.length; ++i) {
                client_del.addEventListener('click',function () {
                    window.location.href = '?option=AnalController&method=delClient&id = '+ this.value;
                });
            };
  </script>
  
	<script>
        // выделение чекбоксов (чет тоже не работает)
        const check_user = document.querySelectorAll('.check_user');
        const main_check = document.querySelector('#main_check');
        main_check.addEventListener('click', function (e) {
                Array.prototype.forEach.call(check_user, function(cb){
                    cb.checked = e.target.checked;
                });
            });
	</script>
  
	  <script>
				const order_button = document.querySelector('.order_button');
				const tab = document.querySelector('#conTab');
				
					order_button.addEventListener('click', function(e) {
						if(this.innerHTML == '<img class="table_ico" src="img/StickDown.svg">'){
							this.innerHTML = '<img class="table_ico" src="img/StickUp.svg">';
							var param = this.value;
						}else{
							this.innerHTML = '<img class="table_ico" src="img/StickDown.svg">';
							param = this.value + " DESC";
						}
						const request = new XMLHttpRequest();

						const url = "?option=SortController&method=get_sum&sort=" +param;

						request.open('GET', url);

						request.setRequestHeader('Content-Type', 'application/x-www-form-url');
						request.addEventListener("readystatechange", () => {
							if (request.readyState === 4 && request.status === 200) {
								tab.innerHTML = request.responseText;
							}
						});
						request.send();
					});
        </script>

</html>
