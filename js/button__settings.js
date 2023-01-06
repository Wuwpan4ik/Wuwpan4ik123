const body = document.querySelector('body');
const popup = document.querySelector('#popup');
const buttonChanges = document.querySelectorAll('.button__edit');
const form = document.querySelector('#popup__body-form');
const id_item = document.querySelector('#id_item');
const first_select = document.querySelector('#first_do');
const second_select = document.querySelector('#second_do');
// Поля option в форме
const names_option = {'email': "Ваша почта", 'name': "Ваше имя", 'tel': "Ваш номер телефон"};

// Сохранение / закрытие
function save() {
    document.getElementById('send__edit-video').click();
}

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
            switch (elem.value) {
                case 'email':
                    var val = 'Ваша почта'
                    break;
                case 'name':
                    var val = 'Ваше имя'
                    break;
                case 'tel':
                    var val = 'Ваш номер телефона'
                    break;
            }
            div += `<div class="popup__bonus-form-input input">
                    <div class="popup__bonus-form-input-email input-img">
                        <img src="../img/smallPlayer/`+ elem.value +`.svg" alt="">
                    </div>
                    <input name="`+ elem.value +`" type="text" placeholder="`+ val +`">
                </div>`;
        });

        div += `<div class="popup__bonus-form-button button-form">
            <button type="button" class="button next-lesson button__send">Отправить</button>
        </div>`

        div += `</div>
                        </div>
                    </div>
                </div>`;
        html.innerHTML = div;
        document.querySelector('.slider__video').after(html);
    }
}

// Очистка Popup
function clearPopup () {
    defaultPopup(first_select);
    defaultPopup(second_select);
    document.querySelectorAll('.second_do').forEach((elem) => {
        elem.classList.remove('display-block');
    })
    document.querySelector('#popup__body-form-2').style.display = 'none';
    document.querySelector('input[name="form__title"]').value = '';
    document.querySelector('input[name="form__desc"]').value = '';
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
    document.querySelector('#first_do-list').classList.remove('display-none');
}

function removeSelect(elem) {

    let count = elem.parentElement.parentElement.querySelectorAll('.form-select__container').length;
    elem.parentElement.remove();
    if (count <=3 ) {
        document.querySelector('.addFormInput').classList.remove('display-none');
        return false;
    }
}

async function addFormSelect(elem, name) {
    let count_block = elem.parentElement.querySelectorAll('.form_id').length;
    let count_id = elem.parentElement.querySelectorAll('.form_id').length + 1;
    if (elem.id === 'second_do-list') {
        count_id = elem.parentElement.querySelectorAll('.form_id').length + 4;
    }
    let div_container = document.createElement('div');
    div_container.style.position = 'relative';
    div_container.classList.add("form-select__container");
    let div = document.createElement('select');
    let button = `<button id="delete_selectForm" style="display: flex;justify-content: center;align-items: center;position: absolute; bottom: 6px; right: 10px; z-index: 100;" onclick="removeSelect(this)"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M8 14C8 14.55 7.55 15 7 15C6.45 15 6 14.55 6 14V10C6 9.45 6.45 9 7 9C7.55 9 8 9.45 8 10V14ZM14 14C14 14.55 13.55 15 13 15C12.45 15 12 14.55 12 14V10C12 9.45 12.45 9 13 9C13.55 9 14 9.45 14 10V14ZM16 17C16 17.551 15.552 18 15 18H5C4.448 18 4 17.551 4 17V6H16V17ZM8 2.328C8 2.173 8.214 2 8.5 2H11.5C11.786 2 12 2.173 12 2.328V4H8V2.328ZM19 4H18H14V2.328C14 1.044 12.879 0 11.5 0H8.5C7.121 0 6 1.044 6 2.328V4H2H1C0.45 4 0 4.45 0 5C0 5.55 0.45 6 1 6H2V17C2 18.654 3.346 20 5 20H15C16.654 20 18 18.654 18 17V6H19C19.55 6 20 5.55 20 5C20 4.45 19.55 4 19 4Z" fill="#757D8A"/>
</svg>
</button>`;
    let inner = '';
    div.classList.add('form_id');
    div.classList.add('input_selector');
    div.name = 'form_id-' + count_id;
    for (const [key, value] of Object.entries(names_option)) {
        let selected;
        if (name === key) {
            selected = "selected";
        }

        inner += `<option style="position: relative; " ` + selected +` value="${key}">${value}</option>`;
    }
    div.innerHTML = inner;
    div_container.appendChild(div);
    div_container.innerHTML += button;
    elem.parentElement.children[count_block].after(div_container);
    document.querySelectorAll('.input_selector').forEach(function (){
        this.addEventListener('change', function (){
            addPopup('form');
            checkFormInputs();
        })
    })
}

