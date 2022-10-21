<html>

  <head>

    <meta charset="utf-8">

    <title>Моя тестовая страница</title>
    <link rel="stylesheet" href="../css/sidebar.css">

    <link rel="stylesheet" href="../css/nullCss.css">

    <link rel="stylesheet" href="../css/project.css">

    <link rel="stylesheet" href="../css/feed.css">

    <link rel="stylesheet" href="../css/lessons.css">

    <link rel="stylesheet" href="../css/main.css">

  </head>

  <body>

        <div class="Project">

            <?php include 'default/sidebar.php'; ?>

            <div class="feed">

                <div class="feed-header">
                    <div class="feed-header__title">
                        <a class="button__back" href="?option=Main">
                            <img src="/img/ArrowLeft.svg" alt="">
                        </a>

                        <h2>Мои проекты</h2>
                    </div>

                    <div class="buttonsFeed">

                        <button class="ico_button"><img class="ico" src="img/Shield.svg"></button>

                        <button class="ico_button"><img class="ico" src="img/Bell.svg"></button>

                        <button id="apps" class="ico_button">Заявки</button>

                    </div>

                </div>
                <div class="Lessons">
                    <div class="_container">
                        <div class="media">
                            <div class="media-cart project__cart">
                                <p>Создано <?php echo $content['count_funnel']; ?> из 3</p>
                                <h3>Мои воронки</h3>
                                <img src="../img/Course.png" alt="">
                                <?php if ($content['count_funnel'] != 0) { ?>
                                    <button class="button-edit" onclick="window.location.href='?option=Funnel'">
                                        Редактировать
                                    </button>
                                <?php } else { ?>
                                    <button class="button-edit button-create" onclick="window.location.href='?option=DirectoryController&method=Create&folder=funnel'">
                                        Создать воронку
                                    </button>
                                <?php } ?>
                            </div>
                            <div class="media-cart">
                                <p>Создано <?php echo $content['count_course']; ?> из 3</p>
                                <h3>Мои курсы</h3>
                                <img src="../img/Course.png" alt="">
                                <?php if ($content['count_course'] !== 0) { ?>
                                    <button class="button-edit" onclick="window.location.href='?option=Course'">
                                        Редактировать
                                    </button>
                                <?php } else { ?>
                                    <button class="button-edit button-create" onclick="window.location.href='?option=DirectoryController&method=Create&folder=course'">
                                        Создать курс
                                    </button>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="popup__background">
            <div id="popup">
                <div class="popup__container">
                    <div class="popup__title">Вы действительно хотите удалить проект?</div>
                    <div class="popup__form">
                        <button class="popup__btn popup__not-delete">Не удалять</button>
                        <button class="popup__btn popup__delete">Удалить</button>
                    </div>
                </div>
            </div>
        </div>
        <script src="../js/script.js"></script>

        <script>
            let deleteButtons = document.querySelectorAll('.reboot');
            let notDelete = document.querySelector('.popup__not-delete');
            let deletes = document.querySelector('.popup__delete');
            let entryDisplay = document.querySelector('#popup__background');
            let body = document.querySelector('body');
            function toggleOverflow () {
                body.classList.toggle("overflow-hidden");
            }
            function deleteDirectory(elem) {
                entryDisplay.classList.add('display-block');
                toggleOverflow();
                deletes.addEventListener('click',function () {
                    window.location.href = '?option=DirectoryController&method=Delete&id='+ elem.parentElement.children[0].value;
                });
            }
            notDelete.onclick = function (event) {
                if (event.target === notDelete) {
                    entryDisplay.classList.remove('display-block');
                    toggleOverflow();
                }
            }
            entryDisplay.onclick = function (event) {
                if (event.target === entryDisplay) {
                    toggleOverflow();
                    entryDisplay.classList.remove('display-block');
                }
            }
        </script>
  </body>

</html>