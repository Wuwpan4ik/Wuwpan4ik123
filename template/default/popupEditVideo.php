<div id="popup__background" style="align-items: center">
    <div class="popup__edit">
        <div class="popup__header-container">
            <div class="popup__header">
                <div class="popup__header-left">
                    <button class="close__btn"><img src="../../img/ArrowLeft.svg" alt="Назад"></button>
                    <h2 class="display_name">Настройка действий</h2>
                </div>
                <button type="button" onclick="save();" class="popup__edit-btn">Сохранить</button>
            </div>
        </div>
        <form id="initButton" action="/Funnel/$item_id/settings" method="POST" class="popup__body-container popup-wrap"  enctype="multipart/form-data">
            <input id="id_item" name="item_id" type="hidden" value="">
            <div class="popup__body-block">
                <!--Прелоудер-->
                <div class="slider__item">
                    <div class="video-container">
                        <div class="slider__video popup-video">
                        </div>
                        <div class="slider__darkness">

                        </div>
                    </div>

                    <div class="slider__header _conatiner-player ">
                        <div class="slider__header-logo">
                            <div class="slider__header-logo-img">
                                <img width="48px" src="/<? echo (isset($_SESSION['user']['avatar'])  ? $_SESSION['user']['avatar'] : "uploads/ava/userAvatar.jpg") ?>" alt="">
                            </div>
                            <div class="slider__header-logo-text">
                                <?=$_SESSION["user"]["first_name"]?>
                            </div>
                        </div>
                        <div class="slider__header-views">
                            <div class="slider__header-views-img">
                                <img src="/img/smallPlayer/views.svg" alt="">
                            </div>
                            <div class="slider__header-views-count">
                                0
                            </div>
                        </div>
                    </div>
                    <div class="slider__item-info _conatiner-player">
                        <div class="slider__item-title">

                        </div>
                        <div class="slider__item-text">

                        </div>
                        <div class="slider__item-button button-open">
                            <button type="button" class="button button-video button-click">Клик</button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="editVideo" class="popup__body-block editVideo" style="color: black">

                <div class="popup__body-item">
                    <label for="first_do">Действие после нажатия:</label>
                    <div class="select-account">
                        <div id="myMultiselect" class="multiselect">
                            <div id="mySelectLabel" class="selectBox" onclick="toggleCheckboxArea(this)">
                                <select name="first_do" id="first_do" class="form-select">
                                    <option id="name" value="list" selected>Список уроков</option>
                                </select>
                                <div class="overSelect"></div>
                            </div>
                            <div class="mySelectOptions first_do_list">
                                <label class="item">Список уроков<input class="custom-checkbox" type="radio" data-value="Список уроков" value="list" /><img class="checkMark" src="../img/checkMark.svg" alt=""></label>
                                <label class="item">Форма заявки<input class="custom-checkbox" type="radio" data-value="Форма заявки" value="form" /><img class="checkMark" src="../img/checkMark.svg" alt=""></label>
                                <label class="item">Форма оплаты<input class="custom-checkbox" type="radio" data-value="Форма оплаты" value="pay_form" /><img class="checkMark" src="../img/checkMark.svg" alt=""></label>
                                <label class="item">Переход по ссылке<input class="custom-checkbox" type="radio" data-value="Переход по ссылке" value="link" /><img class="checkMark" src="../img/checkMark.svg" alt=""></label>
                                <label class="item">Открыть следующее видео<input class="custom-checkbox" type="radio" data-value="Открыть следующее видео" value="next_lesson" /><img class="checkMark" src="../img/checkMark.svg" alt=""></label>
                            </div>
                        </div>
                    </div>
                    <div class="popup__body-item popup__margin" id="popup__body-form-1">
                        <div class="popup__body-item">
                            <label for="form_id">Данные для формы:</label>
                            <input class="popup__body__input" type="text" name="form__title" placeholder="Укажите заголовок">
                            <input class="popup__body__input" type="text" name="form__desc" placeholder="Укажите описание">
                        </div>
                        <div class="popup__body-item popup__margin form__input">
                            <label for="form_id display-none">Составляющие формы:</label>
                            <button class="addFormInput" id="first_do-list" onclick="addFormItem(this)" type="button"><img src="../../img/add.png"> Добавить поле</button>
                        </div>
                    </div>
                    <!--Скрыл эту ебучую кнопку, если что возвращай обратно-->
                    <div style="margin: 20px 0;display:none;" class="button__text-container">
                        <input id="button_text" class="videoname video-desc button_text" disabled>
                    </div>
                </div>
                <div class="popup__body-item popup__button-after popup__margin">
                    <label for="button__send">Текст для кнопки формы:</label>
                    <input type="text" name="button__send" value="Отправить" class="popup__body__input">
                </div>
                <div class="popup__body-item popup__body-after popup__margin">
                    <label for="second_do">После нажатия на кнопку формы:</label>
                    <div class="select-account">
                        <div id="myMultiselect" class="multiselect">
                            <div id="mySelectLabel" class="selectBox" onclick="toggleCheckboxArea(this)">
                                <select name="second_do" id="second_do" class="form-select">
                                    <option value="next_lesson" id="name" selected>Открыть следующее видео</option>
                                </select>
                                <div class="overSelect"></div>
                            </div>
                            <div class="mySelectOptions second_do_list">
                                <label class="item">Переход по ссылке<input class="custom-checkbox" type="radio" data-value="Переход по ссылке" value="link" /><img class="checkMark" src="../img/checkMark.svg" alt=""></label>
                                <label class="item">Открыть следующее видео<input class="custom-checkbox" type="radio" data-value="Открыть следующее видео" value="next_lesson" /><img class="checkMark" src="../img/checkMark.svg" alt=""></label>
                                <label class="item">Отправка файла<input class="custom-checkbox" type="radio" data-value="Отправка файла" value="file" /><img class="checkMark" src="../img/checkMark.svg" alt=""></label>
                            </div>
                        </div>
                    </div>
                    <div class="popup__body-item display-none popup__margin" id="popup__body-file">
                        <label for="second_do-list">Файл:</label>
                        <div class="avatar" style="margin: 0">
                            <div class="avatar-body">
                                <img src="/img/saveAvatar.svg" alt="">
                                <div class="avatar-body__info" style="margin-bottom: 15px;">
                                    <span id="file-name" style="font-size: 16px;text-align: left;" class="file-box">Название файла</span>
                                    <span id="file-size" style="text-align: left;" class="file-box display-none">0 кб из доступных 5мб</span>
                                </div>
                            </div>
                            <div class="input__wrapper" style="width: 100%;">
                                <input  accept="image/img, image/jpeg, image/png" name="file" type="file" id="input__file" class="input input__file" onchange='uploadFile(this)' multiple>
                                <label for="input__file" class="input__file-button" style="width: 100%;">
                                    <span class="input__file-icon-wrapper"><img class="input__file-icon" src="/img/plus.svg"  width="25"></span>
                                    <span class="input__file-button-text">Добавить</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" id="send__edit-video" hidden="hidden"></button>
        </form>
    </div>
</div>