$(document).ready(function(){

    $('.slider').each(function() {
        let slider = $(this).parent().find('.slider').slick({
            arrows:false,
            dots:true,
            lazyLoad: true,
            appendDots: $(this).parent().find('.slick-dots'),
            slidesToShow:1
        });

        function stopVideos() {
            $(this).find('.slider__video-item').each(function (){
                this.pause();
            })
        }
        let width = 0;

        $(this).find('.slider__video-item').each(function () {
            // Закончил здесь
            this.addEventListener('ended', function () {
                slider.slick('slickNext');
            })
            this.addEventListener('click', function (){

                let videoLocal = this;
                const interval = setInterval(function () {
                    let progressBar = videoLocal.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.querySelector('.slick-dots li.slick-active button');
                    width = (videoLocal.currentTime * 100) / videoLocal.duration;
                    progressBar.style.background = `linear-gradient(to right,white 0%, white ${width}%,lightgrey ${width}% , lightgrey ${100 - width}%)`;
                    if (videoLocal.paused) {
                        clearInterval(interval);
                    }
                    // Проверка на конец
                }, 300);
                if (this.paused) {
                    $('.slick-current').find('.play__video').removeClass('active')

                    this.play();


                } else {
                    this.pause();
                }
            })
        })

        $(this).on('afterChange', function (event, slick ) {
            stopVideos();
            $(this).find('.slider__video-item').each(function () {
                let videoLocal = this;
                const interval = setInterval(function () {
                    let progressBar = videoLocal.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.querySelector('.slick-dots li.slick-active button');
                    width = (videoLocal.currentTime * 100) / videoLocal.duration;
                    progressBar.style.background = `linear-gradient(to right,white 0%, white ${width}%,lightgrey ${width}% , lightgrey ${100 - width}%)`;
                    if (videoLocal.paused) {
                        var highestTimeoutId = setTimeout(";");
                        for (var i = 0 ; i < highestTimeoutId ; i++) {
                            clearTimeout(i);
                        }
                    }
                }, 300);
            })
        });

        $(this).on('beforeChange', function (event, slick ) {
            stopVideos();
            $(this).find('.slider__video-item').each(function () {
                let videoLocal = this;
                const interval = setInterval(function () {
                    let progressBar = videoLocal.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.querySelector('.slick-dots li.slick-active button');
                    width = (videoLocal.currentTime * 100) / videoLocal.duration;
                    progressBar.style.background = `linear-gradient(to right,white 0%, white ${width}%,lightgrey ${width}% , lightgrey ${100 - width}%)`;
                    if (videoLocal.paused) {
                        var highestTimeoutId = setTimeout(";");
                        for (var i = 0 ; i < highestTimeoutId ; i++) {
                            clearTimeout(i);
                        }
                    }
                }, 300);
            });
        });
    });
});

