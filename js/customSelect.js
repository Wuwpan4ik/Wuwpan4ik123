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
