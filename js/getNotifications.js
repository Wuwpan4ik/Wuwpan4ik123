// Количество уведомлений
function getCount() {
    let requestCount = new XMLHttpRequest();
    document.querySelector('.popupBell-body').classList.add('display-none');
    let urlCount = "/getCountNotifications";

    requestCount.open('GET', urlCount);

    requestCount.setRequestHeader('Content-Type', 'application/x-www-form-url');
    requestCount.addEventListener("readystatechange", () => {
        if (requestCount.readyState === 4 && requestCount.status === 200) {
            document.getElementById('msg').innerHTML = JSON.parse(requestCount.responseText).length;
            if (JSON.parse(requestCount.responseText).length >= 9) {
                document.getElementById('msg').innerHTML = '9+';
            }
            if (JSON.parse(requestCount.responseText).length === 0) {
                document.querySelector('.button-bell').addEventListener('click', GetAllNotif);
                document.querySelector('#msg').style.backgroundColor = '#757D8A';
            }  else {
                document.querySelector('.popupBell-body').classList.remove('display-none');
            }
        }
    })
    requestCount.send();
}
getCount();

// Все непрочитанные уведомления
let requestNot = new XMLHttpRequest();

let urlNot = "/getCheckedNotifications";

requestNot.open('GET', urlNot);

requestNot.setRequestHeader('Content-Type', 'application/x-www-form-url');
requestNot.addEventListener("readystatechange", () => {
    if (requestNot.readyState === 4 && requestNot.status === 200) {
        if (document.querySelector('.popupBell-body')) {
            document.querySelector('.popupBell-body').innerHTML = requestNot.responseText;
        }
    }
})
requestNot.send();


// Все уведомления

function GetAllNotif() {
    let request = new XMLHttpRequest();

    let url = "/getNotifications";

    request.open('GET', url);

    request.setRequestHeader('Content-Type', 'application/x-www-form-url');
    request.addEventListener("readystatechange", () => {
        if (request.readyState === 4 && request.status === 200) {
            if (document.querySelector('.popupBell-body')) {
                document.querySelector('.popupBell-body').innerHTML = request.responseText;
            }
            document.querySelector('.popupBell-body').classList.remove('display-none');
            if (request.responseText.length < 4) {
                document.querySelector('.popupBell-body').innerHTML = `<div class="popupBell-body">
                <div class="popupBell-item not-bell">
                <div class="popupBell-item__info ">
                    <p>У вас пока нет уведомлений</p>
                </div>
          </div>
          </div>`;
            }
        }
    })
    request.send();
}
$(document).mouseup(function (e) {
    var container = $(".popupBell-body");
    if (container.has(e.target).length === 0 && $(".button-bell").has(e.target).length !== 1){
        container.display = 'none';
        $(".popupBell").removeClass('active')
    }
});

