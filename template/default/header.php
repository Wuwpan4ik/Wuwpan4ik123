<body>
<div class="feed-header">

    <div class="feed-header__title">
        <?php if($_SERVER['REQUEST_URI'] != '/') { ?>
            <a class="button__back" href="/<?=isset($back) ? $back : "" ?>">
                <img src="/img/ArrowLeft.svg" alt="">
            </a>
        <?php } ?>
        <h2><?=$title ?></h2>
    </div>

    <div class="buttonsFeed">

        <button class="ico_button button-bell"><img class="ico" src="img/Bell.svg"><div id="msg">1</div></button>

        <button id="apps" class="ico_button" onclick="window.location.replace('Analytics')">Заявки</button>

        <div class="popupBell">
            <img class="arrow-bcg" src="img/Notification/arrowbcg.svg" alt="">
            <div class="popupBell-body">
            </div>
        </div>
    </div>
</div>
<script>
    let buttonBell =  document.body.querySelector('.button-bell');
    let popupBell =  document.body.querySelector('.popupBell')
    function popupBellActive() {
        popupBell.classList.add('active');
    }
    function popupBellDisable() {
        popupBell.classList.remove('active');
    }
    buttonBell.addEventListener('mouseover', popupBellActive)
    buttonBell.addEventListener('mouseout', popupBellDisable)
    buttonBell.addEventListener('click', function () {
        document.querySelector('.button-bell .ico').src = "img/correct.png";
        document.querySelector('.button-bell .ico').style = "width: 42px; height: 42px;"
        document.querySelector('.button-bell #msg').remove();
        buttonBell.removeEventListener('mouseover', popupBellActive)
        popupBellDisable();
        buttonBell.removeEventListener('mouseout', popupBellDisable)
        let request = new XMLHttpRequest();
        let url = "/NotificationsController/checkout";

        request.open('POST', url);

        request.setRequestHeader('Content-Type', 'application/x-www-form-url');
        request.addEventListener("readystatechange", () => {
            if (request.readyState === 4 && request.status === 200) {
            }
        });
        request.send();
    })
</script>
</body>

