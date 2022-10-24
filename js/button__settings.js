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
let count_first_select = 1;
let count_second_select = 3;
// Поля option в форме
const names_option = {'email': "Email", 'name': "Имя", 'tel': "Телефон"};


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

function addFormSelect(elem) {
    let count_block = elem.parentElement.querySelectorAll('.form_id').length;
    let count_id = elem.parentElement.querySelectorAll('.form_id').length + 1;
    if (elem.id === 'second_do-list') {
        count_id = elem.parentElement.querySelectorAll('.form_id').length + 4;
    }
    let div = document.createElement('select');
    let inner = '';
    div.classList.add('form_id');
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
function addFormItem (elem) {
    let count = elem.parentElement.querySelectorAll('.form_id').length + 1;
    addFormSelect(elem, count);
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
        if (this.value.length > 0) {
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