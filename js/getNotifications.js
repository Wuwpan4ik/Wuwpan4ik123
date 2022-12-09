// Количество уведомлений
let requestCount = new XMLHttpRequest();

let urlCount = "/getCountNotifications";

requestCount.open('GET', urlCount);

requestCount.setRequestHeader('Content-Type', 'application/x-www-form-url');
requestCount.addEventListener("readystatechange", () => {
    if (requestCount.readyState === 4 && requestCount.status === 200) {
        document.getElementById('msg').innerHTML = JSON.parse(requestCount.responseText).length;
        if (JSON.parse(requestCount.responseText).length === 0) {
            document.querySelector('.popupBell').classList.add('display-none');
        }
    }
})
requestCount.send();


// Все уведомления
let requestNot = new XMLHttpRequest();

let urlNot = "/getNotifications";

requestNot.open('GET', urlNot);

requestNot.setRequestHeader('Content-Type', 'application/x-www-form-url');
requestNot.addEventListener("readystatechange", () => {
    if (requestNot.readyState === 4 && requestNot.status === 200) {
        document.querySelector('.popupBell-body').innerHTML = requestNot.responseText;
        console.log(requestNot.responseText)
    }
})
requestNot.send();