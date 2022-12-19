/*Select*/
function checkboxStatusChange() {

    let multiselect = document.querySelectorAll(".multiselect");

    multiselect.forEach(element =>{
        let checkboxes = element.querySelector(".mySelectOptions");
        let checkedCheckboxes = checkboxes.querySelectorAll('input');
        let multiselectOption =  element.querySelector("#name");

        checkedCheckboxes.forEach(item =>{
            let values = [];
            item.addEventListener('click', function(){
                if(item.checked = true){
                    checkedCheckboxes.forEach(el =>{
                        el.checked = false
                        el.parentElement.classList.remove('active')
                        item.parentElement.parentElement.classList.remove('display-flex');
                    })
                    item.checked = true
                    item.parentElement.classList.add('active')
                    values = (item.getAttribute('value'));
                }
                multiselectOption.innerText = values;
            })
        })
    })
}

checkboxStatusChange()

function deleteFlex() {
    document.querySelectorAll('.mySelectOptions').forEach(item => {
        item.classList.remove('display-flex')
    })
}

function toggleCheckboxArea(select) {
    if (!select.parentElement.querySelector('.mySelectOptions').classList.contains('display-flex')) {
        console.log(1)
        deleteFlex();
    }
    let option = select.parentElement.querySelector('.mySelectOptions');
    option.classList.toggle("display-flex");
    option.style.flexDirection = "column";
}
