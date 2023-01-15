<!DOCTYPE html>

<html lang="ru">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Creator - Основные показатели</title>

    <link rel="stylesheet" href="/css/nullCss.css">

    <link rel="stylesheet" href="/css/main.css">
    <!--Favicon-->
    <link rel="icon" type="image/x-icon" href="/uploads/course-creator/favicon.ico">
</head>

<body>

<div class="app">

    <?php include 'default/sidebar.php';?>

    <div class="feed">

        <?php
        $title = "Ключевые показатели";
        include ('default/header.php');
        ?>

        <div class="_container">

        <div class="index ">

            <div class="header">

                <div>

                    <h2>Самые важные показатели</h2>

                    <p style="margin-top: 8px;">последние 72 часа</p>

                </div>

                <button class="ico_button" id="date">

                    <svg style="margin-left: 31px;" width="7" height="14" viewBox="0 0 7 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M5.82866 14C5.53666 14 5.24666 13.873 5.04866 13.627L0.22066 7.62698C-0.07734 7.25598 -0.07334 6.72598 0.23166 6.35998L5.23166 0.359984C5.58466 -0.0640163 6.21566 -0.121016 6.64066 0.231984C7.06466 0.584984 7.12166 1.21598 6.76766 1.63998L2.29266 7.01098L6.60766 12.373C6.95366 12.803 6.88566 13.433 6.45466 13.779C6.27066 13.928 6.04866 14 5.82866 14" fill="#757D8A"/>
                    </svg>

                    <a style="padding:0px 17px;">Январь, 2022</a>

                    <svg style="margin-right: 31px" width="7" height="14" viewBox="0 0 7 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.999495 14.0001C0.773495 14.0001 0.546495 13.9241 0.359495 13.7681C-0.0645046 13.4151 -0.121505 12.7841 0.231495 12.3601L4.7075 6.98907L0.392495 1.62707C0.0464955 1.19707 0.114495 0.567073 0.544495 0.221073C0.975495 -0.124927 1.6045 -0.056927 1.9515 0.373073L6.7795 6.37307C7.0775 6.74407 7.0735 7.27407 6.7685 7.64007L1.7685 13.6401C1.5705 13.8771 1.2865 14.0001 0.999495 14.0001" fill="#757D8A"/>
                    </svg>


                </button>

            </div>

            <div class="boxes">

                <div class="box active">

                    <p>Эта неделя<img class="index_ico" src="img/ArrowUp.svg"></p>

                    <h3 id="this_week">0 <?php echo isset($_SESSION["user"]['currency']) ? $_SESSION["user"]['currency'] : '₽'?></h3>

                </div>

                <div class="box active">

                    <p>Прошлая неделя<img class="index_ico" src="img/ArrowUp.svg"></p>

                    <h3 id="prev_week">0 <?php echo isset($_SESSION["user"]['currency']) ? $_SESSION["user"]['currency'] : '₽'?></h3>

                </div>

                <div class="box active">

                    <p>В месяц<img class="index_ico" src="img/ArrowUp.svg"></p>

                    <h3 id="this_month">0 <?php echo isset($_SESSION["user"]['currency']) ? $_SESSION["user"]['currency'] : '₽'?></h3>

                </div>


                <div class="box  active">

                    <p>Прошлый месяц<img class="index_ico" src="img/ArrowDown.svg"></p>

                    <h3 id="prev_month">0 <?php echo isset($_SESSION["user"]['currency']) ? $_SESSION["user"]['currency'] : '₽'?></h3>

                </div>

            </div>

        </div>
        <div class="Tableusers">

            <table cellSpacing="0">

                <thead class="fixedHeader">

					<tr>

						<th class="full_th" style="background: #F8F8F8;border-radius: 8px 0px 0px 8px;">Имя<button class="order_button" value="first_name"><img class="table_ico" src="img/StickDown.svg"></button></th>

						<th class="full_th" style="background: #F8F8F8">Email<button class="order_button" value="email"><img class="table_ico" src="img/StickDown.svg"></button></th>

						<th class="full_th" style="background: #F8F8F8">Телефон<button class="order_button" value="tel"><img class="table_ico" src="img/StickDown.svg"></button></th>

						<th class="full_th" style="background: #F8F8F8">Продукт<button class="order_button" value="course_id"><img class="table_ico" src="img/StickDown.svg"></button></th>

                        <th class="full_th" style="background: #F8F8F8;border-radius: 0px 8px 8px 0px;">Сумма<button class="order_button" value="give_money"><img class="table_ico" src="img/StickDown.svg"></button></th>

                    </tr>

                </thead>

                <tbody id="viewTab">


                </tbody>

            </table>
            <div class="no-data" id="order__havent_data">
                <p>Данных пока нет</p>
            </div>

        </div>
        </div>
    </div>
</div>
<div class="display-none" id="currency"><?php echo isset($_SESSION["user"]['currency']) ? $_SESSION["user"]['currency'] : '₽'?></div>


</body>

<script>

    let request1 = new XMLHttpRequest();

    let url1 = "/StatisticsController/GetStatistics";

    request1.open('GET', url1);

    request1.setRequestHeader('Content-Type', 'application/x-www-form-url');
    request1.addEventListener("readystatechange", () => {
        if (request1.readyState === 4 && request1.status === 200) {
            const array = JSON.parse(request1.responseText);
            console.log(array)
            let currency = document.getElementById('currency').innerHTML;
            if (array.week) {
                document.getElementById('this_week').innerHTML = array.week + currency;
            }

            if (array.month) {
                document.getElementById('this_month').innerHTML = array.month + currency;
            }

            if (array.prev_week) {
                document.getElementById('prev_week').innerHTML = array.prev_week + currency;
            }

            if (array.prev_month) {
                document.getElementById('prev_month').innerHTML = array.prev_month + currency;
            }
        }
    });
    request1.send();
</script>


<script>
        const order_button = document.querySelectorAll('.order_button');
        let tab = document.querySelector('#viewTab');

        let request = new XMLHttpRequest();

        let url = "/SortController/Clients?order=first_name";

        request.open('GET', url);

        request.setRequestHeader('Content-Type', 'application/x-www-form-url');
        request.addEventListener("readystatechange", () => {
            if (request.readyState === 4 && request.status === 200) {
                if (request.responseText.length != 0) {
                    document.querySelector('.no-data').remove();
                    tab.innerHTML = request.responseText;
                }

            }
        });
        request.send();


        for (var i = 0; i < order_button.length; ++i) {
            order_button[i].addEventListener('click', function(e) {
                if(this.innerHTML == '<img class="table_ico" src="img/StickDown.svg">'){
                    this.innerHTML = '<img class="table_ico" src="img/StickUp.svg">';
                    var param = this.value + " DESC";
                }else{
                    this.innerHTML = '<img class="table_ico" src="img/StickDown.svg">';
                    param = this.value;
                }
                let request = new XMLHttpRequest();

                let url = "/SortController/Clients?order=" +param;

                request.open('GET', url);

                request.setRequestHeader('Content-Type', 'application/x-www-form-url');
                request.addEventListener("readystatechange", () => {
                    if (request.readyState === 4 && request.status === 200) {
                        if (request.responseText.length != 0) {
                            tab.innerHTML = request.responseText;
                        }
                    }
                });
                request.send();
            });
        }
    </script>
    <script src="../js/sidebar.js"></script>
    <script src="/js/getNotifications.js"></script>
</html>
