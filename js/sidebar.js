let sidebar = document.querySelector('.nav');
let openSidebar = document.querySelector('.open-sidebar');

openSidebar.addEventListener('click', ()=>{
    sidebar.classList.toggle('active')
})
