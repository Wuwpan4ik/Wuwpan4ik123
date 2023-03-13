<html lang="ru">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Creator - Статистика</title>
    <link rel="stylesheet" href="/css/nullCss.css">
    <link rel="stylesheet" href="/css/analytics.css">
    <link rel="stylesheet" href="/css/main.css">

    <!--Favicon-->
    <link rel="icon" type="image/x-icon" href="/uploads/course-creator/favicon.ico">

</head>

<body>

<style>
    .menu-label {
        width: 100%;
    }
</style>

<div class="Analytics app">

    <?php include 'default/sidebar.php';?>

    <div class="feed">

        <?php
        $title = "Заказы";
        include ('default/header.php');
        ?>

        <div class="mytabs  _container">

            <input style="display: none" type="radio" id="Orders" name="mytabs" checked="checked"/>

            <label style="display: none" class="menu-label" id="ordlab" for="Orders"><p>Заказы</p></label>
            <div class="tab">

                <div class="Tableusers" style="overflow: hidden; margin-top: 0">

                    <div class="header">
                        <div class="header__title">
                            <h2>Список ваших заказов</h2>
                        </div>
                        <div class="head_buttons">
                            <form id="DeleteAllOrders" action="/AnalyticController/DeleteAllOrders" method="POST">
                                <input type="text" name="items_id" id="DeleteAllOrders_input">
                                <button type="submit" class="filter_button orders_id__delete-all display-none">
                                    Удалить заказы
                                </button>
                            </form>
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

                            <button class="ico_button disabledBtn"><img class="ico" src="img/Download.svg">Выгрузить</button>

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

                            <th style="border-radius: 0px 8px 8px 0px;"><div class="th-title"><button class="order_button order__button" value="achivment_date"><img class="table_ico" src="img/StickDown.svg"></button>Дата</div></th>

                        </tr>

                        </thead>

                        <tbody id="orderTab">

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
<script src="/js/jquery-3.6.1.min.js"></script>
<script src="../js/script.js" ></script>
<script src="../js/sidebar.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<script src="../js/charts.js"></script>
<script src="/js/getNotifications.js"></script>
<!--Удаление элементов-->
<script>
    const order_check = document.querySelector('#order_check');
    order_check.addEventListener('click', function (e) {
        let check_user = document.querySelectorAll('.check_order');
        Array.prototype.forEach.call(check_user, function(cb){
            cb.checked = e.target.checked;
        });
    })
</script>

<!--AJAX Загрузка данных для таблиц-->
<script>

    let order_button = document.querySelectorAll('.order__button');
    let tab = document.querySelector('#orderTab');

    function GetOrders(url, request) {
        request.open('GET', url);

        request.setRequestHeader('Content-Type', 'application/x-www-form-url');
        request.addEventListener("readystatechange", () => {
            if (request.readyState === 4 && request.status === 200) {
                if (request.responseText) {
                    tab.innerHTML = request.responseText;
                    document.querySelector('#order__havent_data').classList.add('display-none');
                }
            }
        });
        request.send();
    }

    // Прогрузка Заказов
    let request = new XMLHttpRequest();
    let url = "SortController/AnalyticOrders?sort=id";
    GetOrders(url, request)

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

            GetOrders(url, request);
        });
    });
</script>

<!--Статистика-->
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

    filterBtn.forEach(item => function (){
        item.onclick = () => {
            filterActive(item);
        }
    })

    // Фильтр Новых старых
    function filterActive(filter) {
        filterBtn.forEach(item => function (){
            if (item === filter) {
                item.classList.add('active');
            } else {
                item.classList.remove('active');
            }
        })
    }
</script>
</html>
