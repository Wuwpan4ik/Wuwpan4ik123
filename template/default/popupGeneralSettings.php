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
        <form id="initButton" action="/Funnel/$item_id/settings" method="POST" class="popup__body-container"  enctype="multipart/form-data">
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
            <div class="popup__body-block editVideo">
                <div class="popup__body-item">
                    <label for="first_do">Шрифт для описания</label>
                    <div class="select-account social-network">
                        <div id="myMultiselect" class="multiselect">
                            <div id="mySelectLabel" class="selectBox" onclick="toggleCheckboxArea()">
                                <select class="form-select">
                                    <option id="name">Выберите шрифт</option>
                                </select>
                                <div class="overSelect"></div>
                            </div>
                            <div class="mySelectOptions">
                                <label class="item">Roboto<input class="custom-checkbox" type="radio" value="Roboto" /><img class="checkMark" src="../img/checkMark.svg" alt=""></label>
                                <label class="item">DIN Pro<input class="custom-checkbox" type="radio" value="DIN Pro" /><img class="checkMark" src="../img/checkMark.svg" alt=""></label>
                                <label class="item">Akrobat<input class="custom-checkbox" type="radio" value="Akrobat" /><img class="checkMark" src="../img/checkMark.svg" alt=""></label>
                                <label class="item">TT Trailers<input class="custom-checkbox" type="radio" value="TT Trailers" /><img class="checkMark" src="../img/checkMark.svg" alt=""></label>
                                <label class="item">Montserrat<input class="custom-checkbox" type="radio" value="Montserrat" /><img class="checkMark" src="../img/checkMark.svg" alt=""></label>
                                <label class="item">Ubuntu<input class="custom-checkbox" type="radio" value="Ubuntu" /><img class="checkMark" src="../img/checkMark.svg" alt=""></label>
                                <label class="item">American Captain<input class="custom-checkbox" type="radio" value="American Captain" /><img class="checkMark" src="../img/checkMark.svg" alt=""></label>
                           
                            </div>
                        </div>
                    </div>
            </div>
                <div class="popup__body-item">
                    <label for="first_do">Шрифт для заголовоков</label>
                    <div class="select-account social-network">
                        <div id="myMultiselect" class="multiselect">
                            <div id="mySelectLabel" class="selectBox" onclick="toggleCheckboxArea()">
                                <select class="form-select">
                                    <option id="name">Выберите шрифт</option>
                                </select>
                                <div class="overSelect"></div>
                            </div>
                            <div class="mySelectOptions">
                                <label class="item">Roboto<input class="custom-checkbox" type="radio" value="Roboto" /><img class="checkMark" src="../img/checkMark.svg" alt=""></label>
                                <label class="item">DIN Pro<input class="custom-checkbox" type="radio" value="DIN Pro" /><img class="checkMark" src="../img/checkMark.svg" alt=""></label>
                                <label class="item">Akrobat<input class="custom-checkbox" type="radio" value="Akrobat" /><img class="checkMark" src="../img/checkMark.svg" alt=""></label>
                                <label class="item">TT Trailers<input class="custom-checkbox" type="radio" value="TT Trailers" /><img class="checkMark" src="../img/checkMark.svg" alt=""></label>
                                <label class="item">Montserrat<input class="custom-checkbox" type="radio" value="Montserrat" /><img class="checkMark" src="../img/checkMark.svg" alt=""></label>
                                <label class="item">Ubuntu<input class="custom-checkbox" type="radio" value="Ubuntu" /><img class="checkMark" src="../img/checkMark.svg" alt=""></label>
                                <label class="item">American Captain<input class="custom-checkbox" type="radio" value="American Captain" /><img class="checkMark" src="../img/checkMark.svg" alt=""></label>

                            </div>
                        </div>
                    </div>
                </div>
        </form>
    </div>
</div>