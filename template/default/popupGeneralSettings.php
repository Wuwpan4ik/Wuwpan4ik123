<div id="popup__background" class="popup__general" style="align-items: center">
    <div class="popup__edit">
        <div class="popup__header-container">
            <div class="popup__header">
                <div class="popup__header-left">
                    <button class="close__btn"><img src="../../img/ArrowLeft.svg" alt="Назад"></button>
                    <h2 class="display_name">Общие настройки</h2>
                </div>
                <button type="button" onclick="save();" class="popup__edit-btn">Сохранить</button>
            </div>
        </div>
        <form id="initButton" action="/Funnel/$item_id/main_settings" method="POST" class="popup__body-container popup-wrap"  enctype="multipart/form-data">
            <input id="id_item" name="item_id" type="hidden" value="">
            <input id="button__style-color" name="button__style-color" type="hidden" value="">
            <input id="button__style-style" name="button__style-style" type="hidden" value="">
            <div class="popup__body-block" style="width: 320px;">
                <!--Прелоудер-->
                <div class="slider__item">
                    <div class="slider__video popup-video">
                    </div>
                    <div class="slider__item-info _conatiner-player" style="bottom: 7% !important;">
                        <div class="slider__item-button button-open">
                            <button type="button" class="button button-video button-click general-popup__button">Клик</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="popup__body-block editVideo">
                <div class="popup__body-item">
                    <label class="popup__subtitle" for="first_do">Шрифт для описания</label>
                    <div class="select-account social-network">
                        <div id="myMultiselect" class="multiselect">
                            <div id="mySelectLabel" class="selectBox" onclick="toggleCheckboxArea(this)">
                                <select name="desc__font" class="form-select">
                                    <option id="name">Выберите шрифт</option>
                                </select>
                                <div class="overSelect"></div>
                            </div>
                            <div class="mySelectOptions">
                                <label class="item">Roboto<input class="custom-checkbox" type="radio" value="Roboto" /><img class="checkMark" src="../img/checkMark.svg" alt=""></label>
                                <label class="item">DIN Pro<input class="custom-checkbox" type="radio" value="DINPro" /><img class="checkMark" src="../img/checkMark.svg" alt=""></label>
                                <label class="item">Akrobat<input class="custom-checkbox" type="radio" value="Akrobat" /><img class="checkMark" src="../img/checkMark.svg" alt=""></label>
                                <label class="item">TT Trailers<input class="custom-checkbox" type="radio" value="TTTrailers" /><img class="checkMark" src="../img/checkMark.svg" alt=""></label>
                                <label class="item">Montserrat<input class="custom-checkbox" type="radio" value="Montserrat" /><img class="checkMark" src="../img/checkMark.svg" alt=""></label>
                                <label class="item">Ubuntu<input class="custom-checkbox" type="radio" value="Ubuntu" /><img class="checkMark" src="../img/checkMark.svg" alt=""></label>
                                <label class="item">American Captain<input class="custom-checkbox" type="radio" value="AmericanCaptain" /><img class="checkMark" src="../img/checkMark.svg" alt=""></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="popup__body-item">
                    <label class="popup__subtitle" for="first_do">Шрифт для заголовоков</label>
                    <div class="select-account social-network heading">
                        <div id="myMultiselect" class="multiselect">
                            <div id="mySelectLabel" class="selectBox" onclick="toggleCheckboxArea(this)">
                                <select name="title__font" class="form-select">
                                    <option id="name">Выберите шрифт</option>
                                </select>
                                <div class="overSelect"></div>
                            </div>
                            <div class="mySelectOptions">
                                <label class="item">Roboto<input class="custom-checkbox" type="radio" value="Roboto" /><img class="checkMark" src="../img/checkMark.svg" alt=""></label>
                                <label class="item">DIN Pro<input class="custom-checkbox" type="radio" value="DINPro" /><img class="checkMark" src="../img/checkMark.svg" alt=""></label>
                                <label class="item">Akrobat<input class="custom-checkbox" type="radio" value="Akrobat" /><img class="checkMark" src="../img/checkMark.svg" alt=""></label>
                                <label class="item">TT Trailers<input class="custom-checkbox" type="radio" value="TTTrailers" /><img class="checkMark" src="../img/checkMark.svg" alt=""></label>
                                <label class="item">Montserrat<input class="custom-checkbox" type="radio" value="Montserrat" /><img class="checkMark" src="../img/checkMark.svg" alt=""></label>
                                <label class="item">Ubuntu<input class="custom-checkbox" type="radio" value="Ubuntu" /><img class="checkMark" src="../img/checkMark.svg" alt=""></label>
                                <label class="item">American Captain<input class="custom-checkbox" type="radio" value="AmericanCaptain" /><img class="checkMark" src="../img/checkMark.svg" alt=""></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="popup__body-item popup-styles">
                    <label class="popup__subtitle" for="first_do">Цвет кнопки</label>
                    <div class="popup-styles-colors">
                        <div style="background: linear-gradient(180deg, #5CEAF3 0%, #4AA2C8 100%); color: #34909C;" class="popup-styles-color">
                            <img src="../img/checkmark-circle.svg" alt="">
                        </div>
                        <div style="background: linear-gradient(180deg, #FF4B6E 0%, #EC234A 100%); color:  #AF1735;" class="popup-styles-color">
                            <img src="../img/checkmark-circle.svg" alt="">
                        </div>
                        <div style="background: linear-gradient(180deg, #08B395 0%, #0C977F 100%); color:  #0B705E;" class="popup-styles-color">
                            <img src="../img/checkmark-circle.svg" alt="">
                        </div>
                        <div style="background: linear-gradient(180deg, #FCA549 0%, #F39531 100%); color:  #CA7A25;" class="popup-styles-color">
                            <img src="../img/checkmark-circle.svg" alt="">
                        </div>
                        <div style="background: #5A6474; color: #374150;" class="popup-styles-color">
                            <img src="../img/checkmark-circle.svg" alt="">
                        </div>
                        <div style="background: linear-gradient(180deg, #6989FE 0%, #3C64F4 100%);color: #3D57B7" class="popup-styles-color">
                            <img src="../img/checkmark-circle.svg" alt="">
                        </div>
                        <div style="background: linear-gradient(180deg, #936DFF 0%, #8B23DD 100%); color: #62349C;" class="popup-styles-color">
                            <img src="../img/checkmark-circle.svg" alt="">
                        </div>
                        <div style="background: linear-gradient(180deg, #FFDB59 0%, #EFA12C 100%); 0%, #F39531 100%); color: #CA7A25" class="popup-styles-color">
                            <img src="../img/checkmark-circle.svg" alt="">
                        </div>
                    </div>

                    <label class=" popup__subtitle popup-styles-buttons__title" for="first_do">Стиль кнопки</label>
                    <div class="popup-styles-buttons">
                        <div class="popup-styles-button button-shadow-down"><input class="custom-radio" name="color" type="radio" id="color-green" value="green"><label for="color-green"></label><a class="general-popup__button button-shadow-down">Получить подарок</a></div>
                        <div class="popup-styles-button button-shadow-lite"><input class="custom-radio" name="color" type="radio" id="color-green" value="green"><label for="color-green"></label><a class="general-popup__button button-shadow-lite">Получить подарок</a></div>
                        <div class="popup-styles-button button-shadow-none"><input class="custom-radio" name="color" type="radio" id="color-green" value="green"><label for="color-green"></label><a class="general-popup__button">Получить подарок</a></div>
                    </div>
                </div>
                <div class="popup__body-item script">
                    <label class="popup__subtitle" for="first_do">Скрипты для HEAD</label>
                    <textarea name="head__settings" type="text" placeholder="DEFAULT"></textarea>
                </div>
                <button type="submit" hidden id="main__settings-button"></button>
            </div>
        </form>
    </div>
</div>g