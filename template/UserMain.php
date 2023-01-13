<html lang="ru">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Course Creator - Главная</title>
    <link rel="stylesheet" href="/css/nullCss.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/UserMain.css">
    <link rel="stylesheet" href="/css/smallPlayer.css">
    <!--Favicon-->
    <link rel="icon" type="image/x-icon" href="/uploads/course-creator/favicon.ico">
</head>
<body class="body">

<div class="UserMain bcg">
    <div class="_container" style="height: 9%;">
        <div class="User-header">
            <div class="User-logo user__logo">
                <div class="user__logo-img"><img src="../img/Logo.svg" alt=""></div>
                <div class="user__logo-text">Course Creator</div>
            </div>
            <div class="header-main__burger">
                <button onclick="UserMenuLocation()">
                    <div class="main__burger">
                        <span></span>
                    </div>
                </button>
            </div>
        </div>
    </div>
    <div class="popup__container">
        <div class=" aboutTheAuthor userPopup active ">
            <div class="aboutTheAuthor userPopup__title">
                Выберите автора:
            </div>
            <div class="aboutTheAuthor__body userPopup__body">

                    <?php
                        foreach ($content['author_page'] as $item) {
                    ?>
                    <div class="popup__allLessons-item ">
                        <div class="popup__allLessons-item__header">
                            <div class="aboutTheAuthor popup-item">
                                <div class=" popup__allLessons-item-video">
                                    <div class="popup__allLessons-item-video__img">
                                        <img class="aboutTheAuthor video__img" src="<? echo (isset($item['avatar']) && !is_null($item['avatar'])  ? $item['avatar'] : "/uploads/ava/userAvatar.jpg") ?>" alt="">
                                    </div>
                                </div>
                                <div class="aboutTheAuthor popup__allLessons-item-info">
                                    <div class="popup__allLessons-item-info-header">
                                        <div class=" aboutTheAuthor available-number">
                                            Автор
                                        </div>
                                        <div class="aboutTheAuthor-name">
                                            <a href="/AboutTheAuthor/<?=$item['id']?>">
                                                <?=$item['first_name']?> <?=$item['second_name']?>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="popup__allLessons-item-info-title">
                                        <?php echo htmlspecialchars(isset($item['school_name']) ? $item['school_name'] : $item['name'] )?>
                                    </div>
                                    <div class="aboutTheAuthor__info-text hide-content">
                                        <?=$item['description'] ?></div>
                                </div>
                            </div>
                            <div class="aboutTheAuthor-button availableСoursesBtn">
                                <button class="buttonUserPopup" onclick="getCoursePage(<?=$item['id']?>)">
                                    <?php if($item['count']%1 === 1) { ?>
                                        Вам доступен <?=$item['count']?> курс
                                    <?php } else { ?>
                                        Вам доступно <?=$item['count']?> курса
                                    <?php } ?>
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    ?>

            </div>
        </div>
        <div class=" availableToYou  userPopup ">
            <div class="availableToYou userPopup__title">
                Вам доступны:
            </div>
            <div class="availableToYou userPopup__body">
                <div class=" availableToYou ">
                    <div class="availableToYou availableToYou__body course__List">
                    </div>
                </div>
                <div class="otherСourses otherСourses-popup ">
                    <div class= "userPopup__title">
                        Другие курсы автора:
                    </div>
                    <div class="otherСourses userPopup__body">
                        <div class="otherСourses__body disabled__body">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="Course userPopup course__popup">
            <div class="Course userPopup__title lesson__list_course-name">

            </div>
            <div class="Course userPopup__body">
                <div class=" Course  " style="position:relative;">
                    <div class=" Course availableToYou__body lesson__list">

                    </div>
                </div>
            </div>
            <div class="User-form-g">
                <div class="backBtn userPopup__button">
                    <button type="button" class="course__back-btn" onclick="backToAuthor(this)">Назад</button>
                </div>
                <div class="Сourse-question userPopup__button questionBtn">
                    <button>Есть вопросы?</button>
                </div>

            </div>
            <div class="questionBackground">

            </div>
        </div>

        <div class="AllLessons  userPopup ">
            <div class="AllLessons userPopup__title">
                Все уроки курса:
            </div>
            <div class="AllLessons__subtitle">
                Курс состоить из 24 уроков по 20 минут
            </div>
            <div class="AllLessons userPopup__body">
                <div class=" AllLessons ">
                    <div class="AllLessons__body disable__videos">
                        <div class="popup__allLessons-item choice-video">
                        </div>
                    </div>
                </div>
            </div>
            <div class="User-form-v">
                <div class="userPopup__button buy__course-btn">
                    <button type="button" class="button__buy-course">Купить весь курс за <span class="course__price"></span> ₽</button>
                </div>
                <div class=" AllLessons userPopup__button">
                    <button type="button" class="course__back-btn" onclick="backToAuthor(this)">Пока не хочу покупать</button>
                </div>
            </div>
        </div>
        <div class="UserMenu userPopup" style="background: #757D8A;">
            <div class="_container">
                <div class="UserMenu-profile">
                    <div class="UserMenu-profile__header">
                        <div class="UserMenu-profile__header-user">
                            <img id="avatar" src="<?php echo (isset($_SESSION['user']['avatar'])) ?  $_SESSION['user']['avatar'] : "/uploads/ava/userAvatar.jpg"; ?>"/>
                            <div class="UserMenu-profile__textInfo">
                                <p>Добро пожаловать,</p>
                                <div class="UserMenu-profile__textInfo-name">
                                    <h1>
                                        <?php if (!isset($_SESSION["user"]["first_name"])) { ?>
                                            Гость
                                        <?php } else { ?>
                                            <? echo $_SESSION["user"]["first_name"] ?>
                                        <?php } ?>
                                    </h1>
                                </div>
                            </div>
                        </div>

                        <div>
                            <a href="/UserAccount">
                                <button class="UserMenu-profile__settings"><img class="" src="img/UserSetting.svg"></button>
                            </a>
                        </div>
                    </div>
                    <div class="UserMenu-list">
                        <div class="menu_first">
                            <a href="/UserMain">

                                <div class="UserMenu-list__option sidebarOption <? if ($_GET['option'] == 'Main') echo 'active'; ?>" >

                                    <div class="option">

                                        <svg class="svg_menu" style="width:20px;height:20px;margin:12px;" width="20" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M15.99 18H13V11C13 10.447 12.552 9.99996 12 9.99996H6C5.447 9.99996 5 10.447 5 11V18H2L2.006 9.58296L8.998 2.43196L16 9.62396L15.99 18ZM7 18H11V12H7V18ZM17.424 8.18496L9.715 0.300957C9.338 -0.084043 8.662 -0.084043 8.285 0.300957L0.575 8.18596C0.21 8.56096 0 9.08496 0 9.62396V18C0 19.103 0.847 20 1.888 20H6H12H16.111C17.152 20 18 19.103 18 18V9.62396C18 9.08496 17.79 8.56096 17.424 8.18496Z" fill="#ffffff"/>
                                        </svg>



                                        <h2>Мои курсы</h2>

                                    </div>

                                </div>

                            </a>

                            <a href="/UserNotifications">

                                <div class="UserMenu-list__option sidebarOption <? if ($_GET['option'] == 'Analytics') echo 'active'; ?>">

                                    <div class="option">

                                        <svg class="svg_menu" style="width:20px;height:20px;margin:12px;" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9 6C9 5.448 9.448 5 10 5C10.552 5 11 5.448 11 6V11C11 11.552 10.552 12 10 12C9.448 12 9 11.552 9 11V6ZM9 14C9 13.448 9.448 13 10 13C10.552 13 11 13.448 11 14C11 14.552 10.552 15 10 15C9.448 15 9 14.552 9 14ZM10 18C5.589 18 2 14.411 2 10C2 5.589 5.589 2 10 2C14.411 2 18 5.589 18 10C18 14.411 14.411 18 10 18ZM10 0C4.477 0 0 4.477 0 10C0 15.523 4.477 20 10 20C15.523 20 20 15.523 20 10C20 4.477 15.523 0 10 0Z" fill="white"/>
                                        </svg>

                                        <h2>Уведомления</h2>

                                    </div>
                                    <div class="notification-score display-none" id="msg" ></div>

                                </div>

                            </a>

                            <a href="/UserAllContacts">

                                <div class=" UserMenu-list__option sidebarOption <? if ($_GET['option'] == 'Cases') echo 'active'; ?>">

                                    <div class="option">

                                        <svg class="svg_menu" style="width:20px;height:18px;margin:12px;" width="20" height="20" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M16 15C16 15.551 15.552 16 15 16H13V13C13 12.448 12.553 12 12 12H6C5.447 12 5 12.448 5 13V16H3C2.448 16 2 15.551 2 15V3C2 2.449 2.448 2 3 2H5V7C5 7.552 5.447 8 6 8H10C10.553 8 11 7.552 11 7C11 6.448 10.553 6 10 6H7V2H10.172C10.435 2 10.692 2.107 10.879 2.293L15.707 7.121C15.896 7.31 16 7.562 16 7.829V15ZM7 16H11V14H7V16ZM17.121 5.707L12.293 0.879C11.727 0.312 10.973 0 10.172 0H3C1.346 0 0 1.346 0 3V15C0 16.654 1.346 18 3 18H6H12H15C16.654 18 18 16.654 18 15V7.829C18 7.027 17.687 6.273 17.121 5.707Z" fill="white"/>
                                        </svg>


                                        <h2>Контакты</h2>

                                    </div>

                                </div>

                            </a>

                        </div>

                        <div class="second_menu">
                            <a href="https://t.me/CourseCreatorBot" target="_blank">

                                <div class=" UserMenu-list__option sidebarOption <? if ($_GET['option'] == 'Cases') echo 'active'; ?>">

                                    <div class="option">

                                        <svg class="svg_menu" style="width:20px;height:20px;margin:12px;" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M5.0002 9.99927C5.0002 9.44727 5.4482 8.99927 6.0002 8.99927C6.5522 8.99927 7.0002 9.44727 7.0002 9.99927C7.0002 10.5513 6.5522 10.9993 6.0002 10.9993C5.4482 10.9993 5.0002 10.5513 5.0002 9.99927ZM10.0002 8.99927C9.4482 8.99927 9.0002 9.44727 9.0002 9.99927C9.0002 10.5513 9.4482 10.9993 10.0002 10.9993C10.5522 10.9993 11.0002 10.5513 11.0002 9.99927C11.0002 9.44727 10.5522 8.99927 10.0002 8.99927ZM14.0002 8.99927C13.4482 8.99927 13.0002 9.44727 13.0002 9.99927C13.0002 10.5513 13.4482 10.9993 14.0002 10.9993C14.5522 10.9993 15.0002 10.5513 15.0002 9.99927C15.0002 9.44727 14.5522 8.99927 14.0002 8.99927ZM17.8986 11.2942C17.3916 14.5482 14.7686 17.2472 11.5196 17.8562C9.9506 18.1522 8.3526 17.9832 6.9026 17.3692C6.4916 17.1952 6.0666 17.1072 5.6496 17.1072C5.4596 17.1072 5.2716 17.1252 5.0866 17.1622L2.2746 17.7242L2.8376 14.9072C2.9556 14.3222 2.8836 13.6962 2.6306 13.0972C2.0166 11.6472 1.8486 10.0502 2.1436 8.48017C2.7526 5.23117 5.4506 2.60817 8.7056 2.10117C11.2956 1.69817 13.8286 2.51417 15.6566 4.34217C17.4856 6.17117 18.3026 8.70517 17.8986 11.2942ZM17.0716 2.92817C14.7866 0.644171 11.6266 -0.374829 8.3976 0.124171C4.3206 0.760171 0.9406 4.04417 0.1776 8.11117C-0.1904 10.0692 0.0216002 12.0632 0.7886 13.8762C0.8856 14.1072 0.9156 14.3222 0.8776 14.5152L0.0196002 18.8032C-0.0463998 19.1312 0.0566002 19.4702 0.2936 19.7062C0.4826 19.8962 0.7376 19.9992 1.0006 19.9992C1.0656 19.9992 1.1306 19.9932 1.1966 19.9802L5.4796 19.1232C5.7256 19.0762 5.9636 19.1452 6.1226 19.2112C7.9376 19.9782 9.9316 20.1892 11.8876 19.8222C15.9556 19.0592 19.2396 15.6792 19.8756 11.6022C20.3776 8.37517 19.3566 5.21317 17.0716 2.92817Z" fill="white"/>
                                        </svg>

                                        <h2>Поддержка</h2>

                                    </div>

                                </div>

                            </a>
                            <a href="/LoginController/logout">

                                <div class=" UserMenu-list__option sidebarOption <? if ($_GET['option'] == 'Cases') echo 'active'; ?>">

                                    <div class="option">

                                        <svg class="svg_menu" style="width:20px;height:16px;margin:12px;" width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M4 1C4 1.55 3.55 2 3 2H2V14H3C3.55 14 4 14.45 4 15C4 15.55 3.55 16 3 16H1C0.45 16 0 15.55 0 15V1C0 0.45 0.45 0 1 0H3C3.55 0 4 0.45 4 1ZM14.0039 3.4248L16.8179 7.4248C17.0679 7.7788 17.0599 8.2538 16.7999 8.5998L13.7999 12.5998C13.6039 12.8618 13.3029 12.9998 12.9989 12.9998C12.7909 12.9998 12.5799 12.9348 12.3999 12.7998C11.9579 12.4688 11.8689 11.8418 12.1999 11.4008L14.0009 8.9998H13.9999H5.9999C5.4479 8.9998 4.9999 8.5528 4.9999 7.9998C4.9999 7.4468 5.4479 6.9998 5.9999 6.9998H13.9999C14.0164 6.9998 14.0317 7.00436 14.0472 7.00895C14.0598 7.01269 14.0724 7.01645 14.0859 7.0178L12.3679 4.5748C12.0499 4.1238 12.1589 3.4998 12.6109 3.1818C13.0619 2.8628 13.6859 2.9728 14.0039 3.4248Z" fill="white"/>
                                        </svg>


                                        <h2>Выход</h2>

                                    </div>

                                </div>

                            </a>
                        </div>

                    </div>
                </div>
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
                                    <img id="buy_product" src="../img/smallPlayer/Group1426.png" alt="">
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

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="youChosen-info">
                        Стоимость <span class="course__buy-text"></span>
                        <span><span class="course__price video__price-buy"></span> <?php echo isset($_SESSION["user"]['currency']) ? $_SESSION["user"]['currency'] : '₽'?></span>
                    </div>
                    <form class="form__buy-course-video" method="POST" action="/ClientsController/CourseBuy">
                        <input hidden="hidden" type="text" name="creator_id" value="" id="creator_id">
                        <input hidden="hidden" type="text" name="course_id" value="" id="course_id">
                        <div class="youChosen popup__buy-register">
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
                                <input type="text" value="<?=$_SESSION['user']['email']?>" name="email" placeholder="Ваш email" readonly>
                            </div>
                            <div class="popup__buy-body-form youChosen-input input">
                                <div class="popup__bonus-form-input-email input-img">
                                    <img src="../img/smallPlayer/phone.svg" alt="">
                                </div>
                                <input type="tel" name="phone" placeholder="Ваш телефон">
                            </div>
                        </div>
                        <div class="User-form-g">
                            <div class="backBtn userPopup__button youChosenBackBtn">
                                <button type="button" class="back__to__course" onclick="backToCourseList(this)">Назад</button>
                            </div>
                            <div class="Сourse-question userPopup__button">
                                <button type="submit">Перейти к оплате</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="question userPopup">
            <div class="questionInner">
                <div class="youPick userPopup__title button__questions">
                    Есть вопросы?
                </div>
                <div class="question  userPopup__body">
                    <div class=" question ">
                        <div class="popup__buy-register">
                            <form id="formQuest" method="POST" action="/ContactController/sendQuestions">
                                <input type="hidden" value="" name="author_id" id="question_author-id">
                                <input type="hidden" value="" name="course_id" id="question_course-id">
                                <?php if (!isset($_SESSION['user']['first_name'])) { ?>
                                    <div class="popup__buy-body-form question input">
                                        <div class="popup__bonus-form-input-account input-img">
                                            <img src="../img/smallPlayer/account.svg" alt="">
                                        </div>
                                        <input name="name" type="text" placeholder="Ваше имя" value="<?php echo isset($_SESSION['user']['first_name']) ? $_SESSION['user']['first_name'] : ''?>" <?php echo isset($_SESSION['user']['first_name']) ? "readonly" : ''?>>
                                    </div>
                                <?php } ?>
                                <div class="popup__buy-body-form question input">
                                    <div class="popup__bonus-form-input-email input-img">
                                        <img src="../img/smallPlayer/email.svg" alt="">
                                    </div>
                                    <input name="email" type="email" placeholder="Ваш email" value="<?php echo isset($_SESSION['user']['email']) ? $_SESSION['user']['email'] : ''?>" readonly>
                                </div>
                                <div class="popup__buy-body-form question-textarea">
                                    <div class="popup__bonus-form-input-email input-img">
                                        <img src="../img/smallPlayer/question.svg" alt="">
                                    </div>
                                    <textarea name="question" placeholder="Ваш вопрос"></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="User-form-g">
                            <div class=" userPopup__button questionBack backBtn">
                                <button class="courseBackBtn">Назад</button>
                            </div>
                            <div class="Сourse-question userPopup__button">
                                <button id="sendQuest" type="submit">Отправить</button>
                            </div>
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
<script>
    function UserMenuLocation() {

        if (!document.querySelector('.UserMenu').classList.contains('active')) {
            hiddenAllPopups()
            document.querySelector('.UserMenu').classList.toggle('active')
        } else {
            document.querySelector('.UserMenu').classList.remove('active')
            document.querySelector('.aboutTheAuthor').classList.add('active')
        }

    }
</script>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" ></script>
<script src="../js/script.js" ></script>
<script>
    document.querySelector('#sendQuest').addEventListener('click', function () {
        document.querySelector('#formQuest').submit();
    })
</script>
<script>

    function backToAuthor(elem) {
        hiddenAllPopups();
        availableToYou.classList.add('active')
        getCoursePage(elem.dataset.author_id);
    }

    function backToCourseList(elem) {
        hiddenAllPopups();
        document.querySelector('.AllLessons').classList.add('active');
        getListPage(elem.dataset.course_id);
    }

    function hiddenAllPopups() {
        document.querySelectorAll('.userPopup').forEach(item => {
            item.classList.remove('active');
        })
    }

    let course_id;
    let accordionButton;
    const buyCourse = document.querySelector('.button__buy-course');
    buyCourse.addEventListener('click', function () {
        getBuyCourse(course_id);
        hiddenAllPopups();
        youChosen.classList.add('active');
    })

    // Переход с Player на UserMain
    let course__get_url = new URL(window.location.href);
    let course__get_id = course__get_url.searchParams.get('course_id');
    let author__get_id = course__get_url.searchParams.get('author_id');
    if (course__get_id) {
        hiddenAllPopups();
        document.querySelector('.course__popup').classList.add('active');
        document.querySelector('.back__to__course').dataset.course_id = course__get_id;
        getListPage(course__get_id);
        getCoursePage(author__get_id)
        course__get_url.searchParams.delete('course_id');
        course__get_url.searchParams.delete('author_id');
        window.history.pushState({}, '', course__get_url.toString());
    }

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
                document.querySelector('.course__buy-flag').innerHTML =   content.query_id < 10 ? '0' + content.query_id : content.query_id;
                document.querySelector('#buy_product').src = content.thubnails;
                document.querySelector('#creator_id').value = content.author_id;
                document.querySelector('#course_id').value = number;
                document.querySelector('.back__to__course').dataset.course_id = number;
            }
        });
        request.send();
    }

    function getCoursePage (number) {
        $.ajax({
            url: "/UserController/getCourse?author_id=" + number,
            type: "GET",
            success: function (data) {
                document.querySelector('.course__List').innerHTML = data;
                let availableСourses = document.body.querySelectorAll('.availableСourses');
                document.getElementById('question_author-id').value = number;
                availableСourses.forEach(item => {
                    item.addEventListener("click", function (){
                        getListPage(item.querySelector('#id').value);
                        hiddenAllPopups();
                        course.classList.add('active');
                    }, false);
                })
            }
        });

        document.querySelectorAll('.course__back-btn').forEach(item => {
            item.dataset.author_id = number;
        })

        $.ajax({
            url: "/UserController/getDisableCourse?author_id=" + number,
            type: "GET",
            success: function (data) {
                document.querySelector('.disabled__body').innerHTML = data;
                if (data.trim().length === 0) {
                    document.querySelector('.otherСourses').style = 'display:none;';
                    return false;
                }
                let otherCourses = document.body.querySelectorAll('.otherCourses');
                otherCourses.forEach(item => {
                    item.onclick = function () {
                        getDisablePage(item.querySelector('#id').value);
                        hiddenAllPopups();
                        allLessons.classList.add('active');
                    }
                }, false)
            }
        });
    }

    function getCourseName(number) {
        let request = new XMLHttpRequest();

        let url = "/UserController/getBuyCourse?course_id=" + number;

        request.open('GET', url);

        request.setRequestHeader('Content-Type', 'application/x-www-form-url');
        request.addEventListener("readystatechange", () => {
            if (request.readyState === 4 && request.status === 200) {
                let course = JSON.parse(request.responseText)[0];
                document.querySelector('.lesson__list_course-name').innerHTML = course['name'];
            }
        });
        request.send();
    }

    function getListPage (number) {
        let request1 = new XMLHttpRequest();

        let url1 = "/UserController/getList?course_id=" + number;

        request1.open('GET', url1);

        request1.setRequestHeader('Content-Type', 'application/x-www-form-url');
        request1.addEventListener("readystatechange", () => {
            if (request1.readyState === 4 && request1.status === 200) {
                document.querySelector('.lesson__list').innerHTML = request1.responseText;
                console.log(request1.responseText)
                getCourseName(number);
                document.getElementById('question_course-id').value = number;
                let choiceVideo = document.body.querySelectorAll('.choice-video');
                choiceVideo.forEach(item => {
                    item.onclick = function () {
                        hiddenAllPopups();
                        youChosen.classList.add('active');
                        getVideoInfo(item.querySelector('.item__list-id').dataset.id);
                    }
                })
                startAccordion();
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
                        hiddenAllPopups();
                        youChosen.classList.add('active');
                        getVideoInfo(item.querySelector('.item__list-id').dataset.id);
                    }
                })
                document.querySelectorAll('.course__back-btn').forEach(item => {
                    item.dataset.author_id = number;
                })
                startAccordion();
            }
        });
        request1.send();
    }

    function startAccordion() {
        let accordionButton = document.querySelectorAll(".accordion-button");
        let accordionInner = document.querySelectorAll(".accordion .accordion-item .accordion-content");

        for(let i = 0; i < accordionButton.length; i++){
            accordionButton[i].onclick = () =>{
                if(accordionInner[i].classList.contains('active')){
                    accordionInner[i].classList.remove('active')
                    accordionButton[i].classList.remove('active')
                }else{
                    accordionInner[i].classList.add('active')
                    accordionButton[i].classList.add('active')
                }
            }
        }
    }


</script>
</body>
</html>
