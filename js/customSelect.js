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
    let checkboxes = document.querySelectorAll(".mySelectOptions");
    checkboxes.forEach( item => {
        const displayValue = item.style.display;
        if (displayValue != "flex") {
            if (onlyHide == false) {
                item.style.display = "flex";
                item.style.flexDirection = "column";
            }
        } else {
            item.style.display = "none";
        }
    })

}