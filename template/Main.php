<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <title>ccio</title>

    <link rel="stylesheet" href="/css/nullCss.css">

    <link rel="stylesheet" href="/css/main.css">



</head>

<body>

<div class="app">

    <?php include 'default/sidebar.php';?>

    <div class="feed">

        <?php
        $title = "Ключевые показатели";
        include ('default/header.php');
        ?>
        <? print_r($_SESSION['error']) ?>

        <div class="_container">

        <div class="index ">

            <div class="header">

                <div>

                    <h2>Самые важные показатели</h2>

                    <p>последние 72 часа</p>

                </div>

                <button class="ico_button" id="date">

                    <img class="ico" src="img/ArrowLeft.svg">

                    <a>Январь, 2022</a>

                    <img class="ico" src="img/ArrowRight.svg">

                </button>

            </div>

            <div class="boxes">

                <div class="box active">

                    <p>Эта неделя<img class="index_ico" src="img/ArrowUp.svg"></p>

                    <h3 id="this_week">0 ₽</h3>

                </div>

                <div class="box active">

                    <p>В месяц<img class="index_ico" src="img/ArrowUp.svg"></p>

                    <h3 id="this_month">0 ₽</h3>

                </div>

                <div class="box active">

                    <p>Прошлая неделя<img class="index_ico" src="img/ArrowUp.svg"></p>

                    <h3 id="prev_week">0 ₽</h3>

                </div>


                <div class="box  active">

                    <p>Прошлый месяц<img class="index_ico" src="img/ArrowDown.svg"></p>

                    <h3 id="prev_month">0 ₽</h3>

                </div>

            </div>

        </div>
        <div class="Tableusers">

            <table cellSpacing="0">

                <thead class="fixedHeader">

					<tr>

						<th>Имя<button class="order_button" value="first_name"><img class="table_ico" src="img/StickDown.svg"></button></th>

						<th>Email<button class="order_button" value="email"><img class="table_ico" src="img/StickDown.svg"></button></th>

						<th>Телефон<button class="order_button" value="telephone"><img class="table_ico" src="img/StickDown.svg"></button></th>

						<th>Продукт<button class="order_button" value="niche"><img class="table_ico" src="img/StickDown.svg"></button></th>

					</tr>

                </thead>

                <tbody id="viewTab">


                </tbody>

            </table>

        </div>
        </div>


    </div>

</div>

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
            console.log(array)
            if (array.week) {
                document.getElementById('this_week').innerHTML = array.week + "₽";
            }
            if (array.month) {
                document.getElementById('this_month').innerHTML = array.month + "₽";
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
                tab.innerHTML = request.responseText;
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
                        tab.innerHTML = request.responseText;
                    }
                });
                request.send();
            });
        }
    </script>
    <script src="/js/getNotifications.js"></script>
</html>
