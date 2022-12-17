<html lang="ru">

  <head>

    <meta charset="utf-8">
    <title>Course Creator - Статистика</title>
    <link rel="stylesheet" href="/css/nullCss.css">
    <link rel="stylesheet" href="/css/analytics.css">
    <link rel="stylesheet" href="/css/main.css">

    <!--Favicon-->
    <link rel="icon" type="image/x-icon" href="/uploads/course-creator/favicon.ico">
  </head>

  <body>
  <?php print_r($_SESSION['error'])?>

        <div class="Analytics app">

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
                                    <div class="filters_btn">
                                        <button class="ico_button filterBtn" id="filterBtn"><svg style="margin:12px" width="20" height="16" viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M1 0H8C8.55 0 9 0.45 9 1C9 1.55 8.55 2 8 2H1C0.45 2 0 1.55 0 1C0 0.45 0.45 0 1 0ZM4 7H8C8.55 7 9 7.45 9 8C9 8.55 8.55 9 8 9H4C3.45 9 3 8.55 3 8C3 7.45 3.45 7 4 7ZM8 14H6C5.45 14 5 14.45 5 15C5 15.55 5.45 16 6 16H8C8.55 16 9 15.55 9 15C9 14.45 8.55 14 8 14ZM17.0002 12.6438L18.3052 11.3838C18.7032 11.0008 19.3362 11.0118 19.7192 11.4088C20.1032 11.8068 20.0922 12.4398 19.6952 12.8228L16.6952 15.7198C16.5002 15.9058 16.2502 15.9998 16.0002 15.9998C15.7442 15.9998 15.4882 15.9028 15.2932 15.7068L12.2932 12.7068C11.9022 12.3168 11.9022 11.6838 12.2932 11.2928C12.6832 10.9028 13.3162 10.9028 13.7072 11.2928L15.0002 12.5858V3.3568L13.6952 4.6158C13.2982 4.9998 12.6652 4.9878 12.2812 4.5908C11.8972 4.1938 11.9082 3.5608 12.3052 3.1768L15.3052 0.2798C15.6992 -0.0962 16.3222 -0.0942 16.7072 0.2928L19.7072 3.2928C20.0972 3.6838 20.0972 4.3168 19.7072 4.7068C19.5122 4.9028 19.2562 4.9998 19.0002 4.9998C18.7442 4.9998 18.4882 4.9028 18.2932 4.7068L17.0002 3.4138V12.6438Z" fill="#757D8A"/>
                                            </svg>
                                            Фильтры</button>
                                        <div class="filters_sort">
                                            <button class="filter_button" style="margin-bottom: 10px;">
                                                Сначала новые
                                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M13.2954 6.60549L8.72743 12.6055C8.53943 12.8525 8.24843 12.9985 7.93843 13.0005H7.93143C7.62443 13.0005 7.33443 12.8585 7.14443 12.6165L4.71243 9.50949C4.37243 9.07549 4.44843 8.44649 4.88343 8.10649C5.31843 7.76549 5.94643 7.84149 6.28743 8.27749L7.92043 10.3635L11.7044 5.39449C12.0384 4.95549 12.6664 4.86949 13.1064 5.20449C13.5454 5.53949 13.6304 6.16649 13.2954 6.60549ZM15.0004 0.000488281H3.00043C1.34543 0.000488281 0.000427246 1.34549 0.000427246 3.00049V15.0005C0.000427246 16.6545 1.34543 18.0005 3.00043 18.0005H15.0004C16.6544 18.0005 18.0004 16.6545 18.0004 15.0005V3.00049C18.0004 1.34549 16.6544 0.000488281 15.0004 0.000488281Z" fill="#E1E3E6"/>
                                                </svg>
                                            </button>
                                            <button class="filter_button">
                                                Сначала старые
                                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M13.2954 6.60549L8.72743 12.6055C8.53943 12.8525 8.24843 12.9985 7.93843 13.0005H7.93143C7.62443 13.0005 7.33443 12.8585 7.14443 12.6165L4.71243 9.50949C4.37243 9.07549 4.44843 8.44649 4.88343 8.10649C5.31843 7.76549 5.94643 7.84149 6.28743 8.27749L7.92043 10.3635L11.7044 5.39449C12.0384 4.95549 12.6664 4.86949 13.1064 5.20449C13.5454 5.53949 13.6304 6.16649 13.2954 6.60549ZM15.0004 0.000488281H3.00043C1.34543 0.000488281 0.000427246 1.34549 0.000427246 3.00049V15.0005C0.000427246 16.6545 1.34543 18.0005 3.00043 18.0005H15.0004C16.6544 18.0005 18.0004 16.6545 18.0004 15.0005V3.00049C18.0004 1.34549 16.6544 0.000488281 15.0004 0.000488281Z" fill="#E1E3E6"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <button class="ico_button disabledBtn"><svg style="margin:12px" width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.00284 9.0759C7.00096 9.05084 7 9.02553 7 9V1C7 0.448 7.447 0 8 0C8.553 0 9 0.448 9 1V8.99982L11.4 7.2C11.842 6.867 12.469 6.958 12.8 7.4C13.132 7.842 13.042 8.469 12.6 8.8L8.6 11.8C8.423 11.933 8.211 12 8 12C7.799 12 7.598 11.939 7.425 11.818L3.425 9.004C2.973 8.686 2.864 8.062 3.182 7.611C3.5 7.159 4.123 7.05 4.575 7.368L7.00284 9.0759ZM2 14V15H14V14C14 13.45 14.45 13 15 13C15.55 13 16 13.45 16 14V16C16 16.55 15.55 17 15 17H1C0.45 17 0 16.55 0 16V14C0 13.45 0.45 13 1 13C1.55 13 2 13.45 2 14Z" fill="#757D8A"/>
                                        </svg>
                                        Выгрузить</button>

                                    <input style="display:block; padding-left:35px;" class="ico_button" placeholder="Поиск">
                                </div>

							</div>

                            <table class="table" cellSpacing="0">

                                <thead class="fixedHeader">

									<tr>

										<th id="thop"><input id="main_check" type="checkbox" style="display:inline-block;">ФИО</th>

										<th><div class="th-title"><button class="order_button contact__button" value="give_money"><img class="table_ico" src="img/StickDown.svg"></button>Сумма</div></th>

										<th><div class="th-title"><button class="order_button contact__button" value="email"><img class="table_ico" src="img/StickDown.svg"></button>Email</div></th>

										<th><div class="th-title"><button class="order_button contact__button" value="tel"><img class="table_ico" src="img/StickDown.svg"></button>Телефон</div></th>

                                        <th><div class="th-title"><button class="order_button contact__button" value="course_id"><img class="table_ico" src="img/StickDown.svg"></button>Курс</div></th>

                                        <th><div class="th-title"><button class="order_button contact__button" value="achivment_date"><img class="table_ico" src="img/StickDown.svg"></button>Дата</div></th>

                                        <th><div class="th-title">Функции</div></th>

                                        <th><div class="th-title"> </div></th>
									</tr>

                                </thead>

                                <tbody id="conTab">

                                </tbody>

                            </table>

                            <div class="no-data">
                                <p>Данных пока нет</p>
                            </div>
                        </div>

                    </div>

                    <input type="radio" id="Orders" name="mytabs"/>

                    <label id="ordlab" for="Orders"><p>Заказы</p></label>
                    <div class="tab _container">

                        <div class="Tableusers" style="overflow: hidden">

                            <div class="header">
                                <div class="header__title">
                                    <h2>Список ваших клиентов</h2>
                                </div>
                                <div class="head_buttons">
                                    <div class="filters_btn">
                                        <button class="ico_button filterBtn" id="filterBtn"><svg style="margin:12px" width="20" height="16" viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M1 0H8C8.55 0 9 0.45 9 1C9 1.55 8.55 2 8 2H1C0.45 2 0 1.55 0 1C0 0.45 0.45 0 1 0ZM4 7H8C8.55 7 9 7.45 9 8C9 8.55 8.55 9 8 9H4C3.45 9 3 8.55 3 8C3 7.45 3.45 7 4 7ZM8 14H6C5.45 14 5 14.45 5 15C5 15.55 5.45 16 6 16H8C8.55 16 9 15.55 9 15C9 14.45 8.55 14 8 14ZM17.0002 12.6438L18.3052 11.3838C18.7032 11.0008 19.3362 11.0118 19.7192 11.4088C20.1032 11.8068 20.0922 12.4398 19.6952 12.8228L16.6952 15.7198C16.5002 15.9058 16.2502 15.9998 16.0002 15.9998C15.7442 15.9998 15.4882 15.9028 15.2932 15.7068L12.2932 12.7068C11.9022 12.3168 11.9022 11.6838 12.2932 11.2928C12.6832 10.9028 13.3162 10.9028 13.7072 11.2928L15.0002 12.5858V3.3568L13.6952 4.6158C13.2982 4.9998 12.6652 4.9878 12.2812 4.5908C11.8972 4.1938 11.9082 3.5608 12.3052 3.1768L15.3052 0.2798C15.6992 -0.0962 16.3222 -0.0942 16.7072 0.2928L19.7072 3.2928C20.0972 3.6838 20.0972 4.3168 19.7072 4.7068C19.5122 4.9028 19.2562 4.9998 19.0002 4.9998C18.7442 4.9998 18.4882 4.9028 18.2932 4.7068L17.0002 3.4138V12.6438Z" fill="#757D8A"/>
                                            </svg>
                                            Фильтры</button>
                                        <div class="filters_sort">
                                            <button class="filter_button" style="margin-bottom: 10px;">
                                                Сначала новые
                                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M13.2954 6.60549L8.72743 12.6055C8.53943 12.8525 8.24843 12.9985 7.93843 13.0005H7.93143C7.62443 13.0005 7.33443 12.8585 7.14443 12.6165L4.71243 9.50949C4.37243 9.07549 4.44843 8.44649 4.88343 8.10649C5.31843 7.76549 5.94643 7.84149 6.28743 8.27749L7.92043 10.3635L11.7044 5.39449C12.0384 4.95549 12.6664 4.86949 13.1064 5.20449C13.5454 5.53949 13.6304 6.16649 13.2954 6.60549ZM15.0004 0.000488281H3.00043C1.34543 0.000488281 0.000427246 1.34549 0.000427246 3.00049V15.0005C0.000427246 16.6545 1.34543 18.0005 3.00043 18.0005H15.0004C16.6544 18.0005 18.0004 16.6545 18.0004 15.0005V3.00049C18.0004 1.34549 16.6544 0.000488281 15.0004 0.000488281Z" fill="#E1E3E6"/>
                                                </svg>
                                            </button>
                                            <button class="filter_button">
                                                Сначала старые
                                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M13.2954 6.60549L8.72743 12.6055C8.53943 12.8525 8.24843 12.9985 7.93843 13.0005H7.93143C7.62443 13.0005 7.33443 12.8585 7.14443 12.6165L4.71243 9.50949C4.37243 9.07549 4.44843 8.44649 4.88343 8.10649C5.31843 7.76549 5.94643 7.84149 6.28743 8.27749L7.92043 10.3635L11.7044 5.39449C12.0384 4.95549 12.6664 4.86949 13.1064 5.20449C13.5454 5.53949 13.6304 6.16649 13.2954 6.60549ZM15.0004 0.000488281H3.00043C1.34543 0.000488281 0.000427246 1.34549 0.000427246 3.00049V15.0005C0.000427246 16.6545 1.34543 18.0005 3.00043 18.0005H15.0004C16.6544 18.0005 18.0004 16.6545 18.0004 15.0005V3.00049C18.0004 1.34549 16.6544 0.000488281 15.0004 0.000488281Z" fill="#E1E3E6"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>

                                    <button class="ico_button "><img class="ico" src="img/Download.svg">Выгрузить</button>

                                    <input style="display:block; padding-left:35px;" class="ico_button" placeholder="Поиск">
                                </div>

                            </div>

                            <table class="table" cellSpacing="0">

                                <thead class="fixedHeader">

                                <tr>

                                    <th id="thop"><input id="order_check" type="checkbox" style="display:inline-block;">Заказ</th>

                                    <th><div class="th-title"><button class="order_button order__button" value="money"><img class="table_ico" src="img/StickDown.svg"></button>Сумма</div></th>

                                    <th><div class="th-title"><button class="order_button order__button" value="email"><img class="table_ico" src="img/StickDown.svg"></button>Email</div></th>

                                    <th><div class="th-title"><button class="order_button order__button" value="tel"><img class="table_ico" src="img/StickDown.svg"></button>Телефон</div></th>

                                    <th><div class="th-title"><button class="order_button order__button" value="course_id"><img class="table_ico" src="img/StickDown.svg"></button>Курс</div></th>

                                    <th><div class="th-title"><button class="order_button order__button" value="achivment_date"><img class="table_ico" src="img/StickDown.svg"></button>Дата</div></th>

                                    <th><div class="th-title">Функции</div></th>


                                </tr>

                                </thead>

                                <tbody id="orderTab">

                                </tbody>

                            </table>
                            <div class="no-data">
                                <p>Данных пока нет</p>
                            </div>
                        </div>

                    </div>

                    <input type="radio" id="Tarif" name="mytabs"/>

                    <label id="cllab" for="Tarif"><p>Статистика</p></label>

                    <div class="tab">

                        <div class="_container">
                        <div class="geo__profit">
                            <div class="profit__leftSide">
                                <div class="profit__row">
                                    <div class="profit__item">
                                        <div class="profit_header"><h3>Доход за неделю</h3><span>Неделя</span></div>
                                        <div class="profit_sum"><span class="full_week_value profit_sum"></span> <span class="week_procent">14.6%</span>
                                        </div>
                                        <div class="profit_footer">На  <span class="week_diff"></span> <span class="week_diff-text"></span></div>
                                    </div>
                                    <div class="profit__item profit_down">
                                        <div class="profit_header"><h3>Доход за месяц</h3><span>Месяц</span></div>
                                        <div class="profit_sum"><span id="this_month"></span> <span class="month_procent"></span>
                                        </div>
                                        <div class="profit_footer">На  <span class="month_diff"></span> <span class="month_diff-text"></span></div>
                                    </div>
                                </div>
                                <div class="profit__row">
                                    <div class="profit__item">
                                        <div class="profit_header"><h3>Доход на одного пользователя</h3></div>
                                        <div class="profit_sum"><span id="one__user"></span>
                                        </div>
                                    </div>
                                    <div class="profit__item profit_down">
                                        <div class="profit_header"><h3>Новые пользователи/мес</h3></div>
                                        <div class="profit_sum"><span id="first__buy-count"></span>
                                        </div>
                                        </div>
                                </div>
                                <div class="allprofit">
                                    <div class="profit_header"><h3>Общий доход</h3><div class="profit_header_dots"></div>
                                    </div>
                                    <div class="profit_sum"><span id="full_value"></span></div>
                                    <div class="numbers">
                                        <div class="numbers_item">0-30000<span class="color1"></span></div>
                                        <div class="numbers_item">>30000<span class="color2"></span></div>
                                        <div class="numbers_item">>50000<span class="color3"></span></div>
                                    </div>
                                    <div class="allprofit__devices">
                                        <div class="allprofit__devices__name__item">
                                            <div class="allprofit__devices__names">
                                                <div class="allprofit__devices__name">Устройства</div>
                                            </div>
                                        </div>
                                        <div class="allprofit__devices__item">
                                            <div class="allprofit__devices__table">
                                                <div class="allprofit__devices__item">
                                                    <div class="allprofit__devices__slot"></div>
                                                    <div class="allprofit__devices__name">ПН</div>
                                                </div>
                                                <div class="allprofit__devices__item">
                                                    <div class="allprofit__devices__slot"></div>
                                                    <div class="allprofit__devices__name">ВТ</div>
                                                </div>
                                                <div class="allprofit__devices__item">
                                                    <div class="allprofit__devices__slot"></div>
                                                    <div class="allprofit__devices__name">СР</div>
                                                </div>
                                                <div class="allprofit__devices__item">
                                                    <div class="allprofit__devices__slot"></div>
                                                    <div class="allprofit__devices__name">ЧТ</div>
                                                </div>
                                                <div class="allprofit__devices__item">
                                                    <div class="allprofit__devices__slot"></div>
                                                    <div class="allprofit__devices__name">ПТ</div>
                                                </div>
                                                <div class="allprofit__devices__item">
                                                    <div class="allprofit__devices__slot"></div>
                                                    <div class="allprofit__devices__name">СБ</div>
                                                </div>
                                                <div class="allprofit__devices__item">
                                                    <div class="allprofit__devices__slot"></div>
                                                    <div class="allprofit__devices__name">ВС</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="profit_rightSide">
                                <div class="rightSideFirst">
                                    <div class="rightSideFirst_header">
                                        <img src="/img/credit-card.svg" alt="">
                                        <div class="rightSideFirstText1">
                                            <h3 class="full_week_value profit_sum"></h3>
                                            <span>Общая прибыль</span>
                                        </div>
                                        <div class="rightSideFirstText2">
                                            <span>Неделя</span>
                                            <span class="week_procent"></span>
                                        </div>
                                    </div>
                                    <div class="Analytics-graphic__totalProfit">
                                        <canvas width="264px" height="128px"  id="totalProfit"></canvas>
                                    </div>
                                    <div class="profit_footer">На  <span class="week_diff"></span> <span class="week_diff-text"></span></div>
                                </div>
                                <div class="rightSideFirst">

                                    <div class="Analytics-graphic__profitabilityIndicators">
                                        <canvas width="264px" height="70px" class="graphic__profitabilityIndicators" id="profitabilityIndicators"></canvas>
                                    </div>
                                    <div class="rightSideFirst_header">
                                        <div class="rightSideFirstText1">
                                            <h3 class="full_week_value profit_sum"></h3>
                                            <span>показатели доходности</span>
                                        </div>
                                        <div class="rightSideFirstText2">
                                            <span class="week_procent"></span>
                                        </div>
                                    </div>
                                    <div class="profit_footer">На  <span class="week_diff"></span> <span class="week_diff-text"></span></div>
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
        <div class="display-none" id="currency"><?php echo isset($_SESSION["user"]['currency']) ? $_SESSION["user"]['currency'] : '₽'?></div>
  </body>

