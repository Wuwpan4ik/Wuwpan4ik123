$(document).ready(function(){
    const slider = $('.slider').slick({
        arrows:false,
        dots:true,
        swipe: false,
        appendDots: $('.slick-dots'),
        slidesToShow:1
    });
    const video = document.querySelectorAll('.slider__video-item');
    let width = 0;

    function stopVideos() {
        Array.from(video).forEach((elem)=> {
            elem.pause();
        })
    }

    Array.from(video).forEach((elem)=> {
        elem.addEventListener('click', function (){
            const interval = setInterval(function () {
                let progressBar = document.querySelector('.slick-dots li.slick-active button')
                width = (elem.currentTime * 100) / elem.duration;
                progressBar.style.background  = `linear-gradient(to right,white 0%, white ${width}%,lightgrey ${width}% , lightgrey ${100 - width}%)`;
                if (elem.paused) {
                    clearInterval(interval);
                }
                if (elem.ended){
                    slider.slick("slickNext");
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

    slider.on('afterChange', function (event, slick ) {
        stopVideos();
    });

    slider.on('beforeChange', function (event, slick ) {
        stopVideos();
        Array.from(video).forEach((elem)=> {
            const interval = setInterval(function () {
                var progressBar = document.querySelector('.slick-dots li.slick-active button')
                width = (elem.currentTime * 100) / elem.duration;
                progressBar.style.background  = `linear-gradient(to right,white 0%, white ${width}%,lightgrey ${width}% , lightgrey ${100 - width}%)`;
                if (elem.paused) {
                    clearInterval(interval);
                }
            }, 300);
        })
    });

});

