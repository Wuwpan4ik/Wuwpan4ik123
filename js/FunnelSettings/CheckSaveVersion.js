function getFunnelPopup(funnel_content_id) {
    let request = new XMLHttpRequest();

    let url = "/Funnel/"+ funnel_content_id +"/getFunnelPopup";

    request.open('GET', url);

    request.setRequestHeader('Content-Type', 'application/x-www-form-url');
    request.addEventListener("readystatechange", () => {
    if (request.readyState === 4 && request.status === 200) {
    let popup = JSON.parse(JSON.parse(request.responseText))
    if (popup) {

        // first_do
        let option_1;
        defaultPopup(document.querySelector('#first_do'))
        if (popup['first_do']) {
            option_1 = Object.keys(popup['first_do'])[0];

            let title__block = document.querySelector('.first_do_list').querySelector('input[value="'+ option_1 +'"]');
            title__block.click();
            title__block.classList.add('active')

            switch (option_1) {
                case 'pay_form':
                case 'form':
                    if (popup['form__title']) {
                        document.querySelector('input[name="form__title"]').value = popup['form__title'];
                    }

                    if (popup['form__desc']) {
                        document.querySelector('input[name="form__desc"]').value = popup['form__desc'];
                    }

                    if (popup['button_text']) {
                        document.querySelector('input[name="button__send"]').value = popup['button_text'];
                    }
                    let div = document.querySelector('#first_do-list');
                    if (option_1 === 'form') {
                        for (let item of popup['first_do']['form']) {
                            addFormItem(div, item);
                        }
                    } else if (option_1 === 'pay_form') {
                        for (let item of popup['first_do']['pay_form']) {
                            addFormItem(div, item);
                        }
                    }
                    break;

                case 'link':
                    addFormLink(document.querySelector('#first_do'))
                    if (popup['first_do']['open_in_new']) {
                        document.querySelector('input[name="open_new_window"]').checked = true;
                    }
                    break;
            }


        if (popup['first_do']['link']) {
            document.querySelector('input[name="link-1"]').value = popup['first_do']['link']
        }

        checkFirstSelect()

        // second_do

        let option_2;
        let second_do;
        let option_item_2;

        if (popup['second_do'] != null) {
        second_do = document.getElementById('second_do');
        option_2 = Object.keys(popup['second_do'])[0];
    } else {
        second_do = document.getElementById('second_do');
        option_2 = second_do.value;
    }
        option_item_2 = second_do.querySelector('option[value="' + option_2 + '"]')
        option_item_2.selected = true;
        option_item_2.setAttribute('selected', 'selected')


        switch (option_2) {
        case 'file':
            document.querySelector('#file-name').innerHTML = popup['second_do']['file'].toString().match(/.*\/(.+?)\./)[1];
            break;
    }

        defaultPopup(second_do)

        switch (option_2) {
        case 'link':
        addFormLink(document.querySelector('#second_do'))
        document.querySelector('input[name="link-2"]').value = popup['second_do']['link'];
        if (popup['second_do']['open_in_new']) {
        document.querySelector('input[name="open_new_window"]').checked = true;
    }
        break;
    }
        // /second_do
        let elem = document.querySelector('#first_do-list')
        let count = document.querySelectorAll('.form-select__container').length;
        if (count > 2) {
        if (elem.parentElement.querySelector('.addFormInput')) {
        elem.parentElement.querySelector('.addFormInput').classList.add('display-none');
    }
        return false;
    }

        setTimeout(function (){
        if (popup['form__title']) {
        let form__title = document.querySelector('.popup-title');
        form__title.innerHTML = popup['form__title'];
    }
        if (popup['form__desc']) {
        let form__desc = document.querySelector('.popup-text');
        form__desc.innerHTML = popup['form__desc'];
    }
    }, 400)
    }
    }
    }
    })
    request.send();
}