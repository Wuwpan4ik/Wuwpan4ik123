/*Select*/
function checkboxStatusChange() {

    let multiselect = document.querySelectorAll(".multiselect");

    multiselect.forEach(element =>{
        let checkboxes = element.querySelector(".mySelectOptions");
        let checkedCheckboxes = checkboxes.querySelectorAll('.custom-checkbox');
        let multiselectOption =  element.querySelector("#name");



        checkedCheckboxes.forEach(item =>{
            let title = document.querySelectorAll('.slider__item-title');
            let text = document.querySelectorAll('.slider__item-text');

            let values = [];
            item.addEventListener('click', function(){
                if(item.checked = true){
                    checkedCheckboxes.forEach(el =>{
                        el.checked = false
                        el.parentElement.classList.remove('active')
                        item.parentElement.parentElement.classList.remove('display-flex');

                    })
                    item.checked = true
                    title.forEach(t=>{
                        t.style.fontFamily = item.parentElement.style.fontFamily;
                        t.style.fontWeight = '900px';
                    })
                    item.parentElement.classList.add('active')
                    values = (item.getAttribute('value'));

                }
                multiselectOption.innerText = values;
                multiselectOption.value = values;
                multiselectOption.selected = true;
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
        deleteFlex();
    }
    let option = select.parentElement.querySelector('.mySelectOptions');
    option.classList.toggle("display-flex");
    option.style.flexDirection = "column";
}
