<!DOCTYPE html>

<html lang="ru">

<head>
	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Course Creator - Список клиентов</title>
	
	<link rel="stylesheet" href="/css/nullCss.css">
	
	<link rel="stylesheet" href="/css/main.css">
	<!--Favicon-->
	<link rel="icon" type="image/x-icon" href="/uploads/course-creator/favicon.ico">
</head>

<body>

<style>
    .full_th {
        width: 25% !important;
    }
    #viewTab td {
        overflow: hidden;
    }
    #viewTab td:first-child:hover {
        position: absolute;
        box-shadow: #5A6474 1px 1px 10px;
        overflow: visible;
        width: 300px;
        background: #ffffff;
    }
    * {
        font-size: 14px;
    }
</style>

<div class="error display-none"><?php print_r($_SESSION['error']) ?>
</div>

<div class="app" style="overflow-y: scroll">
	
	<?php include 'Admin/layouts/sidebar.php';?>

    <div class="Tableusers" style="width: 100%; margin: 0; padding: 30px;">

        <table cellSpacing="0">

            <thead class="fixedHeader statistics" style="background: #F8F8F8;">

            <tr>
                <th class="full_th" style="border-radius: 8px 0px 0px 8px;">Почта<button class="order_button" value="email"><img class="table_ico" src="../img/StickDown.svg"></button></th>

                <th class="full_th" style="border-radius: 8px 0px 0px 8px;">Начальная дата<button class="order_button" value="date_start"><img class="table_ico" src="../img/StickDown.svg"></button></th>

                <th class="full_th">Конечная дата<button class="order_button" value="date"><img class="table_ico" src="../img/StickDown.svg"></button></th>

                <th class="full_th">Тарифный план<button class="order_button" value="name"><img class="table_ico" src="../img/StickDown.svg"></button></th>

                <th class="full_th">Функции</th>

            </tr>

            </thead>

            <tbody id="viewTab">


            </tbody>

        </table>
<!--        <div class="no-data" id="order__havent_data">-->
<!--            <p>Данных пока нет</p>-->
<!--        </div>-->

    </div>

</div>
<script>
    const order_button = document.querySelectorAll('.order_button');
    let tab = document.querySelector('#viewTab');
    

    let request = new XMLHttpRequest();

    let url = "/AdminController/GetClients?order=email";

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
            if(this.innerHTML == '<img class="table_ico" src="../img/StickDown.svg">'){
                this.innerHTML = '<img class="table_ico" src="../img/StickUp.svg">';
                var param = this.value + " DESC";
            }else{
                this.innerHTML = '<img class="table_ico" src="../img/StickDown.svg">';
                param = this.value;
            }
            let request = new XMLHttpRequest();

            let url = "/AdminController/GetClients?order=" +param;

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

</body>
</html>
