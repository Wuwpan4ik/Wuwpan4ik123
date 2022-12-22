<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">



    <link rel="stylesheet" href="/css/nullCss.css">

    <link rel="stylesheet" href="/css/Article.css">

    <title>Document</title>

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
                                <button>Хочу так же</button>
                            </form>
                        </div>


                    </div>
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
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    window.addEventListener("scroll", (event) => {
        let scroll = this.scrollY;
        if(scroll >= 270){
            document.querySelector('.Article-post-item').classList.remove('active');
            document.querySelector('.Article-post-item').style.position = 'fixed';
            document.querySelector('.Article-post-item').style.left = '26.3%';
            document.querySelector('.Article-post-item').style.top = '70px';
            document.querySelector('.Article-post-item').style.bottom = 'null';
        }
        else if(scroll <= 270){
            document.querySelector('.Article-post-item').classList.add('active');
            document.querySelector('.Article-post-item').style.position = 'absolute'
            document.querySelector('.Article-post-item').style.left = '40px';
            document.querySelector('.Article-post-item').style.top = '';
        }
        console.log(scroll)
    });
    // let scrollSize
    //     function scroll() {
    //
    //         scrollSize = window.pageYOffset || document.documentElement.scrollTop;
    //         console.log(scrollSize)
    //         if(scrollSize >= 250){
    //             document.querySelector('.Article-post-item').style.position = 'fixed'
    //             document.querySelector('.Article-post-item').style.left = '24%';
    //             document.querySelector('.Article-post-item').style.top = '380px';
    //         }
    //         setInterval(function(){
    //             console.log(scrollSize);
    //         }, 100)
    //     }
    //
    //     window.addEventListener('resize', () => {
    //         scroll()
    //     });
    //
    //     window.addEventListener('load', () => {
    //         scroll()
    //     });

</script>
</body>

</html>
