
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Моя тестовая страница</title>
    <link rel="stylesheet" href="/css/nullCss.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/settingsAccountUser.css">
    <link rel="stylesheet" href="/css/UserMenu.css">
    <link rel="stylesheet" href="/css/UserMain.css">
    <link rel="stylesheet" href="/css/smallPlayer.css">
</head>
<body class="body">
<? print_r($_SESSION['dwdwd']);?>
<div class="UserMain bcg">
    <div class="_container" style="height: 9%;">
        <div class="User-header">
            <div class="User-logo user__logo">
                <div class="user__logo-img"><img src="../img/Logo.svg" alt=""></div>
                <div class="user__logo-text">Центр Ратнера</div>
            </div>
            <div class="header-main__burger">
                <div class="main__burger">
                    <span></span>
                </div>
            </div>
        </div>
    </div>
    <div class="popup__container">
        <div class=" aboutTheAuthor userPopup active ">
            <div class="aboutTheAuthor userPopup__title">
                Выберите автора:
            </div>
            <div class="aboutTheAuthor userPopup__body">
                <div class="  popup__allLessons-body">
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
                                <button class="buttonUserPopup">Вам доступны <?=$item['count']?> курса</button>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class=" availableToYou  userPopup  ">
            <div class="availableToYou userPopup__title">
                Вам доступны:
            </div>
            <div class="availableToYou userPopup__body">
                <div class=" availableToYou ">
                    <div class="availableToYou availableToYou__body ">
                        <?php
                        foreach ($content['course_page'] as $item) {
                            ?>
                        <div class="popup__allLessons-item availableСourses">
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
                                            <div class=" aboutTheAuthor popup__allLessons-item-info-header-number available-number">
                                                Курс
                                            </div>
                                            <div class="aboutTheAuthor-name">
                                                22 урока
                                            </div>
                                        </div>
                                        <div class="popup__allLessons-item-info-title">
                                            <?=$item['name']?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
                <div class="otherСourses">
                    <div class=" otherСourses userPopup__title">
                        Другие курсы автора:
                    </div>
                    <div class="otherСourses userPopup__body">
                        <div class="otherСourses__body">
                            <div class="popup__allLessons-item otherCourses">
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
                                                <div class=" aboutTheAuthor popup__allLessons-item-info-header-number notAvailable-number">
                                                    Курс
                                                </div>
                                                <div class="aboutTheAuthor-name">
                                                    22 урока
                                                </div>
                                            </div>
                                            <div class="popup__allLessons-item-info-title">
                                                Управление гневом внутри себя
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="popup__allLessons-item otherCourses">
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
                                                <div class=" aboutTheAuthor popup__allLessons-item-info-header-number notAvailable-number">
                                                    Курс
                                                </div>
                                                <div class="aboutTheAuthor-name">
                                                    22 урока
                                                </div>
                                            </div>
                                            <div class="popup__allLessons-item-info-title">
                                                Управление гневом внутри себя
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="popup__allLessons-item otherCourses">
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
                                                <div class=" aboutTheAuthor popup__allLessons-item-info-header-number notAvailable-number">
                                                    Курс
                                                </div>
                                                <div class="aboutTheAuthor-name">
                                                    22 урока
                                                </div>
                                            </div>
                                            <div class="popup__allLessons-item-info-title">
                                                Управление гневом внутри себя
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="popup__allLessons-item otherCourses">
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
                                                <div class=" aboutTheAuthor popup__allLessons-item-info-header-number notAvailable-number">
                                                    Курс
                                                </div>
                                                <div class="aboutTheAuthor-name">
                                                    22 урока
                                                </div>
                                            </div>
                                            <div class="popup__allLessons-item-info-title">
                                                Управление гневом внутри себя
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="otherСourses userPopup__button questionBtn">
                        <button>Есть вопросы?</button>
                    </div>
                </div>
            </div>
        </div>
        <div class=" Course  userPopup  ">
            <div class="Course userPopup__title">
                Управление гневом внутри себя
            </div>
            <div class="Course userPopup__body">
                <div class=" Course ">
                    <div class=" Course availableToYou__body">
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
                                            <div class=" aboutTheAuthor popup__allLessons-item-info-header-number available-number">
                                                Урок 1
                                            </div>
                                            <div class="aboutTheAuthor-name">
                                                10:44
                                            </div>
                                        </div>
                                        <div class="popup__allLessons-item-info-title">
                                            Управление гневом внутри себя
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                            <div class=" aboutTheAuthor popup__allLessons-item-info-header-number available-number">
                                                Урок 2
                                            </div>
                                            <div class="aboutTheAuthor-name">
                                                10:44
                                            </div>
                                        </div>
                                        <div class="popup__allLessons-item-info-title">
                                            Управление гневом внутри себя
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                            <div class=" aboutTheAuthor popup__allLessons-item-info-header-number available-number">
                                                Урок 2
                                            </div>
                                            <div class="aboutTheAuthor-name">
                                                10:44
                                            </div>
                                        </div>
                                        <div class="popup__allLessons-item-info-title">
                                            Управление гневом внутри себя
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                            <div class=" aboutTheAuthor popup__allLessons-item-info-header-number notAvailable-number">
                                                Урок 2
                                            </div>
                                            <div class="aboutTheAuthor-name">
                                                10:44
                                            </div>
                                        </div>
                                        <div class="popup__allLessons-item-info-title">
                                            Управление гневом внутри себя
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                            <div class=" aboutTheAuthor popup__allLessons-item-info-header-number notAvailable-number">
                                                Урок 2
                                            </div>
                                            <div class="aboutTheAuthor-name">
                                                10:44
                                            </div>
                                        </div>
                                        <div class="popup__allLessons-item-info-title">
                                            Управление гневом внутри себя
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                            <div class=" aboutTheAuthor popup__allLessons-item-info-header-number notAvailable-number">
                                                Урок 2
                                            </div>
                                            <div class="aboutTheAuthor-name">
                                                10:44
                                            </div>
                                        </div>
                                        <div class="popup__allLessons-item-info-title">
                                            Управление гневом внутри себя
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                            <div class=" aboutTheAuthor popup__allLessons-item-info-header-number notAvailable-number">
                                                Урок 2
                                            </div>
                                            <div class="aboutTheAuthor-name">
                                                10:44
                                            </div>
                                        </div>
                                        <div class="popup__allLessons-item-info-title">
                                            Управление гневом внутри себя
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="Сourse-form">
                <div class="Сourse-back userPopup__button courseBackBtn">
                    <button>Назад</button>
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
                    <div class="AllLessons availableToYou__body">
                        <div class="popup__allLessons-item choice-video">
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
                                            <div class=" aboutTheAuthor popup__allLessons-item-info-header-number ">
                                                01
                                            </div>
                                            <div class="aboutTheAuthor-name">
                                                22 минуты
                                            </div>
                                        </div>
                                        <div class="popup__allLessons-item-info-title">
                                            Управление гневом внутри себя
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="popup__allLessons-item choice-video">
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
                                            <div class=" aboutTheAuthor popup__allLessons-item-info-header-number ">
                                                01
                                            </div>
                                            <div class="aboutTheAuthor-name">
                                                22 минуты
                                            </div>
                                        </div>
                                        <div class="popup__allLessons-item-info-title">
                                            Управление гневом внутри себя
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="popup__allLessons-item choice-video">
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
                                            <div class=" aboutTheAuthor popup__allLessons-item-info-header-number ">
                                                01
                                            </div>
                                            <div class="aboutTheAuthor-name">
                                                22 минуты
                                            </div>
                                        </div>
                                        <div class="popup__allLessons-item-info-title">
                                            Управление гневом внутри себя
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="popup__allLessons-item choice-video">
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
                                            <div class=" aboutTheAuthor popup__allLessons-item-info-header-number ">
                                                01
                                            </div>
                                            <div class="aboutTheAuthor-name">
                                                22 минуты
                                            </div>
                                        </div>
                                        <div class="popup__allLessons-item-info-title">
                                            Управление гневом внутри себя
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="popup__allLessons-item choice-video">
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
                                            <div class=" aboutTheAuthor popup__allLessons-item-info-header-number ">
                                                01
                                            </div>
                                            <div class="aboutTheAuthor-name">
                                                22 минуты
                                            </div>
                                        </div>
                                        <div class="popup__allLessons-item-info-title">
                                            Управление гневом внутри себя
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="popup__allLessons-item choice-video">
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
                                            <div class=" aboutTheAuthor popup__allLessons-item-info-header-number ">
                                                01
                                            </div>
                                            <div class="aboutTheAuthor-name">
                                                22 минуты
                                            </div>
                                        </div>
                                        <div class="popup__allLessons-item-info-title">
                                            Управление гневом внутри себя
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="AllLessons-form">
                <div class="userPopup__button">
                    <button>Купить весь курс за 2 000 руб.</button>
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
                                        <div class=" aboutTheAuthor popup__allLessons-item-info-header-number ">
                                            01
                                        </div>
                                        <div class="aboutTheAuthor-name">
                                            22 минуты
                                        </div>
                                    </div>
                                    <div class="popup__allLessons-item-info-title">
                                        Управление гневом внутри себя
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="youChosen-info">
                        Стоимость урока:
                        <span>250 руб.</span>
                    </div>
                    <div class="popup__buy-register">
                        <div class="popup__buy-body-form youChosen-input input">
                            <div class="popup__bonus-form-input-account input-img">
                                <img src="../img/smallPlayer/account.svg" alt="">
                            </div>
                            <input type="text" placeholder="Ваше имя">
                        </div>
                        <div class="popup__buy-body-form youChosen-input input">
                            <div class="popup__bonus-form-input-email input-img">
                                <img src="../img/smallPlayer/email.svg" alt="">
                            </div>
                            <input type="text" placeholder="Ваш email">
                        </div>
                        <div class="popup__buy-body-form youChosen-input input">
                            <div class="popup__bonus-form-input-email input-img">
                                <img src="../img/smallPlayer/phone.svg" alt="">
                            </div>
                            <input type="tel" placeholder="Ваш телефон">
                        </div>
                        <div class="question-form">
                            <div class="Сourse-back userPopup__button youChosenBackBtn">
                                <button>Назад</button>
                            </div>
                            <div class="Сourse-question userPopup__button">
                                <button>Перейти к оплате</button>
                            </div>
                        </div>
                    </div>
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
                        <div class="popup__buy-body-form question input">
                            <div class="popup__bonus-form-input-account input-img">
                                <img src="../img/smallPlayer/account.svg" alt="">
                            </div>
                            <input type="text" placeholder="Ваше имя">
                        </div>
                        <div class="popup__buy-body-form question input">
                            <div class="popup__bonus-form-input-email input-img">
                                <img src="../img/smallPlayer/email.svg" alt="">
                            </div>
                            <input type="text" placeholder="Ваш email">
                        </div>
                        <div class="popup__buy-body-form question-textarea">
                            <div class="popup__bonus-form-input-email input-img">
                                <img src="../img/smallPlayer/email.svg" alt="">
                            </div>
                            <textarea placeholder="Ваш вопрос"></textarea>
                        </div>
                    </div>
                    <div class="question-form">
                        <div class="Сourse-back userPopup__button ">
                            <button>Назад</button>
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
<script src="https://code.jquery.com/jquery-3.6.1.min.js" ></script>
<script src="../js/script.js" ></script>
</body>
</html>
