const body = document.querySelector('body');
const close = document.querySelector('.close__btn');
const entryDisplay = document.querySelector('#popup__background');
const popup = document.querySelector('#popup');
const buttonChanges = document.querySelectorAll('.button__edit');
const form = document.querySelector('#popup__body-form');
const id_item = document.querySelector('#id_item');
const first_select = document.querySelector('#first_do');
const second_select = document.querySelector('#second_do');
const button_name = document.querySelector('#video_name');
const popup_button = document.querySelector('.button-video');
let count_first_select = 1;
let count_second_select = 3;
// Поля option в форме
const names_option = {'email': "Email", 'name': "Имя", 'tel': "Телефон"};

function addPopup(input, button = false) {
    if (input === 'list') {

        let request = new XMLHttpRequest();

        let class_name = 'video';
        if (button) {
            class_name = 'button';
        }
        if (document.querySelector('.test__block-' + class_name)) document.querySelector('.test__block-'+ class_name).remove()

        let url = "?option=PopupController&method=get_popup&category=" + input + "&id=" + new URL(window.location.href).searchParams.get("id");
        let funnel_id = document.querySelector('#id_item').value;
        url += "&funnel_id=" + funnel_id;
        request.open('GET', url);

        request.setRequestHeader('Content-Type', 'application/x-www-form-url');
        request.addEventListener("readystatechange", () => {
            if (request.readyState === 4 && request.status === 200) {
                var html = document.createElement('div');
                html.classList.add('test__block');
                html.classList.add('test__block-' + class_name);
                html.innerHTML = request.responseText;
                document.querySelector('.slider__video').after(html);
            }
        });
        request.send();
    } else if(['form', 'pay_form'].includes(input)) {
        let class_name = 'video';
        if (button) {
            class_name = 'button';
        }
        if (document.querySelector('.test__block-' + class_name)) document.querySelector('.test__block-'+ class_name).remove()
        var html = document.createElement('div');
        html.classList.add('test__block');
        html.classList.add('test__block-' + class_name);
        let div = `<div class="overlay-bonus overlay overlay-`+ class_name +`">
                                <div class="popup__bonus  popup popup-`+ class_name +`">
                                    <div class="popup__bonus-body">`;

        if (input === 'form') {
                div += `<div class="popup__bonus-title  popup-title">Введите ваш email что бы продолжить просмотр</div>
                                <div class="popup__bonus-text popup-text"><span> Бонус:</span> получите книгу - Тысяча способов научиться решать проблемы самостоятельно!</div>`;
        } else {
            div += `<div class="popup__bonus-title  popup-title">Введите данные и перейдите к оплате, чтобы продолжить
                просмотр</div> <div class="popup__bonus-form">`
        }
        let form_inputs = '';

        if (class_name === 'video') {
            form_inputs = document.querySelector('#popup__body-form-1').querySelectorAll('.form_id');
        } else {
            form_inputs = document.querySelector('#popup__body-form-2').querySelectorAll('.form_id');
        }

        form_inputs.forEach((elem) => {
            div += `<div class="popup__bonus-form-input input">
                                    <div class="popup__bonus-form-input-email input-img">
                                        <img src="../img/smallPlayer/`+ elem.value +`.svg" alt="">
                                    </div>
                                    <input name="`+ elem.value +`" type="text" placeholder="Ваш `+ elem.value +`">
                                </div>`;
        });

        if (input === 'form') {
            div += `<div class="popup__bonus-form-button button-form">
                <button class="button next-lesson ">Получить подарок</button>
            </div>`
            } else {
            div += `<div class="popup__bonus-form-button button-form">
                <button class="button next-lesson">Оплатить</button>
            </div>`

        }

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
    button_name.value = '';
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
        elem.parentElement.appendChild(div);
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

document.addEventListener('DOMContentLoaded', function () {
    if (!['form', 'pay_form'].includes(first_select.value)) {
        document.querySelector('#popup__body-form-1').style.display = 'none';
    }

    first_select.addEventListener('change', function () {
        if (['list'].includes(first_select.value)) {
            addPopup('list');
        }

        if (!['form', 'pay_form', 'link'].includes(first_select.value)) {
            document.querySelector('#popup__body-form-1').style.display = 'none';
            first_select.parentElement.querySelectorAll('.link_item').forEach((elem) => {
                elem.classList.add('display-none');
            })
            defaultPopup(first_select);
        } else {
            document.querySelector('#popup__body-form-1').style.display = 'flex';
            first_select.parentElement.querySelector('.addFormInput').classList.remove('display-none');
            first_select.parentElement.querySelectorAll('.link_item').forEach((elem) => {
                elem.classList.add('display-none');
            })
            defaultPopup(first_select);
            if (first_select.value === 'link') {
                document.querySelector('#popup__body-form-1').style.display = 'none';
                addFormLink(first_select);
            }
        }
    });

    second_select.addEventListener('change', function () {
        if (['list'].includes(second_select.value)) {
            console.log('list')
            addPopup('list', true);
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
    });

    // Убрать После нажатия на кнопку
    button_name.addEventListener('input', function () {
        popup_button.innerHTML = this.value;
        if (this.value.length === 0) {
            popup_button.classList.add('display-none');
        }
        if (this.value.length > 0) {
            popup_button.classList.remove('display-none');
            document.querySelectorAll('.second_do').forEach((elem) => {
                elem.classList.add('display-block');
                if (['form', 'pay_form'].includes(second_select.value)) {
                    document.querySelector('#popup__body-form-2').style.display = 'flex';
                }
            })
        } else {
            document.querySelectorAll('.second_do').forEach((elem) => {
                defaultPopup(second_select)
                document.querySelector('#popup__body-form-2').style.display = 'none';
                elem.classList.remove('display-block');
            })
        }
    })

    buttonChanges.forEach((item) => {
        item.addEventListener('click', function () {
            document.querySelector('.popup-video').removeChild(document.querySelector('.popup-video').firstChild);
            let videos = item.parentElement.parentElement.querySelector('.media-cart-img').cloneNode(true);
            let title = item.parentElement.parentElement.querySelector('input[name="name"]').value;
            let desc = item.parentElement.parentElement.querySelector('input[name="description"]').value;
            if (title.length === 0) {
                title = 'Укажите заголовок';
            }
            if (desc.length === 0) {
                desc = 'Укажите описание';
            }
            document.querySelector('.popup-video').appendChild(videos);
            document.querySelector('.slider__item-title').innerHTML = title;
            document.querySelector('.slider__item-text').innerHTML = desc;

            id_item.value = item.parentElement.querySelector('input[type="hidden"]').value;
            entryDisplay.classList.toggle('display-flex');
            toggleOverflow();

        });
    });

    close.addEventListener('click', function () {
        toggleOverflow();
        closePopup();
        clearPopup();
    });

    entryDisplay.onclick = function (event) {
        if (event.target === entryDisplay) {
            toggleOverflow();
            closePopup();
            clearPopup();
        }
    }
});