function addFormLink(elem) {
    let count = elem.parentElement.querySelectorAll('.link_item').length;
    let count_id = elem.id === 'second_do' ? 2 : 1;
    let div = document.createElement('input');
    div.placeholder = "Переход по ссылке";
    div.classList.add('videoname');
    div.classList.add('link_item');
    div.name = 'link-' + count_id;
    div.style.paddingLeft = '15px';
    div.style.marginTop = '20px';
    if (count === 0) {
        elem.parentElement.children[1].after(div);
    }
}

function addCheckbox(elem) {
    let checkbox = document.createElement('div');
    checkbox.classList.add("checkbox__wrapper")
    let switch_box = document.createElement('div');
    switch_box.classList.add("switch_box")
    switch_box.classList.add("box_1")
    switch_box.style.color = '#5A6474'
    let input = document.createElement('input');
    input.name = 'open_new_window';
    input.type = 'checkbox';
    input.classList.add("switch_1")
    input.value = 'open_new_window';
    switch_box.appendChild(input)
    checkbox.appendChild(switch_box)
    let text = document.createElement('div');
    text.innerHTML = 'Открывать в новом окне';
    switch_box.appendChild(text)
    elem.parentElement.children[2].after(checkbox);
    console.log(elem.parentElement)
}

//Добавление option
async function addFormItem (elem, name = null) {
    let count = elem.parentElement.querySelectorAll('.form_id').length + 1;
    await addFormSelect(elem, name);
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

function addSecondOptions(options) {
    let div = ``;
    options.forEach((item)=> {
        div += `<option value="` + item[0] +`">` + item[1] +`</option>`;
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
        initListCourse();
    }

    switch (first_select.value) {
        case 'list':
        case 'next_lesson': {
            document.querySelector('#popup__body-form-1').style.display = 'none';
            first_select.parentElement.querySelectorAll('.link_item').forEach((elem) => {
                elem.classList.add('display-none');
            })
            defaultPopup(second_select);
            defaultPopup(first_select);
            disableAfterClickBlock();
            break;
        }

        case 'link': {
            document.querySelector('#popup__body-form-1').style.display = 'none';
            addCheckbox(document.querySelector('#first_do'));
            addFormLink(first_select);
            defaultPopup(second_select);
            disableAfterClickBlock();
            checkSecondSelect();
            break;
        }

        case 'form':
        case 'pay_form': {
            if ('form' === first_select.value) {
                addPopup('form');
            } else if ('pay_form' === first_select.value) {
                addPopup('pay_form');
            }
            document.querySelector('#popup__body-form-1').style.display = 'flex';
            first_select.parentElement.querySelector('.addFormInput').classList.remove('display-none');
            first_select.parentElement.querySelectorAll('.link_item').forEach((elem) => {
                elem.classList.add('display-none');
            })
            defaultPopup(first_select);
            addSecondOptions([['link', "Переход по ссылке"], ['next_lesson', 'Открыть следующее видео'], ['file', 'Отправка файла']]);
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
            break;
        }
    }
}

function checkFormInputs() {
    document.querySelector('.popup-title').innerHTML = document.querySelector('input[name="form__title"]').value;
    document.querySelector('.popup-text').innerHTML = document.querySelector('input[name="form__desc"]').value;
    document.querySelector('.button__send').innerHTML = document.querySelector('input[name="button__send"]').value;
}

function checkSecondSelect() {
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
            if (document.querySelector('.checkbox__wrapper')) {
                document.querySelector('.checkbox__wrapper').classList.remove('display-none');
            }
        }
    }

    switch (second_select.value) {
        case 'list': {
            addPopup('list', true);
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
            document.querySelector('#initButton').action = "/Funnel/"+ item.parentElement.querySelector('input[type="hidden"]').value +"/settings"
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
        })
    })
});
