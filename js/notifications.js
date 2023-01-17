function AddNotifications(title, description = '') {
    document.querySelector('.popup__notifications').classList.add('active');
    document.querySelector('.popup__notifications__title').innerHTML = title;
    document.querySelector('.popup__notifications__desc').innerHTML = description;

    // Удаление
    setTimeout(function (){
        document.querySelector('.popup__notifications').classList.remove('active');
    }, 3000)
}