const container = document.querySelector(".container"),
    mainVideo = container.querySelector("video"),
    videoTimeline = container.querySelector(".video-timeline"),
    progressBar = container.querySelector(".progress-bar"),
    volumeBtn = container.querySelector(".volume i"),
    currentVidTime = container.querySelector(".current-time"),
    videoDuration = container.querySelector(".video-duration"),
    videoDursecond = document.querySelector('.popup__allLessons-item-info-header .aboutTheAuthor-name'),
    playPauseBtn = container.querySelector(".play-pause i"),
    sliderDarkness = document.querySelector('.slider__darkness'),
    videoContainerS = document.querySelector('.contaierPlayer .wrapper'),
    buttonsBack = document.querySelector('.UserPlayer.Сourse-form'),
    pauseBtnFirst = document.querySelector('#pauseBtn'),
    videoContainer = document.getElementById('UserPlayerVideo');

let timer;

const userPlayer = document.body.querySelector('.UserPlayer');
const youWatching = document.body.querySelector('.youWatching');
const hideControls = () => {
    if(mainVideo.paused) return;
    timer = setTimeout(() => {
        container.classList.remove("show-controls");
    }, 3000);
}
hideControls();

container.addEventListener("mousemove", () => {
    container.classList.add("show-controls");
    clearTimeout(timer);
    hideControls();
});

const formatTime = time => {
    let seconds = Math.floor(time % 60),
        minutes = Math.floor(time / 60) % 60,
        hours = Math.floor(time / 3600);

    seconds = seconds < 10 ? `0${seconds}` : seconds;
    minutes = minutes < 10 ? `0${minutes}` : minutes;
    hours = hours < 10 ? `0${hours}` : hours;

    if(hours == 0) {
        return `${minutes}:${seconds}`
    }
    return `${hours}:${minutes}:${seconds}`;
}

videoTimeline.addEventListener("mousemove", e => {
    let timelineWidth = videoTimeline.clientWidth;
    let offsetX = e.offsetX;
    let percent = Math.floor((offsetX / timelineWidth) * mainVideo.duration);
    const progressTime = videoTimeline.querySelector("span");
    offsetX = offsetX < 20 ? 20 : (offsetX > timelineWidth - 20) ? timelineWidth - 20 : offsetX;
    progressTime.style.left = `${offsetX}px`;
    progressTime.innerText = formatTime(percent);
});

playBtnFirst.onclick = () =>{
    playBtnFirst.classList.add('nonActive');
}

videoTimeline.addEventListener("click", e => {
    let timelineWidth = videoTimeline.clientWidth;
    mainVideo.currentTime = (e.offsetX / timelineWidth) * mainVideo.duration;
});

mainVideo.addEventListener("timeupdate", e => {
    let {currentTime, duration} = e.target;
    let percent = (currentTime / duration) * 100;
    progressBar.style.width = `${percent}%`;
    currentVidTime.innerText = formatTime(currentTime);
});

mainVideo.addEventListener("loadeddata", () => {
    videoDuration.innerText = videoDursecond.innerText;
});

const draggableProgressBar = e => {
    let timelineWidth = videoTimeline.clientWidth;
    progressBar.style.width = `${e.offsetX}px`;
    mainVideo.currentTime = (e.offsetX / timelineWidth) * mainVideo.duration;
    currentVidTime.innerText = formatTime(mainVideo.currentTime);
}

volumeBtn.addEventListener("click", () => {
    if(!volumeBtn.classList.contains("fa-volume-high")) {
        mainVideo.volume = 0.5;
        volumeBtn.classList.replace("fa-volume-xmark", "fa-volume-high");
    } else {
        mainVideo.volume = 0.0;
        volumeBtn.classList.replace("fa-volume-high", "fa-volume-xmark");
    }
});

videoContainer.onclick = function () {
    if (videoContainer.paused){
        youWatching.classList.remove('active');
        userPlayer.classList.remove('active');
        sliderDarkness.classList.remove("activePlayer");
        buttonsBack.classList.remove('active');
        pauseBtnFirst.classList.remove('active');
        videoContainer.play();
        if(youWatching.classList.contains('non__file')){
            videoContainerS.classList.add('nonActivePlayer');
            videoContainerS.classList.remove('non__file');
        }else{
            videoContainerS.classList.add('nonActivePlayer');
            videoContainerS.classList.remove('has__file');
        }
    }
    else {
        if(youWatching.classList.contains('non__file')){
            videoContainerS.classList.remove('nonActivePlayer');
            videoContainerS.classList.add('non__file');
        }else{
            videoContainerS.classList.remove('nonActivePlayer');
            videoContainerS.classList.add('has__file');
        }
        userPlayer.classList.add('active');
        sliderDarkness.classList.add("activePlayer");
        youWatching.classList.add('active');
        buttonsBack.classList.add('active');
        pauseBtnFirst.classList.add('active');
        videoContainer.pause();
    }
}

mainVideo.addEventListener("play", () => playPauseBtn.classList.replace("fa-play", "fa-pause"));
mainVideo.addEventListener("pause", () => playPauseBtn.classList.replace("fa-pause", "fa-play"));
playPauseBtn.addEventListener("click", () => mainVideo.paused ? mainVideo.play() : mainVideo.pause());
videoTimeline.addEventListener("mousedown", () => videoTimeline.addEventListener("mousemove", draggableProgressBar));
document.addEventListener("mouseup", () => videoTimeline.removeEventListener("mousemove", draggableProgressBar));


//Плашка "Вы смотрите"
//Вскрытие попапа при нажатии на видео