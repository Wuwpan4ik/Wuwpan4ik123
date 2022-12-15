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

        <button style="width:62px;" class="ico_button button-bell"><svg width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M2.51436 14.0001L3.69436 12.8181C4.07236 12.4401 4.28036 11.9381 4.28036 11.4041V6.72708C4.28036 5.37008 4.87036 4.07308 5.90036 3.17108C6.93836 2.26108 8.26036 1.86108 9.63736 2.04208C11.9644 2.35108 13.7194 4.45508 13.7194 6.93708V11.4041C13.7194 11.9381 13.9274 12.4401 14.3044 12.8171L15.4854 14.0001H2.51436ZM10.9994 16.3411C10.9994 17.2401 10.0834 18.0001 8.99936 18.0001C7.91536 18.0001 6.99936 17.2401 6.99936 16.3411V16.0001H10.9994V16.3411ZM17.5204 13.2081L15.7194 11.4041V6.93708C15.7194 3.45608 13.2174 0.499077 9.89936 0.0600774C7.97736 -0.195923 6.03736 0.391077 4.58236 1.66708C3.11836 2.94908 2.28036 4.79308 2.28036 6.72708L2.27936 11.4041L0.478359 13.2081C0.00935877 13.6781 -0.129641 14.3771 0.124359 14.9901C0.379359 15.6041 0.972359 16.0001 1.63636 16.0001H4.99936V16.3411C4.99936 18.3591 6.79336 20.0001 8.99936 20.0001C11.2054 20.0001 12.9994 18.3591 12.9994 16.3411V16.0001H16.3624C17.0264 16.0001 17.6184 15.6041 17.8724 14.9911C18.1274 14.3771 17.9894 13.6771 17.5204 13.2081Z" fill="#757D8A"/>
            </svg>
            <div id="msg">0</div></button>

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

        request.open('POST', url);

        request.setRequestHeader('Content-Type', 'application/x-www-form-url');
        request.addEventListener("readystatechange", () => {
        });
        request.send();
    })
</script>
</body>

