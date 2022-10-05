const body = document.querySelector('body');
const close = document.querySelector('.close__btn');
const entryDisplay = document.querySelector('#popup__background');
const popup = document.querySelector('#popup');
const buttonChanges = document.querySelectorAll('.button__edit');
const form = document.querySelector('#popup__body-form');

function toggleOverflow () {
    body.classList.toggle("overflow-hidden");
}

buttonChanges.forEach((item) => {
    item.addEventListener('click', function () {
        entryDisplay.classList.toggle('display-block');
        toggleOverflow();
    });
});

close.addEventListener('click', function () {
    entryDisplay.classList.toggle('display-block');
    toggleOverflow();
});

entryDisplay.onclick = function (event) {
    if (event.target === entryDisplay) {
        toggleOverflow();
        entryDisplay.classList.remove('display-block');
    }
}

function addFormItem () {
    let count = document.querySelectorAll('.form_id').length + 1;
    let div = document.createElement('select');
    div.classList.add('form_id');
    div.name = 'form_id-' + count;
    div.innerHTML = '<option value="email" selected>Email</option>\n' +
        '                        <option value="name">Имя</option>\n' +
        '                        <option value="tel">Телефон</option>'

    form.children[count - 1пше].after(div);
    if (count > 2) {
        document.querySelector('.addFormInput').classList.add('display-none');
        return false;
    }
}