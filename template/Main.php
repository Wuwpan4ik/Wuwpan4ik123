<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <title>ccio</title>
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

        <div class="feed-header">

            <h2>Ключевые показатели</h2>

            <div class="buttonsFeed">

                <button class="ico_button"><img class="ico" src="img/Shield.svg"></button>

                <button class="ico_button"><img class="ico" src="img/Bell.svg"></button>

                <button id="apps" class="ico_button">Заявки</button>

            </div>

        </div>

        <div class="index">

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

                <div class="box">

                    <p>В месяц<img class="index_ico" src="img/ArrowUp.svg"></p>

                    <h3>67 996Р</h3>

                </div>

                <div class="box">

                    <p>Прошлая неделя<img class="index_ico" src="img/ArrowUp.svg"></p>

                    <h3>54 435Р</h3>

                </div>

                <div class="box">

                    <p>Прошлый месяц<img class="index_ico" src="img/ArrowUp.svg"></p>

                    <h3>77 000Р</h3>

                </div>

            </div>

        </div>

        <div class="Tableusers">

            <table cellSpacing="0">

                <thead class="fixedHeader">

                <tr>

                    <th>Имя<img class="table_ico" src="img/StickDown.svg"></th>

                    <th>Email<img class="table_ico" src="img/StickDown.svg"></th>

                    <th>Статус<img class="table_ico" src="img/StickDown.svg"></th>

                    <th>Продукт<img class="table_ico" src="img/StickDown.svg"></th>

                </tr>

                </thead>

                <tbody id="viewTab">

                <?
                $i = 1;
                foreach($content as $item){
                    ?>

                    <tr id="<?php if ($i % 2 == 0){ echo "white";} else { echo "grey"; }?>">

                        <td>
                            <div class="table__name">
                                <img class="table_ava" src="<?=$item['avatar']?>"/>
                                <b><?=$item['first_name']?></b>
                            </div>
                        </td>

                        <td><?=$item['email']?></td>

                        <td><?=$item['status']?></td>

                        <td><?=$item['niche']?></td>

                    </tr>
                    <?
                    $i= $i+1;}
                ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

</body>

</html>