<!--Проверка Clients-->
<script>
  const main_check = document.querySelector('#main_check');
  main_check.addEventListener('click', function (e) {
      let check_user = document.querySelectorAll('.check_user');
      Array.prototype.forEach.call(check_user, function(cb){
          cb.checked = e.target.checked;
      });
  });
</script>

<!--Проверка Orders-->
<script>
      const order_check = document.querySelector('#order_check');
      order_check.addEventListener('click', function (e) {
          let check_user = document.querySelectorAll('.check_order');
          Array.prototype.forEach.call(check_user, function(cb){
              cb.checked = e.target.checked;
          });
      });
  </script>
<!--OrderList-->
<script>
    let order_button = document.querySelectorAll('.order__button');
    let tab = document.querySelector('#orderTab');
    let request = new XMLHttpRequest();

    let url = "SortController/AnalyticOrders?sort=id";

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

            let url = "SortController/AnalyticOrders?sort=" + param;

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

<script>

  let request1 = new XMLHttpRequest();

  let url1 = "/StatisticsController/GetStatistics";

  request1.open('GET', url1);

  request1.setRequestHeader('Content-Type', 'application/x-www-form-url');
  request1.addEventListener("readystatechange", () => {
      if (request1.readyState === 4 && request1.status === 200) {
          const array = JSON.parse(request1.responseText);

          if (array.prev_week == null) {
              array.prev_week = 0;
          }

          if (array.prev_month == null) {
              array.prev_month = 0;
          }
          let currency = document.getElementById('currency').innerHTML;
          if (array.full_value) {
              document.getElementById('full_value').innerText = array.full_value + currency;
          }
          if (array.week) {
              document.querySelectorAll('.full_week_value').forEach(item => {
                  console.log()
                  item.innerHTML = array.week + currency;
              })
          }
          if (array.month) {
              document.getElementById('this_month').innerHTML = array.month + currency;
          }
          if (array.one_user) {
              document.getElementById('one__user').innerText = array.one_user + currency;
          }
          if (array.count_first_buy) {
              document.getElementById('first__buy-count').innerText = array.count_first_buy;
          }

          let week_diff = array.week - array.prev_week;
          let month_diff = array.month - array.prev_month;

          if (document.querySelectorAll('.profit_footer')) {
              if (week_diff > 0) {
                  document.querySelectorAll('.week_diff').forEach(item => {
                      item.classList.add('green_text');
                      item.innerHTML = week_diff + currency;
                  })
                  document.querySelectorAll('.week_diff-text').forEach(item => {
                      item.innerText = 'больше';
                  })
              } else {
                  document.querySelectorAll('.week_diff').forEach(item => {
                      item.classList.add('red_text');
                      item.innerHTML = week_diff + currency;
                  })
                  document.querySelectorAll('.week_diff-text').forEach(item => {
                      item.innerText = 'меньше';
                  })
              }

              if (month_diff > 0) {
                  document.querySelectorAll('.month_diff').forEach(item => {
                      item.classList.add('green_text');
                      item.innerHTML = month_diff + currency;
                  })
                  document.querySelectorAll('.month_diff-text').forEach(item => {
                      item.innerText = 'больше';
                  })
              } else {
                  document.querySelectorAll('.month_diff').forEach(item => {
                      item.classList.add('red_text');
                      item.innerHTML = month_diff + currency;
                  })
                  document.querySelectorAll('.month_diff-text').forEach(item => {
                      item.innerText = 'меньше';
                  })
              }
          }

          let week_procent = array.week / array.prev_week;
          let month_procent = array.month / array.prev_month;

          document.querySelectorAll(".week_procent").forEach((elem) => {
              if (array.prev_week !== 0) {
                  elem.innerHTML = week_procent * 100 + "%";
              } else {
                  elem.style.display = 'none';
              }
              if (week_diff > 0) {
                  elem.classList.add('green_profit')
              } else {
                  elem.classList.add('red_profit');
              }
          });

          document.querySelectorAll(".month_procent").forEach((elem) => {
              if (array.prev_month !== 0) {
                  elem.innerHTML = month_procent * 100 + "%";
              } else {
                  elem.style.display = 'none';
              }
              if (month_diff > 0) {
                  elem.classList.add('green_profit')
              } else {
                  elem.classList.add('red_profit');
              }
          })
      }
      })
  request1.send();
