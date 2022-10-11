
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


    Array.from(video).forEach((elem)=> {
        elem.addEventListener('click', function (){
            setInterval(function () {
                var progressBar = document.querySelector('.slick-dots li.slick-active button')
                var width = parseInt(
                    (elem.currentTime * 94) / elem.duration
                );
                progressBar.style.width = width + 'px';

            }, 300);
            if (this.paused) {
                this.play();
            } else {
                this.pause();
            }
        })
    })

    $('.slider').on('beforeChange', function (event, slick ) {
        Array.from(video).forEach((elem)=> {
            elem.pause();
        })
    });
});

