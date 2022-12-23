/*totalProfit*/

document.addEventListener('DOMContentLoaded', function (){
    let request2 = new XMLHttpRequest();
    let url2 = "/StatisticsController/GetWeekDays";
    request2.open('GET', url2);

    request2.setRequestHeader('Content-Type', 'application/x-www-form-url');
    request2.addEventListener("readystatechange", () => {
        if (request2.readyState === 4 && request2.status === 200) {
            let arrays = JSON.parse(request2.responseText);
            let array_money = [0, 0, 0, 0, 0, 0, 0];
            let week = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']
            arrays.forEach(item => {
                array_money[week.indexOf((item.day).trim())] = parseInt(item.money);
            })
            if (document.getElementById('totalProfit')) {
                const ctx1 = document.getElementById('totalProfit').getContext('2d');
                const ChartTotalProfit = new Chart(ctx1, {

                    type: 'line',
                    data: {
                        labels: ['пн', 'вт', 'ср', 'чт', 'пт', 'сб', 'вс'],
                        datasets: [{
                            data: array_money,
                            borderColor: [
                                '#4E73F8'
                            ],
                            borderWidth: 3,
                            pointBackdropPadding: 2,
                            pointWidth: 2,
                            pointBackgroundWidth: 6,
                            pointBackgroundColor: '#fff',
                            pointBorderWidth: 3,
                            pointBorderColor: '#4E73F8',

                        }]
                    },
                    options: {

                        pointRadius: [1, 1, 1, 1, 1, 1, 5],
                        scales: {
                            x: {
                                grid:{
                                    color: '#E1E3E6',
                                    borderDash: [8],
                                    borderColor: '#E1E3E6',

                                },

                            },
                            y: {
                                ticks: {
                                    display: false
                                },grid: {
                                    display: false
                                }
                            },
                        },
                        responsive: true,
                        plugins: {
                            legend: {
                                display: false
                            },
                        },

                    },


                });
            }
        }
    });
    request2.send();
})