</script>
  <script>
      let filtersBtns = document.querySelectorAll('button.filter_button');
      let filters = document.querySelectorAll('.filters_sort');
      let filterBtn = document.querySelectorAll('.ico_button.filterBtn');

      for(let i = 0; i < filters.length; i++){
          filterBtn[i].onclick = () =>{
              if(filters[i].classList.contains('opened')){
                  filters[i].classList.remove('opened')
                  filterBtn[i].classList.remove('active')
              }else{
                  filters[i].classList.add('opened')
                  filterBtn[i].classList.add('active')
              }
          }
      }

      //Для фильтра по "Сначала новые" для клиентов
      filtersBtns[0].onclick = () =>{
          filtersBtns[0].classList.add('active');
          filtersBtns[1].classList.remove('active');
          filtersBtns[2].classList.remove('active');
          filtersBtns[3].classList.remove('active');
      }
      //Для фильтра по "Сначала старые" для клиентов
      filtersBtns[1].onclick = () =>{
          filtersBtns[1].classList.add('active');
          filtersBtns[0].classList.remove('active');
          filtersBtns[2].classList.remove('active');
          filtersBtns[3].classList.remove('active');
      }
      //Для фильтра по "Сначала новые" для заказов
      filtersBtns[2].onclick = () =>{
          filtersBtns[2].classList.add('active');
          filtersBtns[1].classList.remove('active');
          filtersBtns[0].classList.remove('active');
          filtersBtns[3].classList.remove('active');
      }
      //Для фильтра по "Сначала старые" для закаов
      filtersBtns[3].onclick = () =>{
          filtersBtns[3].classList.add('active');
          filtersBtns[1].classList.remove('active');
          filtersBtns[2].classList.remove('active');
          filtersBtns[0].classList.remove('active');
      }
  </script>

