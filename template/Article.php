<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/nullCss.css">
    <link rel="stylesheet" href="/css/Article.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/lessons.css">
    <title>Кейс - <?php echo $content['article']['cases_name'] ?></title>
    <!--Favicon-->
    <link rel="icon" type="image/x-icon" href="/uploads/course-creator/favicon.ico">
</head>
<body>
<div class="Article">
    <?php include 'default/sidebar.php';?>
    <div class="feed">
        <?php
        $title = "Доступные проекты";
        $back = "Project";
        include ('default/header.php');
        ?>
        <div class="_container">
            <div class="Article-body">
                <div class="Article-header-img">
                    <img src="<?php echo $content['article']['cases_banner']; ?>" alt="">
                </div>
                    <div class="Article-post">
                        <?php echo $content['article']['cases_inner']; ?>
                        <div class="Article-post-container">
                            <div class="Article-post-item active">
                                <div class="Article-post-item-img">
                                    <img src="<?php echo $content['article']['cases_avatar']; ?>" alt="">
                                </div>

                                <div class="Article-post-item__title">
                                    <?php echo $content['article']['cases_name']; ?>
                                </div>
                                <div class="Article-post-item__main">
                                    <p><?php echo $content['article']['cases_author']; ?></p>
                                    <div class="Article-post-item__rating">
                                        <img src="../img/Article/rating.svg" alt="">
                                        <span><?php echo $content['article']['cases_rating']; ?></span>
                                    </div>
                                </div>
                                <div class="Article-post-item__price">
                                    <?php echo $content['article']['cases_price']; ?>
                                </div>
                                <div class="Article-post-item__time">
                                    <img src="../img/Article/time.svg" alt="">
                                    <?php
                                    $new_date = strtotime($content['article']['cases_date']);
                                    $visible_date = date("d.m.Y", $new_date);
                                    echo $visible_date;
                                    ?>
                                </div>
                                <div class="Article-post-item__button">
                                    <form action="">
                                        <button type="button" class="regForCourse">Хочу так же</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

            </div>
        </div>
    </div>
</div>
<div class="popup__background" id="article-reg">
    <div id="popup">
        <div class="popup__container">
            <div class="popup-body">

                    <div class="popup__title">Хотите так же?</div>
                    <p>Введите ваш телеграмм и с вами свяжется наш специалист и проведет консультацию по внедрению описанных функций</p>
                <div class="funnel-input input_focus">
                    <label for="name" class="label_focus activeLabel">Телеграм</label>
                    <input name="name" maxlength="30" class="videoname video-desc" type="text" value="">
                    <span class="clear_input_val has_content">
        <img src="/img/clear_input.svg" alt="">
        </span>
                </div>
                <div class="popup__form">

                        <button type="submit" class="popup__btn popup__blue ">Зарегистрироваться</button>
                    </div>

            </div>
        </div>
    </div>
</div>
<script src="../js/sidebar.js"></script>
<script src="/js/getNotifications.js"></script>
<script src="/js/customInputs.js"></script>
<script>
    let popup__back = document.querySelectorAll('.popup__container');
    let reload = document.querySelector('#article-reg');
    document.querySelector('.regForCourse').addEventListener('click', function () {
            reload.classList.add('display-block');
    })
    popup__back.forEach(item => {
        item.onclick = function (event) {
            if (event.target === item) {
                reload.classList.remove('display-block');
            }
        }
    })
</script>
<script>
    let feed = document.querySelector('.feed');
    feed.addEventListener("scroll", (event) => {
        let scroll = feed.scrollTop;
            let postItem = document.querySelector('.Article-post-item')
            if(scroll >= 270){
                postItem.classList.remove('active');
                postItem.style.position = 'fixed';
                postItem.style.top = '70px';
                postItem.style.bottom = 'null';
            }
            else if(scroll <= 270){
                postItem.classList.add('active');
                postItem.style.position = 'absolute'
                postItem.style.left = '';
                postItem.style.top = '';
            }
        });
</script>
</body>

</html>
