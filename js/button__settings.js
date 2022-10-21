const body = document.querySelector('body');
const close = document.querySelector('.close__btn');
const entryDisplay = document.querySelector('#popup__background');
const popup = document.querySelector('#popup');
const buttonChanges = document.querySelectorAll('.button__edit');
const form = document.querySelector('#popup__body-form');
const id_item = document.querySelector('#id_item');
const first_select = document.querySelector('#first_do');
// Поля option в форме
const names_option = {'email': "Email", 'name': "Имя", 'tel': "Телефон"};

function toggleOverflow () {
    body.classList.toggle("overflow-hidden");
}

function closePopup() {
    entryDisplay.classList.toggle('display-block');
}

function defaultPopup(){
    document.querySelectorAll('.form_id').forEach((elem) => {
        elem.remove();
    })
    addFormSelect();
    document.querySelector('.addFormInput').classList.remove('display-none');
}

function addFormSelect() {
    let count = document.querySelectorAll('.form_id').length + 1;
    let div = document.createElement('select');
    let inner = '';
    div.classList.add('form_id');
    div.name = 'form_id-' + count;
    for (const [key, value] of Object.entries(names_option)) {
        inner += `<option value="${key}">${value}</option>\n`;
    }
    div.innerHTML = inner;
    form.children[count - 1].after(div);
}

function addFormItem () {

    let count = document.querySelectorAll('.form_id').length + 1;

    addFormSelect();

    if (count > 2) {
        document.querySelector('.addFormInput').classList.add('display-none');
        return false;
    }
}

function save() {
    document.getElementById('send__edit-video').click();
}
document.addEventListener('DOMContentLoaded', function () {
    if (first_select.value !== "form") {
        document.querySelector('#popup__body-form').style.display = 'none';
    } else {
        document.querySelector('#popup__body-form').style.display = 'flex';
    }

    first_select.addEventListener('change', function () {
        if (first_select.value !== "form") {
            document.querySelector('#popup__body-form').style.display = 'none';
        } else {
            document.querySelector('#popup__body-form').style.display = 'flex';
        }
    });

    buttonChanges.forEach((item) => {
        item.addEventListener('click', function () {
            id_item.value = item.parentElement.querySelector('input[type="hidden"]').value;
            entryDisplay.classList.toggle('display-block');
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