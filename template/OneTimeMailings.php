<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Creator - Разовая рассылка</title>
    <link rel="stylesheet" href="/css/nullCss.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/aboutuser.css">
    <link rel="stylesheet" href="/css/analytics.css">
    <!--Favicon-->
    <link rel="icon" type="image/x-icon" href="/uploads/course-creator/favicon.ico">
</head>
<body>
<div class="ot-mailings">
    <?php include 'default/sidebar.php';?>
    <div class="feed">
        <?php
        $back = 'Mailings';
        $title = "Разовые рассылки";
        include ('default/header.php');
        ?>
        <div class=" _container">
            <div class="ot-mailings__body">

                    <div class="ot-mailing__header">
                        <div class="mytabs ot-mailing__menu">
                            <input type="radio" id="all" name="mytabs" checked="checked" />
                            <label class="menu-label" for="all" id="oplab"><p>Все</p></label>
                            <div class="tab">
                                
                                <div class="create" style="width: 100%; display: flex; justify-content: center"><a class="create-new-mailing" style="min-width: 100%;" href="/NewMailing/">Создать новую рассылку</a></div>
                                
                                <table class="table ot-mailings__table" cellSpacing="0">

                                    <thead class="fixedHeader">

                                    <tr>

                                        <th><div class="th-title"><button class="order_button order__button" value="money"></button>Статус рассылки</div></th>

                                        <th  ><div class="th-title"><button class="order_button order__button" value="email"></button>Данные рассылки</div></th>

                                        <th><div class="th-title"><button class="order_button order__button" value="tel"></button>Аудитория</div></th>

                                         <th style="border-radius: 0px 8px 8px 0px;"><div class="th-title"><button class="order_button order__button" value="achivment_date"></button>Дата отправки</div></th>

                                        <th style="border-radius: 0px 8px 8px 0px;"><div class="th-title"><button class="order_button order__button" value="achivment_date"></button>Управление</div></th>

                                    </tr>

                                    </thead>



                                    <tbody id="viewTab">
                                    
                                    <?php foreach ($content['mailings'] as $item) { ?>

                                    <tr>
                                        <td class="status"><p class="ot-mailing__date">Отправлено</p></td>

                                        <td class="sent" >
                                            <b><?=$item['name'] ?></b> <br>
	                                        <?php echo mb_strimwidth($item['description'], 0, 30) ?>
                                        </td>

                                        <td class="audience"><?php switch ($item['indexs']) {
                                                case 1:
                                                    echo "Всем";
                                                    break;
                                                case 2:
	                                                echo "Кто оплатил";
	                                                break;
		                                        case 3:
			                                        echo "Кто не оплатил";
			                                        break;
	                                        }?></td>

                                        <td class="departure_date"><?php echo date("d.m.Y", strtotime($item['date_send'])); ?></td>

                                        <td class="control"><a href="/NewMailing/<?=$item['id'] ?>"><img src="/img/brush.svg" alt=""></a><a href="/mailing-delete/<?=$item['id'] ?>"><img src="/img/Delete.svg" alt=""></a></td>
                                        
                                    </tr>

                                    <?php } ?>


                                    </tbody>

                                </table>
                            </div>
                            <input type="radio" id="sent" name="mytabs"/>
                            <label class="menu-label" for="sent" id=""><p>Отправленные</p></label>
                            <div class="tab">2</div>
                            <input type="radio" id="draft" name="mytabs"/>
                            <label class="menu-label" for="draft" id="cllab"><p>Черновики</p></label>
                            <div class="tab">3</div>
                        </div>
                    </div>



            </div>
        </div>
    </div>
</div>
<script src="/js/jquery-3.6.1.min.js"></script>
<script src="../js/sidebar.js"></script>
<script src="/js/getNotifications.js"></script>
</body>
</html>