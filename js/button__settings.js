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
// Поля option в форме
const names_option = {'email': "Email", 'name': "Имя", 'tel': "Телефон"};

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
    let count = elem.parentElement.querySelectorAll('.form_id').length + 1;
    let div = document.createElement('select');
    let inner = '';
    div.classList.add('form_id');
    div.name = 'form_id-' + count;
    for (const [key, value] of Object.entries(names_option)) {
        inner += `<option value="${key}">${value}</option>\n`;
    }
    div.innerHTML = inner;
    // form.children[count - 1].after(`<button class="addFormInput" onclick="addFormItem()" type="button"><img src="../../img/add.png"> Добавить поле</button>`);
    elem.parentElement.children[count - 1].after(div);
}

function addFormLink(elem) {
    let count = elem.parentElement.querySelectorAll('.link_item').length;
    let div = document.createElement('input');
    div.placeholder = "Укажите ссылку";
    div.classList.add('videoname');
    div.classList.add('link_item');
    div.name = 'link';
    div.style.paddingLeft = '15px';
    if (count === 0) {
        elem.parentElement.children[1].after(div);
    }
}

function addFormItem (elem) {

    let count = elem.parentElement.querySelectorAll('.form_id').length + 1;
    console.log(count)
    addFormSelect(elem);
    if (count > 2) {
        elem.parentElement.querySelector('.addFormInput').classList.add('display-none');
        return false;
    }
}

function save() {
    document.getElementById('send__edit-video').click();
}

document.addEventListener('DOMContentLoaded', function () {
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
        defaultPopup();
    });

    entryDisplay.onclick = function (event) {
        if (event.target === entryDisplay) {
            toggleOverflow();
            closePopup();
            defaultPopup();
        }
    }
});