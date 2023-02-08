<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link rel="stylesheet" href="/css/nullCss.css">

    <link rel="stylesheet" href="/css/Article.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/lessons.css">
    <title>Кейс - <?php print_r($content['article']['cases_name'])?></title>

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
                    <img src="../img/Article/header-img.jpg" alt="">
                </div>



                    <div class="Article-post">
                        <p>Этот кейс – это история о том, как прокачать языковую онлайн школу для детей, запустив проект с нуля с начала пандемии, и увеличить количество преподавателей в 7 раз, получив 3061 заявку из таргета Инстаграм. Об этом кейсе мы и рассказываем в этой статье.</p>
                        <p>Этот кейс – это история о том, как прокачать языковую онлайн школу для детей, запустив проект с нуля с начала пандемии, и увеличить количество преподавателей в 7 раз, получив 3061 заявку из таргета Инстаграм. Об этом кейсе мы и рассказываем в этой статье.</p>
                        <div class="Article-post-quotation">
                            <img src="../img/Article/post-quotation-marks.svg" alt="">
                            <p>Этот кейс – это история о том, как прокачать языковую онлайн школу для детей, запустив проект с нуля с начала пандемии, и увеличить количество преподавателей в 7 раз, получив 3061 заявку из таргета Инстаграм. Об этом кейсе мы и рассказываем в этой статье.</p>
                        </div>
                        <div class="Article-post-img">
                            <img src="../img/Article/post-img.jpg" alt="">
                        </div>
                        <p>Этот кейс – это история о том, как прокачать языковую онлайн школу для детей, запустив проект с нуля с начала пандемии, и увеличить количество преподавателей в 7 раз, получив 3061 заявку из таргета Инстаграм. Об этом кейсе мы и рассказываем в этой статье.</p>
                        <p>Этот кейс – это история о том, как прокачать языковую онлайн школу для детей, запустив проект с нуля с начала пандемии, и увеличить количество преподавателей в 7 раз, получив 3061 заявку из таргета Инстаграм. Об этом кейсе мы и рассказываем в этой статье.</p>
                        <div class="Article-post-container">
                            <div class="Article-post-item active">
                                <div class="Article-post-item-img">
                                    <img src="../img/Article/cart-img.jpg" alt="">
                                </div>

                                <div class="Article-post-item__title">
                                    Курс менеджер инстаграмм
                                </div>
                                <div class="Article-post-item__main">
                                    <p>Instakilogram</p>
                                    <div class="Article-post-item__rating">
                                        <img src="../img/Article/rating.svg" alt="">
                                        <span>4.3</span>
                                    </div>
                                </div>
                                <div class="Article-post-item__price">
                                    109 100 ₽ - 160000 ₽ в месяц
                                </div>
                                <div class="Article-post-item__time">
                                    <img src="../img/Article/time.svg" alt="">
                                    недавно
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
