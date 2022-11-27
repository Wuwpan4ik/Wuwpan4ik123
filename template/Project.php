 <html lang="ru">

  <head>
    <meta charset="utf-8">
    <title>Course Creator - Мои проекты</title>
    <link rel="stylesheet" href="/css/nullCss.css">
    <link rel="stylesheet" href="/css/lessons.css">
    <link rel="stylesheet" href="/css/main.css">
      <!--Favicon-->
      <link rel="icon" type="image/x-icon" href="/uploads/course-creator/favicon.ico">
  </head>

  <body>

        <div class="Project">

            <?php include 'default/sidebar.php'; ?>

            <div class="feed">

                <?php
                $title = "Мои проекты";
                include ('default/header.php');
                ?>

                <div class="Lessons">
                    <div class="_container">
                        <div class="media">
                            <div class="media-cart project__cart">
                                <p>Создано <?php echo $content['count_funnel']; ?> из 3</p>
                                <h3>Мои воронки</h3>
                                <img src="../img/Funnel.png" alt="">
                                <?php if ($content['count_funnel'] != 0) { ?>
                                    <button class="button-edit" onclick="window.location.href='Funnel'">
                                        Открыть воронки
                                    </button>
                                <?php } else { ?>
                                    <button class="button-edit button-create" onclick="window.location.href='/Funnel/create'">
                                        Создать воронку
                                    </button>
                                <?php } ?>
                            </div>
                            <div class="media-cart project__cart">
                                <p>Создано <?php echo $content['count_course']; ?> из 3</p>
                                <h3>Мои курсы</h3>
                                <img src="../img/Course.png" alt="">
                                <?php if ($content['count_course'] !== 0) { ?>
                                    <button class="button-edit" onclick="window.location.href='Course'">
                                        Открыть курсы
                                    </button>
                                <?php } else { ?>
                                    <button class="button-edit button-create" onclick="window.location.href='/Course/create'">
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
        <script src="/js/getNotifications.js"></script>
  </body>

</html>