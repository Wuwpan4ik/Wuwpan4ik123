let inputs = document.querySelectorAll('.input_focus input');
let inputsLabel = document.querySelectorAll('.input_focus label');
let inputClear = document.querySelectorAll('.input_focus span');
let feed = document.querySelector('.feed');

function RemoveInput(i) {
    inputsLabel[i].classList.remove('activeLabel')
    inputs[i].value = "";
    inputClear[i].classList.remove('has_content')
}

function CheckInputs() {

    for (let i = 0; i < inputs.length; i++) {
        if (inputs[i].value.length > 0) {
            inputsLabel[i].classList.add('activeLabel');
            inputClear[i].classList.add('has_content');
        } else {
            inputsLabel[i].classList.remove('activeLabel');
            inputClear[i].classList.remove('has_content');
        }
        feed.addEventListener('click', () => {
            inputClear[i].classList.remove('has_content');
        })
        inputs[i].addEventListener('input', function () {

            if (inputs[i].value.length > 0) {
                inputsLabel[i].classList.add('activeLabel');
                inputClear[i].classList.add('has_content');
            } else {
                inputsLabel[i].classList.remove('activeLabel');
                inputClear[i].classList.remove('has_content');
            }
        });

        inputClear[i].onclick = () => {
            RemoveInput(i);
        }
    }
}
CheckInputs();
