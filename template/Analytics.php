<html>

  <head>

    <meta charset="utf-8">

    <title>Моя тестовая страница</title>


    <link rel="stylesheet" href="/css/nullCss.css">

    <link rel="stylesheet" href="/css/analytics.css">

    <link rel="stylesheet" href="/css/main.css">

  </head>

  <body>

        <div class="Analytics">

            <?php include 'default/sidebar.php';?>

            <div class="feed">

                <?php
                $title = "Аналитика";
                include ('default/header.php');
                ?>

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

										<th><div class="th-title"><button class="order_button" value="give_money"><img class="table_ico" src="img/StickDown.svg"></button>Сумма</div></th>

										<th><div class="th-title"><button class="order_button" value="email"><img class="table_ico" src="img/StickDown.svg"></button>Email</div></th>

										<th><div class="th-title"><button class="order_button" value="tel"><img class="table_ico" src="img/StickDown.svg"></button>Телефон</div></th>

                                        <th><div class="th-title"><button class="order_button" value="course_id"><img class="table_ico" src="img/StickDown.svg"></button>Курс</div></th>

										<th><div class="th-title"><button class="order_button" value="comment"><img class="table_ico" src="img/StickDown.svg"></button>Задача</div></th>
										
										<th><div class="th-title"><button class="order_button" value="achivment_date"><img class="table_ico" src="img/StickDown.svg"></button>Дата</div></th>

									</tr>

                                </thead>

                                <tbody id="conTab">

                                </tbody>

                            </table>

                        </div>

                    </div>

                    <input type="radio" id="Integrations" name="mytabs"/>

                    <input type="radio" id="Tarif" name="mytabs"/>

                    <label id="cllab" for="Tarif"><p>Статистика</p></label>

                    <div class="tab">

                        <div class="_container">
                        <div class="geo__profit">
                            <div class="profit__leftSide">
                                <div class="profit__row">
                                    <div class="profit__item">
                                        <div class="profit_header"><h3>Доход за неделю</h3><span>Неделя</span></div>
                                        <div class="profit_sum"><span id="this_week"></span> <span class="green_profit week_procent">14.6%</span>
                                        </div> 
                                        <div class="profit_footer">На  <span id="week_diff"></span> <span id="week_diff-text"></span></div>
                                    </div>
                                    <div class="profit__item profit_down">
                                        <div class="profit_header"><h3>Доход за месяц</h3><span>Месяц</span></div>
                                        <div class="profit_sum"><span id="this_month"></span> <span class="red_profit">4.16%</span>
                                        </div> 
                                        <div class="profit_footer">На  <span id="month_diff"></span> <span id="month_diff-text"></span></div>
                                    </div>
                                </div>
                                <div class="allprofit">
                                    <div class="profit_header"><h3>Общий доход</h3><div class="profit_header_dots"></div>
                                    </div>
                                    <div class="profit_sum"><span id="full_value"></span></div>
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
                                            <h3 id="full_week_value"></h3>
                                            <span>Общая прибыль</span>
                                        </div>
                                        <div class="rightSideFirstText2">
                                            <span>Неделя</span>
                                            <span class="green_profit week_procent">14.6%</span>
                                        </div>
                                    </div>
                                    <div class="Analytics-graphic__totalProfit">
                                        <canvas width="264px" height="128px"  id="totalProfit"></canvas>
                                    </div>

                                    <div class="profit_footer">На  <span class="green_text">10,256 ₽ </span>больше</div>
                                </div>
                                <div class="rightSideFirst">

                                    <div class="Analytics-graphic__profitabilityIndicators">
                                        <canvas width="264px" height="70px" class="graphic__profitabilityIndicators" id="profitabilityIndicators"></canvas>
                                    </div>
                                    <div class="rightSideFirst_header">
                                        <div class="rightSideFirstText1">
                                            <h3 class=" profit-price " >$16,355.49</h3>
                                            <span>показатели доходности</span>
                                        </div>
                                        <div class="rightSideFirstText2">
                                            <span class="green_profit week_procent">14.6%</span>
                                        </div>
                                    </div>
                                    <div class="profit_footer">На  <span class="green_text">10,256 ₽ </span>больше</div>
                                </div>

                            </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
        <script src="https://code.jquery.com/jquery-3.6.1.min.js" ></script>
        <script src="../js/script.js" ></script>
  </body>
