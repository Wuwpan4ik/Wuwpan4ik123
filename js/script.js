document.addEventListener("click", function (is_close) {let video = document.querySelectorAll('.slider__video-item');const openPopUpBonus = document.querySelector('.slider__item-button');const overlayBonus = document.querySelector('.overlay-bonus');const popUpBonus = document.querySelector('.popup__bonus');const pauseVideo = document.querySelector('.pause__video');const popUpAllLessons = document.querySelector('.popup__allLessons');const openPopUpAllLessons = document.querySelector('.allLessons-button');const overlayAllLessons = document.querySelector('.overlay-allLessons');const closeUpAllLessons = document.querySelector('.button-notBuy');const popUpBuy =  document.querySelector('.popup__buy');const openPopupBuy =  document.querySelector('.button-buy');const backPopUpBuy = document.querySelector('.button-back');openPopUpBonus.addEventListener('click', () => {    overlayBonus.classList.add('overlay-active');    pauseVideo.classList.add('pauseVideo-active');    Array.from(video).forEach((elem)=> {        elem.pause();    })    setTimeout(function() {        popUpBonus.classList.add('popup-active');    }, (20));});openPopUpAllLessons.addEventListener('click', () => {    overlayAllLessons.classList.add('overlay-active');    Array.from(video).forEach((elem)=> {        elem.pause();    })        setTimeout(function() {            popUpAllLessons.classList.add('popup-active');        }, (20));    });openPopupBuy.addEventListener('click', () => {    popUpBuy.classList.add('popup-active');    popUpAllLessons.classList.remove('popup-active');    });backPopUpBuy.addEventListener('click', () => {    popUpAllLessons.classList.add('popup-active');    popUpBuy.classList.remove('popup-active');    });overlayBonus.onclick = function (event) {    if (event.target === overlayBonus) {        popUpBonus.classList.remove('popup-active');        pauseVideo.classList.remove('pauseVideo-active');        setTimeout(function() {            overlayBonus.classList.remove('overlay-active');        }, (500));    }}    closeUpAllLessons.onclick = function (event) {        if (event.target === closeUpAllLessons) {                popUpAllLessons.classList.remove('popup-active');            setTimeout(function() {                overlayAllLessons.classList.remove('overlay-active');            }, (500));        }    }var close_next;	    if (is_close.target.className == "showup") {        close_next = is_close.target.id;        document.getElementById(close_next).nextElementSibling.style = "display:block";    }	    if (is_close.target.className == "close") {        document.getElementById(close_next).nextElementSibling.style = "display:none";    }});document.addEventListener('DOMContentLoaded', function () {    let rebootButtons = document.querySelectorAll('.reboot');    rebootButtons.forEach((elem) => {        elem.addEventListener('onclick', function () {            console.log('q');        })    });});