let requestNot = new XMLHttpRequest();

let urlNot = "/getNotifications";

requestNot.open('GET', urlNot);

requestNot.setRequestHeader('Content-Type', 'application/x-www-form-url');
requestNot.addEventListener("readystatechange", () => {
    if (requestNot.readyState === 4 && requestNot.status === 200) {
        if (requestNot.responseText.length === 0) {
            let buttonBell =  document.body.querySelector('.button-bell');
            document.querySelector('#msg').style = 'display:none';
            document.querySelector('.button-bell .ico').src = "img/correct.png";
            document.querySelector('.button-bell .ico').style = "width: 42px; height: 42px;";
            buttonBell.removeEventListener('mouseover', popupBellActive)
            popupBellDisable();
            buttonBell.removeEventListener('mouseout', popupBellDisable)
        }
        document.querySelector('.popupBell-body').innerHTML = requestNot.responseText;
    }
})
requestNot.send();