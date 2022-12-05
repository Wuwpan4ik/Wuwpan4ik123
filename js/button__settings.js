const body = document.querySelector('body');
const close = document.querySelector('.close__btn');
const entryDisplay = document.querySelector('#popup__background');
const popup = document.querySelector('#popup');
const buttonChanges = document.querySelectorAll('.button__edit');
const form = document.querySelector('#popup__body-form');
const id_item = document.querySelector('#id_item');
const first_select = document.querySelector('#first_do');
const second_select = document.querySelector('#second_do');
// Поля option в форме
const names_option = {'email': "Email", 'name': "Имя", 'tel': "Телефон"};

function addPopup(input) {
    if (input === 'list') {

        let request = new XMLHttpRequest();

        if (document.querySelector('.test__block')) document.querySelector('.test__block').remove()

        let url = "/PopupController/get_popup?category=" + input + "&id=" + new URL(window.location.href).searchParams.get("id");
        let funnel_id = document.querySelector('#id_item').value;
        url += "&funnel_id=" + funnel_id;
        request.open('GET', url);

        request.setRequestHeader('Content-Type', 'application/x-www-form-url');
        request.addEventListener("readystatechange", () => {
            if (request.readyState === 4 && request.status === 200) {
                var html = document.createElement('div');
                html.classList.add('test__block');
                html.innerHTML = request.responseText;
                document.querySelector('.slider__video').after(html);
            }
        });
        request.send();
    } else if(['form', 'pay_form'].includes(input)) {
        if (document.querySelector('.test__block')) document.querySelector('.test__block').remove()
        var html = document.createElement('div');
        html.classList.add('test__block');
        let div = `<div class="overlay-bonus overlay">
                                <div class="popup__bonus popup">
                                    <div class="popup__bonus-body">`;

        div += `<div class="popup__bonus-title popup-title"></div>
            <div class="popup__bonus-text popup-text"></div>`;
        let form_inputs = '';

        form_inputs = document.querySelector('#popup__body-form-1').querySelectorAll('.form_id');

        form_inputs.forEach((elem) => {
            div += `<div class="popup__bonus-form-input input">
                                    <div class="popup__bonus-form-input-email input-img">
                                        <img src="../img/smallPlayer/`+ elem.value +`.svg" alt="">
                                    </div>
                                    <input name="`+ elem.value +`" type="text" placeholder="Ваш `+ elem.value +`">
                                </div>`;
        });

        div += `<div class="popup__bonus-form-button button-form">
            <button type="button" class="button next-lesson button__send">Оплатить</button>
        </div>`

        div += `</div>
                        </div>
                    </div>
                </div>`;
        html.innerHTML = div;
        document.querySelector('.slider__video').after(html);
    }
}

document.querySelectorAll('.form_id-1');

// Очистка Popup
function clearPopup () {
    defaultPopup(first_select);
    defaultPopup(second_select);
    document.querySelectorAll('.second_do').forEach((elem) => {
        elem.classList.remove('display-block');
    })
    document.querySelector('#popup__body-form-2').style.display = 'none';
}

function toggleOverflow () {
    body.classList.toggle("overflow-hidden");
}

function closePopup() {
    entryDisplay.classList.toggle('display-flex');
}

function defaultPopup(parent_elem){
    parent_elem.parentElement.querySelectorAll('.form_id').forEach((elem) => {
        elem.remove();
    })
    parent_elem.parentElement.querySelectorAll('.link_item').forEach((elem) => {
        elem.remove();
    })
}

async function addFormSelect(elem) {
    let count_block = elem.parentElement.querySelectorAll('.form_id').length;
    let count_id = elem.parentElement.querySelectorAll('.form_id').length + 1;
    if (elem.id === 'second_do-list') {
        count_id = elem.parentElement.querySelectorAll('.form_id').length + 4;
    }
    let div = document.createElement('select');
    let inner = '';
    div.classList.add('form_id');
    div.classList.add('input_selector');
    div.name = 'form_id-' + count_id;
    for (const [key, value] of Object.entries(names_option)) {
        inner += `<option value="${key}">${value}</option>\n`;
    }
    div.innerHTML = inner;
    elem.parentElement.children[count_block].after(div);
}

