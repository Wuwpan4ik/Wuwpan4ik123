/*SmallPlayer*/function PauseVideo() {    document.querySelectorAll('.play__video').forEach(item => {        item.classList.add('active');    })    Array.from($('.slider__video-item')).forEach((elem) => {        elem.pause();    })}function OpenPopup(elem) {    let pauseVideo = document.querySelector('.pause__video');    let video = document.querySelectorAll('.slider__video-item');    if (document.querySelector('.play__video')) {        if (document.querySelector('.play__video').classList.contains('active')) {            document.querySelector('.play__video').classList.remove('active');        }    }    //Добавляем паузу при открытии попапа    if (elem.parentElement.parentElement.querySelector('.pause__video')) {        elem.parentElement.parentElement.querySelector('.pause__video').classList.add('active');    }    //WhiteSpace    if (elem.parentElement.parentElement.querySelector('.overlay .whiteSpace')) {        setTimeout(function () {            let number = Number(elem.parentElement.parentElement.querySelector('.popup').clientHeight);            let sumsHeight = window.innerHeight - number;            elem.parentElement.parentElement.querySelector('.overlay .whiteSpace').style.height = `${sumsHeight}px`;        }, 300)    }    if (elem.parentElement.parentElement.querySelector('.overlay')) {        elem.parentElement.parentElement.querySelector('.overlay').classList.add('active');    }    if (pauseVideo) {        pauseVideo.classList.add('active');    }    setTimeout(function () {        if (elem.parentElement.parentElement.querySelector('.popup')) {            elem.parentElement.parentElement.querySelector('.popup').classList.add('active');        }    }, (0));    Array.from(video).forEach((elem) => {        elem.pause();    })}$(document).ready(function() {    const button = document.querySelectorAll('.button-open');    let btnNotBuy = document.querySelectorAll('.button-notBuy');    let video = document.querySelectorAll('.slider__video-item');    let pauseVideo = document.querySelector('.pause__video');    let whiteSpace = document.querySelectorAll('.whiteSpace');    let overlayPopups = document.querySelectorAll('.popup');    const playVideo = document.querySelectorAll('.play__video');    const popUpBuy = document.querySelector('.popup__buy');    const buttonBuy = document.querySelectorAll('.button-buy');    const backPopUpBuy = document.querySelectorAll('.button-back');    const videoSlides = document.querySelectorAll('.slider__item');    Array.from(playVideo).forEach((elem) => {        elem.addEventListener('click', () => {            elem.parentElement.querySelector('.slider__video-item').play();            elem.classList.remove('active');        })    })    //Кнопка Не покупать    Array.from(btnNotBuy).forEach((elem)=>{        elem.addEventListener('click', function(){            if(elem.parentElement.parentElement.parentElement.parentElement.querySelector('.whiteSpace')) {                elem.parentElement.parentElement.parentElement.parentElement.querySelector('.whiteSpace').height = "0px"            }            if(elem.parentElement.parentElement.parentElement.parentElement.parentElement.querySelector('.pause__video')){                elem.parentElement.parentElement.parentElement.parentElement.parentElement.querySelector('.pause__video').classList.remove('active');            }            if(elem.parentElement.parentElement.parentElement.parentElement.parentElement.querySelector('.play__video')){                elem.parentElement.parentElement.parentElement.parentElement.parentElement.querySelector('.play__video').classList.remove('active');            }            if(elem.parentElement.parentElement.parentElement.querySelector('.popup')){                elem.parentElement.parentElement.parentElement.querySelector('.popup').classList.remove('active');            }            elem.parentElement.parentElement.parentElement.parentElement.parentElement.querySelector("video").play();        })    })    //Whitespace    Array.from(whiteSpace).forEach((elem)=>{        elem.addEventListener('click', function(){            if (document.querySelector('.play__video')) {                if(document.querySelector('.play__video').classList.contains('active')){                    document.querySelector('.play__video').classList.remove('active');                }                interval(document.querySelector('.slider__video-item'))            }            if (elem.parentElement.parentElement.querySelector('.pause__video').classList.contains('active')) {                elem.parentElement.parentElement.querySelector('.pause__video').classList.remove('active');            }            if (elem.parentElement.parentElement.querySelector('.overlay')) {                elem.parentElement.parentElement.querySelector('.overlay').classList.remove('active');            }            setTimeout(function () {                document.querySelectorAll('.popup').forEach(item => {                    item.classList.remove('active');                })            }, (0));            elem.parentElement.parentElement.querySelector('video').play();            elem.style.height = "0px";        });    })    //Открытие попапа    Array.from(button).forEach((elem) => {        elem.addEventListener('click', () => {            OpenPopup(elem);        })    })    Array.from(buttonBuy).forEach((elem) => {        elem.addEventListener('click', () => {            popUpBuy.classList.add('active');            popUpBuy.querySelector('#creator_id').value = elem.dataset.author;            popUpBuy.querySelector('#course_id').value = elem.dataset.course;            popUpBuy.querySelector('#price').innerHTML = elem.dataset.price;            document.getElementById('BuyPopup').action = "/BuyHandler/CreateLinkProdamus";            console.log(popUpBuy)        })    })    Array.from(backPopUpBuy).forEach((elem) => {        elem.addEventListener('click', () => {            Array.from(button).forEach((elem) => {                setTimeout(function () {                    popUpBuy.classList.remove('active');                }, (20));            })        })    })});document.addEventListener('DOMContentLoaded', function () {    let rebootButtons = document.querySelectorAll('.reboot');    rebootButtons.forEach((elem) => {        elem.addEventListener('onclick', function () {        })    });});/* Analytics*/const checkBox = document.body.querySelectorAll('.checkbox');checkBox.forEach(item =>{    item.onclick = function (){        item.parentElement.parentElement.classList.toggle('completed')    }})/*UserPopups*/let otherCourses = document.querySelectorAll('.otherCourses');const availableСoursesBtn = document.querySelectorAll('.availableСoursesBtn');const aboutTheAuthor = document.querySelector('.aboutTheAuthor');const availableToYou = document.querySelector('.availableToYou');const questionBtn = document.querySelectorAll('.questionBtn');const question = document.querySelector('.question');const questionBack = document.querySelector('.questionBackground');const course = document.querySelector('.Course');const allLessons = document.querySelector('.AllLessons');const youChosen = document.querySelector('.youChosen');const backToCourse = document.querySelectorAll('.courseBackBtn');const userPopups = document.querySelectorAll('.userPopup');backToCourse.forEach((item) => {    item.addEventListener('click', function () {        document.querySelectorAll('.question.userPopup').forEach(item => {            if (item.classList.contains('active')) {                item.classList.remove('active');            }        })        questionBack.classList.remove('active');    })})availableСoursesBtn.forEach(item => {    item.onclick = function () {        availableToYou.classList.add('active');        aboutTheAuthor.classList.remove('active')    }})//Есть вопрсос?questionBtn.forEach(item => {    item.onclick = function () {        question.classList.add('active');        questionBack.classList.add('active');    }})otherCourses.forEach(item => {    item.onclick = function () {        allLessons.classList.add('active');        availableToYou.classList.remove('active')    }})// window.onload = function() {//// }// userPopups.forEach(item => {//     if (item.classList.contains('active')) {//         setTimeout(function () {//             item.style.transform = 'translateY(20px)'//         }, (100));//     }// })