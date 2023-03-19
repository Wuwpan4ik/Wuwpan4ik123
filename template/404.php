<html lang="ru">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Course Creator - Произошла ошибка</title>
    <!--Favicon-->
    <link rel="icon" type="image/x-icon" href="/uploads/course-creator/favicon.ico">
</head>
<style>
    .page_404{
        padding:40px 0;
        background:#fff;
        font-family: 'Inter';
        display:flex;
        justify-content:center;
        align-items:center;
        flex-direction:column;
        font-weight: 200;
    }

    .page_404  img{
        width:100%;
    }

    .four_zero_four_bg {
        background-image: url(https://cdn.dribbble.com/users/285475/screenshots/2083086/dribbble_1.gif);
        background-repeat:no-repeat;
        height: 400px;
        background-position: center;
    }


    .four_zero_four_bg h1{
        text-align:center;
        font-size:80px;
        font-family: 'Inter';
        font-weight: 700;
    }

    .four_zero_four_bg h3{
        font-size:80px;
        font-family: 'Inter';
        font-weight: 200;
    }

    .link_404{
        color: #fff!important;
        padding: 10px 20px;
        background: linear-gradient(180deg, #6989FE 0%, #3C64F4 100%);
        margin: 20px 0;
        display: inline-block;
        border-radius: 8px;

    }

    .contant_box_404{
        text-align:center;
        margin-top:-50px;

    }
</style>
<body>
<?php //print_r($_SESSION['error']) ?>
<section class="page_404">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 ">
                <div class="col-sm-10 col-sm-offset-1  text-center">
                    <div class="four_zero_four_bg">
                        <h1 class="text-center ">404</h1>


                    </div>

                    <div class="contant_box_404">
                        <h3 class="h2">
                            К сожалению данная страница не существует
                        </h3>

                        <p>вернитесь на главную что продолжить использование сайта</p>

                        <a href="/" class="link_404">На главную</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>