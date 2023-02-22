let inputs = document.querySelectorAll('.input_focus input'),
    inputsLabel = document.querySelectorAll('.input_focus label'),
    inputClear = document.querySelectorAll('.input_focus span'),
    numberInputs = document.querySelectorAll('input[type="number"]');

numberInputs.forEach((item)=>{
    item.addEventListener('input', function(){
        item.value = item.value.replace(/[^\d]/g,'');
    })
})

function RemoveInput(i) {
    inputsLabel[i].classList.remove('activeLabel')
    inputs[i].value = "";
    inputClear[i].classList.remove('has_content')
}



function CheckInputs() {
    for (let i = 0; i < inputs.length; i++) {
        if(inputs[i].value.length > 0) {
            inputsLabel[i].classList.add('activeLabel');
            inputClear[i].classList.add('has_content');
        } else {
            inputsLabel[i].classList.remove('activeLabel');
            inputClear[i].classList.remove('has_content');
        }
        inputs[i].addEventListener('focusin', function(){
            inputsLabel[i].classList.add('activeLabel');
        })
        inputs[i].addEventListener('focusout', function(){
            if(inputsLabel[i].classList.contains('activeLabel') && inputs[i].value != ""){
                return;
            }else{
                inputsLabel[i].classList.remove('activeLabel');
            }
        })
        inputs[i].addEventListener('input', function () {
            if(inputs[i].value.length > 0) {
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


