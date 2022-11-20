<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Моя тестовая страница</title>
    <link rel="stylesheet" href="/css/nullCss.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/UserMain.css">
    <link rel="stylesheet" href="/css/smallPlayer.css">
</head>
<body class="body">
<?=$_SESSION['error'] ?>
<div class="UserMain bcg">
    <div class="_container" style="height: 9%;">
        <div class="User-header">
            <div class="User-logo user__logo">
                <div class="user__logo-img"><img src="../img/Logo.svg" alt=""></div>
                <div class="user__logo-text">Центр Ратнера</div>
            </div>
            <div class="header-main__burger">
                <a href="/UserMenu">
                    <div class="main__burger">
                        <span></span>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="popup__container">
        <div class=" aboutTheAuthor userPopup active ">
            <div class="aboutTheAuthor userPopup__title">
                Выберите автора:
            </div>
            <div class="aboutTheAuthor userPopup__body">
                <div class="popup__allLessons-body">
                    <?php
                        foreach ($content['author_page'] as $item) {
                    ?>
                    <div class="popup__allLessons-item ">
                        <div class="popup__allLessons-item__header">
                            <div class="popup-item">
                                <div class="popup__allLessons-item-video">
                                    <div class="popup__allLessons-item-video__img">
                                        <img src="../img/smallPlayer/Group1426.png" alt="">
                                        <div class="popup__allLessons-item-video-play">
                                            <img src="../img/smallPlayer/play.png" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="popup__allLessons-item-info">
                                    <div class="popup__allLessons-item-info-header">
                                        <div class=" aboutTheAuthor popup__allLessons-item-info-header-number available-number">
                                            Автор
                                        </div>
                                        <div class="aboutTheAuthor-name">
                                            <?=$item['first_name']?> <?=$item['second_name']?>
                                        </div>
                                    </div>
                                    <div class="popup__allLessons-item-info-title">
                                        <?=$item['name']?>
                                    </div>
                                </div>
                            </div>
                            <div class="aboutTheAuthor-button availableСoursesBtn">
                                <button class="buttonUserPopup" onclick="getCoursePage(<?=$item['id']?>)">Вам доступны <?=$item['count']?> курса</button>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class=" availableToYou  userPopup">
            <div class="availableToYou userPopup__title">
                Вам доступны:
            </div>
            <div class="availableToYou userPopup__body">
                <div class=" availableToYou ">
                    <div class="availableToYou availableToYou__body course__List">
                    </div>
                </div>
                <div class="otherСourses">
                    <div class= "userPopup__title">
                        Другие курсы автора:
                    </div>
                    <div class="otherСourses userPopup__body">
                        <div class="otherСourses__body disabled__body">
                        </div>
                    </div>
                </div>
                <div class="otherСourses userPopup__button questionBtn">
                    <button>Есть вопросы?</button>
                </div>
            </div>
        </div>
        <div class=" Course  userPopup  ">
            <div class="Course userPopup__title">
                Управление гневом внутри себя
            </div>
            <div class="Course userPopup__body">
                <div class=" Course ">
                    <div class=" Course availableToYou__body lesson__list">
                    </div>
                </div>
            </div>
            <div class="Сourse-form">
                <div class="Сourse-back userPopup__button courseBackBtn">
                    <button class="backToCourse">Назад</button>
                </div>
                <div class="Сourse-question userPopup__button questionBtn">
                    <button>Есть вопросы?</button>
                </div>
            </div>
        </div>
        <div class="AllLessons  userPopup">
            <div class="AllLessons userPopup__title">
                Все уроки курса:
            </div>
            <div class="AllLessons__subtitle">
                Курс состоить из 24 уроков по 20 минут
            </div>
            <div class="AllLessons  userPopup__body">
                <div class=" AllLessons ">
                    <div class="AllLessons availableToYou__body disable__videos">
                        <div class="popup__allLessons-item choice-video">
                        </div>
                    </div>
                </div>
            </div>
            <div class="AllLessons-form">
                <div class="userPopup__button buy__course-btn">
                    <button type="button" class="button__buy-course">Купить весь курс за <span class="course__price"></span> ₽</button>
                </div>
                <div class=" AllLessons userPopup__button allLessonsBackBt">
                    <button>Пока не хочу покупать</button>
                </div>
            </div>
        </div>
        <div class="youChosen userPopup">
            <div class="userPopup__title">
                Вы выбрали:
            </div>
            <div class="userPopup__body">
                <div class="youChosen availableToYou__body">
                    <div class="popup__allLessons-item ">
                        <div class="popup__allLessons-item__header">
                            <div class="popup-item">
                                <div class="popup__allLessons-item-video__img">
                                    <img src="../img/smallPlayer/Group1426.png" alt="">
                                    <div class="popup__allLessons-item-video-play">
                                        <img src="../img/smallPlayer/play.png" alt="">
                                    </div>
                                </div>
                                <div class="popup__allLessons-item-info">
                                    <div class="popup__allLessons-item-info-header">
                                        <div class=" aboutTheAuthor popup__allLessons-item-info-header-number course__buy-flag notAvailable-number">
                                            Курс
                                        </div>
                                        <div class="aboutTheAuthor-name">
                                            <span class="course__buy-count"></span>
                                        </div>
                                    </div>
                                    <div class="popup__allLessons-item-info-title course__buy-title">
                                        Управление гневом внутри себя
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="youChosen-info">
                        Стоимость <span class="course__buy-text"></span>:
                        <span><span class="course__price video__price-buy"></span> ₽</span>
                    </div>
                    <form class="form__buy-course-video" method="POST" action="/ClientsController/CourseBuy">
                        <input hidden="hidden" type="text" name="creator_id" value="" id="creator_id">
                        <input hidden="hidden" type="text" name="course_id" value="" id="course_id">
                        <div class="popup__buy-register">
                            <div class="popup__buy-body-form youChosen-input input">
                                <div class="popup__bonus-form-input-account input-img">
                                    <img src="../img/smallPlayer/account.svg" alt="">
                                </div>
                                <input type="text" name="name" placeholder="Ваше имя">
                            </div>
                            <div class="popup__buy-body-form youChosen-input input">
                                <div class="popup__bonus-form-input-email input-img">
                                    <img src="../img/smallPlayer/email.svg" alt="">
                                </div>
                                <input type="text" value="<?=$_SESSION['user']['email']?>" name="email" placeholder="Ваш email" disabled>
                            </div>
                            <div class="popup__buy-body-form youChosen-input input">
                                <div class="popup__bonus-form-input-email input-img">
                                    <img src="../img/smallPlayer/phone.svg" alt="">
                                </div>
                                <input type="tel" name="phone" placeholder="Ваш телефон">
                            </div>
                            <div class="question-form">
                                <div class="Сourse-back userPopup__button youChosenBackBtn">
                                    <button type="button">Назад</button>
                                </div>
                                <div class="Сourse-question userPopup__button">
                                    <button type="submit">Перейти к оплате</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="question userPopup">
            <div class="youPick userPopup__title">
                Есть вопросы?
            </div>
            <div class="question  userPopup__body">
                <div class=" question ">
                    <div class="popup__buy-register">
                        <form method="POST" action="/addQuestions">
                            <input type="text" name="author_id">
                            <div class="popup__buy-body-form question input">
                                <div class="popup__bonus-form-input-account input-img">
                                    <img src="../img/smallPlayer/account.svg" alt="">
                                </div>
                                <input name="name" type="text" placeholder="Ваше имя">
                            </div>
                            <div class="popup__buy-body-form question input">
                                <div class="popup__bonus-form-input-email input-img">
                                    <img src="../img/smallPlayer/email.svg" alt="">
                                </div>
                                <input name="email" type="email" placeholder="Ваш email">
                            </div>
                            <div class="popup__buy-body-form question-textarea">
                                <div class="popup__bonus-form-input-email input-img">
                                    <img src="../img/smallPlayer/email.svg" alt="">
                                </div>
                                <textarea name="question" placeholder="Ваш вопрос"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="question-form">
                        <div class="Сourse-back userPopup__button questionBack">
                            <button class="courseBackBtn">Назад</button>
                        </div>
                        <div class="Сourse-question userPopup__button">
                            <button>Перейти к оплате</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
unset($_SESSION['course_price']);
unset($_SESSION['course_id']);
?>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" ></script>
<script src="../js/script.js" ></script>
<script>
    let course_id;
    const buyCourse = document.querySelector('.button__buy-course');
    buyCourse.addEventListener('click', function () {
        getBuyCourse(course_id);
        youChosen.classList.add('active');
        allLessons.classList.remove('active')
    })

    function getBuyCourse(number) {
        let request = new XMLHttpRequest();

        let url = "/UserController/getBuyCourse?course_id=" + number;

        request.open('GET', url);

        request.setRequestHeader('Content-Type', 'application/x-www-form-url');
        request.addEventListener("readystatechange", () => {
            if (request.readyState === 4 && request.status === 200) {
                let course = JSON.parse(request.responseText)[0];
                document.querySelectorAll('.course__price').forEach((elem) => {
                    elem.innerHTML = course.price;
                })
                document.querySelector('.form__buy-course-video').action = "/ClientsController/CourseBuy";
                document.querySelector('.course__buy-title').innerHTML = course['name'];
                document.querySelector('.course__buy-count').innerHTML = course['count'] + ' урока';
                document.querySelector('.course__buy-flag').innerHTML = 'Курс';
                document.querySelector('#creator_id').value = course['author_id'];
                document.querySelector('#course_id').value = course_id;
            }
        });
        request.send();
    }

    function getVideoInfo(number) {
        let request = new XMLHttpRequest();

        let url = "/UserController/getVideoInfo?video_id=" + number;

        request.open('GET', url);

        request.setRequestHeader('Content-Type', 'application/x-www-form-url');
        request.addEventListener("readystatechange", () => {
            if (request.readyState === 4 && request.status === 200) {
                let content = JSON.parse(request.responseText);
                document.querySelector('.form__buy-course-video').action = "/ClientsController/CourseVideo";
                document.querySelector('.video__price-buy').innerHTML = content.price;
                document.querySelector('.course__buy-title').innerHTML = content.name;
                document.querySelector('.course__buy-count').innerHTML = content[0] + ' минут';
                document.querySelector('.course__buy-flag').innerHTML = 'Урок ' + content.query_id;
                document.querySelector('#creator_id').value = content.author_id;
                document.querySelector('#course_id').value = number;
            }
        });
        request.send();
    }

    function getCoursePage (number) {
        let request = new XMLHttpRequest();

        let url = "/UserController/getCourse?author_id=" + number;

        request.open('GET', url);

        request.setRequestHeader('Content-Type', 'application/x-www-form-url');
        request.addEventListener("readystatechange", () => {
            if (request.readyState === 4 && request.status === 200) {
                document.querySelector('.course__List').innerHTML = request.responseText;
                let availableСourses = document.body.querySelectorAll('.availableСourses');
                availableСourses.forEach(item => {
                    item.onclick = function () {
                        getListPage(item.querySelector('#id').value);
                        course.classList.add('active');
                        availableToYou.classList.remove('active')
                    }
                })

            }
        });
        request.send();
        let requestDisable = new XMLHttpRequest();

        let urlDisable = "/UserController/getDisableCourse?author_id=" + number;

        requestDisable.open('GET', urlDisable);

        requestDisable.setRequestHeader('Content-Type', 'application/x-www-form-url');
        requestDisable.addEventListener("readystatechange", () => {
            if (requestDisable.readyState === 4 && requestDisable.status === 200) {
                document.querySelector('.disabled__body').innerHTML = requestDisable.responseText;
                console.log(requestDisable.responseText.length)
                if (requestDisable.responseText.length === 0) {
                    document.querySelector('.otherСourses').style = 'display:none;';
                    return false;
                }
                let otherCourses = document.body.querySelectorAll('.otherCourses');
                otherCourses.forEach(item => {
                    item.onclick = function () {
                        getDisablePage(item.querySelector('#id').value);
                        allLessons.classList.add('active');
                        availableToYou.classList.remove('active')
                    }
                })
            }
        })
        requestDisable.send();
    }
    function getListPage (number) {
        let request1 = new XMLHttpRequest();

        let url1 = "/UserController/getList?course_id=" + number;

        request1.open('GET', url1);

        request1.setRequestHeader('Content-Type', 'application/x-www-form-url');
        request1.addEventListener("readystatechange", () => {
            if (request1.readyState === 4 && request1.status === 200) {
                document.querySelector('.lesson__list').innerHTML = request1.responseText;
            }
        });
        request1.send();
    }

    function getDisablePage (number) {
        let request1 = new XMLHttpRequest();

        let url1 = "/UserController/getList?course_id=" + number + "&disable=true";

        request1.open('GET', url1);

        request1.setRequestHeader('Content-Type', 'application/x-www-form-url');
        request1.addEventListener("readystatechange", () => {
            if (request1.readyState === 4 && request1.status === 200) {
                getBuyCourse(number);
                course_id = number;
                document.querySelector('.disable__videos').innerHTML = request1.responseText;
                let choiceVideo = document.body.querySelectorAll('.choice-video');
                choiceVideo.forEach(item => {
                    item.onclick = function () {
                        youChosen.classList.add('active');
                        allLessons.classList.remove('active')
                        getVideoInfo(item.dataset.id);
                    }
                })
            }
        });
        request1.send();
    }
</script>
</body>
</html>
