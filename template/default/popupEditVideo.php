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
        <form id="initButton" action="/Funnel/$item_id/settings" method="POST" class="popup__body-container">
            <input id="id_item" name="item_id" type="hidden" value="">
            <div class="popup__body-block" style="width: 320px;">
                <!--Прелоудер-->
                <div class="slider__item">
                    <div class="slider__video popup-video">
                    </div>
                    <div class="slider__header _conatiner-player ">
                        <div class="slider__header-logo">
                            <div class="slider__header-logo-img">
                                <img width="48px" src="/<?=$_SESSION["user"]['avatar']?>" alt="">
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
                                126
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
            <div class="popup__body-block">
                <div class="popup__body-item">
                    <label for="first_do">Дейсвтие после нажатия:</label>
                    <select name="first_do" id="first_do">
                        <option value="list" selected>Список уроков</option>
                        <option value="form">Форма заявки</option>
                        <option value="pay_form">Форма оплаты</option>
                        <option value="link">Переход по ссылке</option>
                        <option value="next_lesson">Открыть следующий урок</option>
                    </select>
                    <div class="popup__body-item" id="popup__body-form-1">
                        <label for="form_id display-none">Составляющие формы:</label>
                        <button class="addFormInput" id="first_do-list" onclick="addFormItem(this)" type="button"><img src="../../img/add.png"> Добавить поле</button>
                    </div>
                    <label>Текст для кнопки:</label>
                    <input id="button_text" class="videoname video-desc button_text" disabled>
                </div>
                <div class="popup__body-item">
                    <label for="second_do">После нажатия на кнопку:</label>
                    <select name="second_do" id="second_do">
                        <option value="form" selected>Отправить файл</option>
                        <option value="pay_form">Форма оплаты</option>
                        <option value="link">Переход по ссылке</option>
                        <option value="next_lesson">Открыть следующий урок</option>
                        <option value="file">Отправить файл</option>
                    </select>
                    <div class="popup__body-item display-none" id="popup__body-form-2">
                        <label for="form_id">Составляющие формы:</label>
                        <button class="addFormInput" id="second_do-list" onclick="addFormItem(this)" type="button"><img src="/img/add.png"> Добавить поле</button>
                    </div>
                    <div class="popup__body-item" id="popup__body-file">
                        <label for="second_do-list">Файл:</label>
                        <div class="avatar">
                            <div class="avatar-body">
                                <img src="/img/saveAvatar.svg" alt="">
                                <div class="avatar-body__info">
                                    <span id="file-name" class="file-box">Название файла</span>
                                    <span id="file-size" class="file-box">0 кб из доступных 5мб</span>
                                </div>

                            </div>


                            <div class="input__wrapper">
                                <input  accept="image/img, image/jpeg, image/png" name="file" type="file" id="input__file" class="input input__file" onchange='uploadFile(this)' multiple>
                                <label for="input__file" class="input__file-button">

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