<script>
    let client_buttons = document.querySelectorAll('.contact__button');
    let client_tab = document.querySelector('#conTab');
    let client_request = new XMLHttpRequest();

    let client_url = "SortController/AnalyticClients?sort=id";

    client_request.open('GET', client_url);

    client_request.setRequestHeader('Content-Type', 'application/x-www-form-url');
    client_request.addEventListener("readystatechange", () => {
        if (client_request.readyState === 4 && client_request.status === 200) {
            client_tab.innerHTML = client_request.responseText;
        }
    });
    client_request.send();

    client_buttons.forEach((elem) => {
        elem.addEventListener('click', function(e) {
            let param;
            if(this.innerHTML == '<img class="table_ico" src="img/StickDown.svg">'){
                this.innerHTML = '<img class="table_ico" src="img/StickUp.svg">';
                param = this.value;
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
                    client_tab.innerHTML = request.responseText;
                }
            });
            request.send();
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let request2 = new XMLHttpRequest();
        let url2 = "/StatisticsController/GetWeekDays";
        request2.open('GET', url2);

        request2.setRequestHeader('Content-Type', 'application/x-www-form-url');
        request2.addEventListener("readystatechange", () => {
            if (request2.readyState === 4 && request2.status === 200) {
                let arrays = JSON.parse(request2.responseText);
                let array_money = [0, 0, 0, 0, 0, 0, 0];
                let week = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']
                arrays.forEach(item => {
                    array_money[week.indexOf((item.day).trim())] = parseInt(item.money);
                })
                let count = 0;
                document.querySelectorAll('.allprofit__devices__slot').forEach(item => {
                    if (array_money[count] >= 30000) {
                        item.style = "background: rgba(78, 115, 248, 0.5)";
                    }
                    if (array_money[count] >= 50000) {
                        item.style = "background: #4E73F8";
                    }
                    count++;
                })
            }
        });
        request2.send();
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<script src="../js/charts.js"></script>
  <script src="/js/getNotifications.js"></script>
</html>
