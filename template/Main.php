<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <title>ccio</title>
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/nullCss.css">

    <link rel="stylesheet" type="text/css" href="./css/app.css">

    <link rel="stylesheet" href="./css/feed.css">

    <link rel="stylesheet" href="./css/index.css">

    <link rel="stylesheet" href="./css/tableusers.css">

    <link rel="stylesheet" href="./css/main.css">

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

                    <p>последние 72 часа</p>

                </div>

                <button class="ico_button" id="date">

                    <img class="ico" src="img/ArrowLeft.svg">

                    <a>Январь, 2022</a>

                    <img class="ico" src="img/ArrowRight.svg">

                </button>

            </div>

            <div class="boxes">

                <div class="box">

                    <p>Эта неделя<img class="index_ico" src="img/ArrowUp.svg"></p>

                    <h3>74 996Р</h3>

                </div>

                <div class="box box-active">

                    <p>В месяц<img class="index_ico" src="/img/ArrowDownActive.svg"></p>

                    <h3>67 996Р</h3>

                </div>

                <div class="box">

                    <p>Прошлая неделя<img class="index_ico" src="img/ArrowUp.svg"></p>

                    <h3>54 435Р</h3>

                </div>

                <div class="box">

                    <p>Прошлый месяц<img class="index_ico" src="img/ArrowDown.svg"></p>

                    <h3>77 000Р</h3>

                </div>

            </div>

        </div>
        <div class="Tableusers">

            <table cellSpacing="0">

                <thead class="fixedHeader">

					<tr>

						<th>Имя<button class="order_button" value="first_name"><img class="table_ico" src="img/StickDown.svg"></button></th>

						<th>Email<button class="order_button" value="email"><img class="table_ico" src="img/StickDown.svg"></button></th>

						<th>Статус<button class="order_button" value="status"><img class="table_ico" src="img/StickDown.svg"></button></th>

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
            const order_button = document.querySelectorAll('.order_button');
            const tab = document.querySelector('#viewTab');

            let request = new XMLHttpRequest();

            let url = "?option=SortController&method=get_content&order=first_name";

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
						var  param = this.value + " DESC";
					}else{
						this.innerHTML = '<img class="table_ico" src="img/StickDown.svg">';
						param = this.value;
					}
                    let request = new XMLHttpRequest();

                    let url = "?option=SortController&method=get_content&order=" +param;

					request.open('GET', url);

					request.setRequestHeader('Content-Type', 'application/x-www-form-url');
					request.addEventListener("readystatechange", () => {
						if (request.readyState === 4 && request.status === 200) {
							tab.innerHTML = request.responseText;
						}
					});
					request.send();
				});
			};
        </script>

</html>