function addFormLink(elem) {
    let count = elem.parentElement.querySelectorAll('.link_item').length;
    let count_id = elem.id === 'second_do' ? 2 : 1;
    let div = document.createElement('input');
    div.placeholder = "Укажите ссылку";
    div.classList.add('videoname');
    div.classList.add('link_item');
    div.name = 'link-' + count_id;
    div.style.paddingLeft = '15px';
    if (count === 0) {
        elem.parentElement.children[1].after(div);
    }
}

//Задаются id блоков формы
async function addFormItem (elem) {
    let count = elem.parentElement.querySelectorAll('.form_id').length + 1;
    await addFormSelect(elem, count);
    if (elem.id === 'first_do-list') {
        if (['form'].includes(first_select.value)) {
            addPopup('form');
        }

        if (['pay_form'].includes(first_select.value)) {
            addPopup('pay_form');
        }
    }

    if (elem.id === 'second_do-list') {
        if (['form'].includes(second_select.value)) {
            addPopup('form', true);
        }

        if (['pay_form'].includes(second_select.value)) {
            addPopup('pay_form', true);
        }
    }

    if (count > 2) {
        elem.parentElement.querySelector('.addFormInput').classList.add('display-none');
        return false;
    }
}

function save() {
    document.getElementById('send__edit-video').click();
}

function addSecondOptions(options) {
    let div = ``;
    options.forEach((item)=> {
        div += `<option value="` + item[0] +`" selected>` + item[1] +`</option>`;
    });
    document.querySelector('#second_do').innerHTML = div;
}

function disableAfterClickBlock() {
    document.querySelector('.popup__body-after').classList.add('display-none');
    document.querySelector('.popup__button-after').classList.add('display-none');
}

function enableAfterClickBlock() {
    document.querySelector('.popup__body-after').classList.remove('display-none');
    document.querySelector('.popup__button-after').classList.remove('display-none');
}

function checkFirstSelect() {
    if (['list'].includes(first_select.value)) {
        addPopup('list');
        defaultPopup(second_select);
        addSecondOptions([['pay_form', "Форма оплаты"], ['form', 'Форма заявки']]);
        enableAfterClickBlock();
    }

    if (['list', 'next_lesson'].includes(first_select.value)) {
        document.querySelector('#popup__body-form-1').style.display = 'none';
        first_select.parentElement.querySelectorAll('.link_item').forEach((elem) => {
            elem.classList.add('display-none');
        })
        defaultPopup(second_select);
        defaultPopup(first_select);
        disableAfterClickBlock();
    } else if (['link'].includes(first_select.value)) {
        document.querySelector('#popup__body-form-1').style.display = 'none';
        addFormLink(first_select);
        defaultPopup(second_select);
        disableAfterClickBlock();
        checkSecondSelect();
    } else {
        document.querySelector('#popup__body-form-1').style.display = 'flex';
        first_select.parentElement.querySelector('.addFormInput').classList.remove('display-none');
        first_select.parentElement.querySelectorAll('.link_item').forEach((elem) => {
            elem.classList.add('display-none');
        })
        defaultPopup(first_select);
        addSecondOptions([['link', "Переход по ссылке"], ['next_lesson', 'Следующий урок'], ['file', 'Отправка файла']]);
        enableAfterClickBlock();
        checkSecondSelect();
        let form__title = document.querySelector('input[name="form__title"]');
        let form__desc = document.querySelector('input[name="form__desc"]');
        let button__send = document.querySelector('input[name="button__send"]');
        form__title.addEventListener('input', function () {
            document.querySelector('.popup-title').innerHTML = this.value;
        });
        form__desc.addEventListener('input', function () {
            document.querySelector('.popup-text').innerHTML = this.value;
        });
        button__send.addEventListener('input', function () {
            document.querySelector('.button__send').innerHTML = this.value;
        });
    }
}

