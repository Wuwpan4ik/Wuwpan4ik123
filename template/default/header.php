<body>
<div class="feed-header">

    <div class="feed-header__title">
        <?php if($_SERVER['REQUEST_URI'] != '/' && $_SERVER['REQUEST_URI'] != '/Account') { ?>
            <a class="button__back" href="/<?=isset($back) ? $back : "" ?>">
                <img src="/img/ArrowLeft.svg" alt="">
            </a>
        <?php } ?>
        <h2><?=$title ?></h2>
    </div>


    <div class="buttonsFeed">

        <button class="ico_button button-bell"><img class="ico" src="img/Bell.svg"><div id="msg">0</div></button>

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
        buttonBell.removeEventListener('mouseover', popupBellActive)
        popupBellDisable();
        buttonBell.removeEventListener('mouseout', popupBellDisable)
        let request = new XMLHttpRequest();
        let url = "/NotificationsController/checkout";
        document.querySelector('#msg').innerHTML = '0';

        request.open('POST', url);

        request.setRequestHeader('Content-Type', 'application/x-www-form-url');
        request.addEventListener("readystatechange", () => {
        });
        request.send();
    })
</script>
</body>

