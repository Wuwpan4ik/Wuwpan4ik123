$(document).ready(function(){
    $('.slider').slick({
        arrows:true,
        dots:true,
        prevArrow: false,
        nextArrow: false,
        appendDots: $('.slick-dots'),
        slidesToShow:1
    });
    var video = document.querySelectorAll('.slider__video-item');

    function stopVideos() {
        Array.from(video).forEach((elem)=> {
            elem.pause();
        })
    }

    var width = 0;

    Array.from(video).forEach((elem)=> {
        elem.addEventListener('click', function (){
            const interval = setInterval(function () {
                var progressBar = document.querySelector('.slick-dots li.slick-active button')
                width = parseInt(
                    (elem.currentTime * 94) / elem.duration
                );
                progressBar.style.background  = `linear-gradient(to right,white 0%, white ${width}%,lightgrey ${width}% , lightgrey ${100 - width}%)`;
                if (elem.paused) {
                    clearInterval(interval);
                }
            }, 300);
            if (this.paused) {
                Array.from(video).forEach((elem)=> {
                    elem.pause();
                })
                this.play();
            } else {
                this.pause();
            }
        })
    })

    $('.slider').on('afterChange', function (event, slick ) {
        stopVideos();
    });


    $('.slider').on('beforeChange', function (event, slick ) {
        stopVideos();
        Array.from(video).forEach((elem)=> {
            const interval = setInterval(function () {
                var progressBar = document.querySelector('.slick-dots li.slick-active button')
                width = parseInt(
                    (elem.currentTime * 94) / elem.duration
                );
                progressBar.style.background  = `linear-gradient(to right,white 0%, white ${width}%,lightgrey ${width}% , lightgrey ${100 - width}%)`;
                if (elem.paused) {
                    clearInterval(interval);
                }
            }, 300);
        })
    });
});