<script>

  let request1 = new XMLHttpRequest();

  let url1 = "/StatisticsController/GetStatistics";

  request1.open('GET', url1);

  request1.setRequestHeader('Content-Type', 'application/x-www-form-url');
  request1.addEventListener("readystatechange", () => {
      if (request1.readyState === 4 && request1.status === 200) {
          const array = JSON.parse(request1.responseText);
          if (array.prev_week == null) {
              console.log('ud');
          }
          if (array.week) {
              document.getElementById('this_week').innerHTML = array.week + "₽";
          }
          if (array.month) {
              document.getElementById('this_month').innerHTML = array.month + "₽";
          }
          if (array.prev_week) {
              document.getElementById('last_week').innerHTML = array.prev_week + "₽";
          }
          if (array.prev_month) {
              document.getElementById('last_month').innerHTML = array.prev_month + "₽";
          }
          if (array.full_value) {
              document.getElementById('full_week_value').innerText = array.week + "₽";
          }
          if (array.full_value) {
              document.getElementById('full_value').innerText = array.full_value + "₽";
          }
          let week_diff = array.week - array.prev_week;
          let month_diff = array.month - array.prev_month;

          if (week_diff > 0) {
              document.getElementById('week_diff-text').innerText = 'больше';
              document.getElementById('week_diff').classList.add('green_text');
          } else {
              document.getElementById('week_diff-text').innerText = 'меньше';
              document.getElementById('week_diff').classList.add('red_text');
          }
          if (month_diff > 0) {
              document.getElementById('month_diff-text').innerText = 'больше';
              document.getElementById('month_diff').classList.add('green_text');
          } else {
              document.getElementById('month_diff-text').innerText = 'меньше';
              document.getElementById('month_diff').classList.add('red_text');
          }
          document.getElementById('week_diff').innerText = week_diff + "₽";
          document.getElementById('month_diff').innerText = month_diff + "₽";

          document.querySelectorAll(".week_procent").forEach((elem) => {
              if (array.prev_week !== 0) {
                  elem.innerHTML = array.week / array.prev_week * 100 + "%";
              } else {
                  elem.style.display = 'none';
              }
          });
      }
  });
  request1.send();
</script>

<script>
    let check_user = document.querySelectorAll('.check_user');
    const main_check = document.querySelector('#main_check');
    main_check.addEventListener('click', function (e) {
        let check_user = document.querySelectorAll('.check_user');
            Array.prototype.forEach.call(check_user, function(cb){
                cb.checked = e.target.checked;
            });
        });
</script>

  <script>
            const order_button = document.querySelectorAll('.order_button');
            const tab = document.querySelector('#conTab');
            let request = new XMLHttpRequest();

            let url = "SortController/AnalyticClients?sort=id";

            request.open('GET', url);

            request.setRequestHeader('Content-Type', 'application/x-www-form-url');
            request.addEventListener("readystatechange", () => {
                if (request.readyState === 4 && request.status === 200) {
                    tab.innerHTML = request.responseText;
                }
            });
            request.send();

            order_button.forEach((elem) => {
                elem.addEventListener('click', function(e) {
                    if(this.innerHTML == '<img class="table_ico" src="img/StickDown.svg">'){
                        this.innerHTML = '<img class="table_ico" src="img/StickUp.svg">';
                        var param = this.value;
                    }else{
                        this.innerHTML = '<img class="table_ico" src="img/StickDown.svg">';
                        param = this.value + " DESC";
                    }
                    let request = new XMLHttpRequest();

                    let url = "SortController/AnalyticClients?sort=" + param;

                    request.open('GET', url);

                    request.setRequestHeader('Content-Type', 'application/x-www-form-url');
                    request.addEventListener("readystatechange", () => {
                        if (request.readyState === 4 && request.status === 200) {
                            tab.innerHTML = request.responseText;
                        }
                    });
                    request.send();
                });
            });
    </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<script src="../js/charts.js"></script>
</html>
