<div id="popup__background">
    <div id="popup" class="popup__edit">
        <div class="popup__header-container">
            <div class="popup__header">
                <div class="popup__header-left">
                    <button class="close__btn"><img src="../../img/ArrowLeft.svg" alt="Назад"></button>
                    <h2 class="display_name">Настройка действий</h2>
                </div>
                <button type="button" class="popup__edit-btn">Сохранить</button>
            </div>
        </div>
        <form id="initButton" action="?option=VideoController&method=initVideoButton" method="POST" class="popup__body-container">
            <input id="id_item" name="id_item" type="hidden" value="">
            <div class="popup__body-block">
                <div class="popup__body-item">
                    <label for="first_do">Дейсвтие после просмотра:</label>
                    <select name="first_do" id="first_do">
                        <option value="list" selected>Список уроков</option>
                        <option value="form">Форма заявки</option>
                    </select>
                </div>
                <div class="popup__body-item">
                    <label for="third_do">После нажатия на кнопку:</label>
                    <select name="third_do" id="third_do">
                        <option value="list" selected>Список уроков</option>
                        <option value="form">Форма заявки</option>
                    </select>
                </div>
            </div>
            <div class="popup__body-block">
                <div class="popup__body-item" id="popup__body-form">
                    <label for="form_id">Составляющие формы:</label>
                    <select class="form_id" name="form_id-1">
                        <option value="email" selected>Email</option>
                        <option value="name">Имя</option>
                        <option value="tel">Телефон</option>
                    </select>
                    <button class="addFormInput" onclick="addFormItem()" type="button"><img src="../../img/add.png"> Добавить поле</button>
                </div>
                <div class="popup__body-item">
                    <label for="second_do">После нажатия на кнопку:</label>
                    <select name="second_do" id="second_do">
                        <option value="list" selected>Список уроков</option>
                        <option value="form">Форма заявки</option>
                    </select>
                </div>
            </div>

        </form>
    </div>
</div>