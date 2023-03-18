interval = (videoLocal) => {
    const interval = setInterval(function () {
        let progressBar = videoLocal.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.querySelector('.slick-dots li.slick-active button');
        let width = (videoLocal.currentTime * 100) / videoLocal.duration;
        progressBar.style.background = `linear-gradient(to right,white 0%, white ${width}%,lightgrey ${width}% , lightgrey ${100 - width}%)`;
        if (videoLocal.paused) {
            clearTimeout(interval);
        }
    }, 100);
}
const pauseVideo = document.querySelectorAll('.pause__video');

document.addEventListener("DOMContentLoaded", function () {
    $('.slick-dots li button').on('click', function(e){
        e.stopPropagation(); // use this
    });
})

$('.slider').each(function() {
    let slider = $(this).slick({
        arrows:true,
        dots:true,
        infinite: false,
        slidesToShow:1,
        accessibility: false,
        swipeToSlide: false,
        touchMove: false,
        swipe: false,
        prevArrow: "<img src='/img/free-icon-left-arrows-5054206.png' class='slick-prev' alt='1'>",
        nextArrow: "<img src='/img/free-icon-two-arrows-5054205.png' class='slick-next' alt='2'>",
    });
    function stopVideos() {
        $(this).find('.slider__video-item').each(function (){
            this.pause();
        })
    }

    $(this).find('.slider__video-item').each(function () {
        // Закончил здесь
        this.addEventListener('click', function (){
            let videoLocal = this;
            interval(videoLocal);

            if(this.paused){
                $('.slick-current').find('.play__video').removeClass('active');
                $('.slick-current').find('.pause__video').removeClass('active');
                this.play();
            }
            else{
                $('.slick-current').find('.pause__video').addClass('active');
                this.pause();
            }
        })
    })
    $(this).on('pause', function (event, slick) {
        stopVideos();
        $(this).find('.slider__video-item').each(function () {
            this.addEventListener('click', function () {

                let videoLocal = this;
                interval(videoLocal);

                $(this).on('afterChange', function (event, slick) {
                    stopVideos();
                    $(this).find('.slider__video-item').each(function () {
                        let videoLocal = this;
                        interval(videoLocal);
                    })
                });

                $(this).on('beforeChange', function (event, slick) {
                    stopVideos();
                    $(this).find('.slider__video-item').each(function () {
                        let videoLocal = this;
                        interval(videoLocal);
                    });
                });

                $(this).on('play', function (event, slick) {
                    stopVideos();
                    $(this).find('.slider__video-item').each(function () {
                        let videoLocal = this;
                        interval(videoLocal);
                    });
                });
            })
        })
    })
})