function checkSecondSelect() {
    if (['list'].includes(second_select.value)) {
        addPopup('list', true);
    }

    if (['file'].includes(second_select.value)) {
        document.querySelector('#popup__body-file').classList.remove('display-none');
    } else {
        document.querySelector('#popup__body-file').classList.add('display-none');
    }

    if (!['form', 'pay_form', 'link'].includes(second_select.value)) {
        document.querySelector('#popup__body-form-2').style.display = 'none';
        second_select.parentElement.querySelectorAll('.link_item').forEach((elem) => {
            elem.classList.add('display-none');
        })
        defaultPopup(second_select);
    } else {
        document.querySelector('#popup__body-form-2').style.display = 'flex';
        second_select.parentElement.querySelector('.addFormInput').classList.remove('display-none');
        second_select.parentElement.querySelectorAll('.link_item').forEach((elem) => {
            elem.classList.add('display-none');
        })
        defaultPopup(second_select);
        if (second_select.value === 'link') {
            document.querySelector('#popup__body-form-2').style.display = 'none';
            addFormLink(second_select);
        }
    }
}

function checkBothSelect() {
    checkFirstSelect();
    checkSecondSelect();
}
document.addEventListener('DOMContentLoaded', function () {
    checkBothSelect();

    first_select.addEventListener('change', function () {
        checkFirstSelect();
    });

    second_select.addEventListener('change', function () {
        checkSecondSelect();
    });

    // Убрать После нажатия на кнопку

    buttonChanges.forEach((item) => {
        item.addEventListener('click', function () {
            document.querySelector('.popup-video').removeChild(document.querySelector('.popup-video').firstChild);
            let videos = item.parentElement.parentElement.querySelector('.media-cart-img').cloneNode(true);
            let title = item.parentElement.parentElement.querySelector('input[name="name"]').value;
            let desc = item.parentElement.parentElement.querySelector('textarea[name="description"]').value;
            let button_text = item.parentElement.parentElement.querySelector('input[name="button_text"]').value;
            if (title.length === 0) {
                title = 'Укажите заголовок';
            }
            if (desc.length === 0) {
                desc = 'Укажите описание';
            }
            if (button_text.length === 0) {
                button_text = 'Клик';
            }
            document.querySelector('.popup-video').appendChild(videos);
            document.querySelector('.slider__item-title').innerHTML = title;
            document.querySelector('.slider__item-text').innerHTML = desc;
            document.querySelector('.slider__item-text').innerHTML = desc;
            document.querySelector('#button_text').value = button_text;
            document.querySelector('.button-click').innerHTML = button_text;

            id_item.value = item.parentElement.querySelector('input[type="hidden"]').value;
            entryDisplay.classList.toggle('display-flex');
            toggleOverflow();

        });
    });

    document.querySelectorAll('.button-add-button-edit').forEach((elem) => {
        elem.addEventListener('click', function () {
            elem.classList.add('display-none');
            elem.parentElement.querySelectorAll('.button__do-block').forEach((elem) => {
                elem.classList.toggle('display-none');
            })
            document.querySelector('.popup__edit-button').classList.remove('display-none');
            // Не должно ломаться
            // let button_name = elem.parentElement.querySelector('.button_text');
            // let popup_button = document.querySelector('.button-video');
            // button_name.addEventListener('input', function () {
            //     popup_button.innerHTML = this.value;
            //     popup_button.classList.remove('display-none');
            //     document.querySelectorAll('.second_do').forEach((elem) => {
            //         elem.classList.add('display-block');
            //         if (['form', 'pay_form'].includes(second_select.value)) {
            //             document.querySelector('#popup__body-form-2').style.display = 'flex';
            //         }
            //     })
            // })
        })
    })

    close.addEventListener('click', function () {
        toggleOverflow();
        closePopup();
        clearPopup();
        defaultPopup(first_select);
        defaultPopup(second_select);
        document.querySelector('.popup__bonus').classList.remove('active');
    });

    entryDisplay.onclick = function (event) {
        if (event.target === entryDisplay) {
            toggleOverflow();
            closePopup();
            clearPopup();
            defaultPopup(first_select);
            defaultPopup(second_select);
            document.querySelector('.popup__bonus').classList.remove('active');
        }
    }
});