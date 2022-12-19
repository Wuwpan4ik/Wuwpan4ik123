/*Select*/
function checkboxStatusChange() {

    let values = [];
    let checkboxes = document.querySelector(".mySelectOptions");
        let checkedCheckboxes = document.querySelectorAll('input');
        let multiselectOption =  document.querySelector("#name");
        checkedCheckboxes.forEach(item =>{

            item.addEventListener('click', function(){
                if(item.checked = true){
                    checkedCheckboxes.forEach(el =>{
                        el.checked = false
                        el.parentElement.classList.remove('active')
                        checkboxes.style.display = "none";
                    })
                    item.checked = true
                    item.parentElement.classList.add('active')
                    values = ( item.getAttribute('value'));
                }
                multiselectOption.innerText = values;
            })
        })



}

checkboxStatusChange()
function toggleCheckboxArea(onlyHide = false) {
    let selectBoxes = document.querySelectorAll(".selectBox");
    selectBoxes.forEach(item => {
        item.addEventListener('click', function () {
            let option = item.parentElement.querySelector('.mySelectOptions');
            let displayValue = option.style.display;
            if (displayValue != "flex") {
                if (onlyHide == false) {
                    option.style.display = "flex";
                    option.style.flexDirection = "column";
                }
            } else {
                option.style.display = "none";
            }
        })
    })
}
toggleCheckboxArea();