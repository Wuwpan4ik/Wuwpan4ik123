interval = (videoLocal) => {
    const interval = setInterval(function () {
        let progressBar = videoLocal.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.querySelector('.slick-dots li.slick-active button');
        width = (videoLocal.currentTime * 100) / videoLocal.duration;
        progressBar.style.background = `linear-gradient(to right,white 0%, white ${width}%,lightgrey ${width}% , lightgrey ${100 - width}%)`;
        if (videoLocal.paused) {
            clearTimeout(interval);
        }
    }, 300);
}

document.addEventListener("DOMContentLoaded", function () {
    $('.slick-dots li button').on('click', function(e){
        e.stopPropagation(); // use this
    });
})

$('.slider').each(function() {
    let slider = $(this).slick({
        arrows:false,
        dots:true,
        infinite: false,
        slidesToShow:1,
        accessibility: false,
        swipeToSlide: false,
        touchMove: false,
        swipe: false,
        appendDots: $(this).parent().find('.slick-dots')
    });
    function stopVideos() {
        $(this).find('.slider__video-item').each(function (){
            this.pause();
        })
    }
    let width = 0;

    $(this).find('.slider__video-item').each(function () {
        // Закончил здесь
        this.addEventListener('click', function (){
            let videoLocal = this;
            let videoMirror = document.getElementById('mirrorVideo')
            let interval = setInterval(function () {
                let progressBar = videoLocal.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.querySelector('.slick-dots li.slick-active button');
                width = (videoLocal.currentTime * 100) / videoLocal.duration;
                progressBar.style.background = `linear-gradient(to right,white 0%, white ${width}%,lightgrey ${width}% , lightgrey ${100 - width}%)`;
                if (videoLocal.paused) {
                    clearInterval(interval);
                }
                // Проверка на конец
            }, 300);

            if(this.paused){
                $('.slick-current').find('.play__video').removeClass('active');
                $('.slick-current').find('.pause__video').removeClass('active');
                videoMirror.play();
                this.play();
            }
            else{
                $('.slick-current').find('.pause__video').addClass('active');
                videoMirror.pause();
                this.pause();
            }
        })
    })
    $(this).on('afterChange', function (event, slick) {
        stopVideos();
        $(this).find('.slider__video-item').each(function () {
            let videoLocal = this;
            interval(videoLocal);
        })
    });

    $(this).on('beforeChange', function (event, slick ) {
        stopVideos();
        $(this).find('.slider__video-item').each(function () {
            let videoLocal = this;
            interval(videoLocal);
        });
    });
});
