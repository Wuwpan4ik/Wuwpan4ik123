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
    document.querySelectorAll('.link_item').forEach((elem) => {
        elem.remove();
    })
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
    // form.children[count - 1].after(`<button class="addFormInput" onclick="addFormItem()" type="button"><img src="../../img/add.png"> Добавить поле</button>`);
    form.children[count - 1].after(div);
}

function addFormLink() {
    let div = document.createElement('input');
    div.placeholder = "Укажите ссылку";
    div.classList.add('videoname');
    div.classList.add('link_item');
    div.style.paddingLeft = '15px';
    form.children[1].after(div);
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
    if (!['form', 'pay_form', 'link'].includes(first_select.value)) {
        document.querySelector('#popup__body-form').style.display = 'none';
        defaultPopup();
    } else {
        document.querySelector('#popup__body-form').style.display = 'flex';
        defaultPopup();
        if (first_select.value === 'link') {
            document.querySelector('.addFormInput').classList.add('display-none');
            addFormLink();
        }
    }

    first_select.addEventListener('change', function () {
        if (!['form', 'pay_form', 'link'].includes(first_select.value)) {
            document.querySelector('#popup__body-form').style.display = 'none';
            defaultPopup();
        } else {
            document.querySelector('#popup__body-form').style.display = 'flex';
            defaultPopup();
            if (first_select.value === 'link') {
                document.querySelector('.addFormInput').classList.add('display-none');
                addFormLink();
            }
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