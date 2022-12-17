/*totalProfit*/

document.addEventListener('DOMContentLoaded', function (){
    let request2 = new XMLHttpRequest();
    let url2 = "/StatisticsController/GetWeek";
    request2.open('GET', url2);

    request2.setRequestHeader('Content-Type', 'application/x-www-form-url');
    request2.addEventListener("readystatechange", () => {
        if (request2.readyState === 4 && request2.status === 200) {
            const arrays = JSON.parse(request2.responseText).prev;
            console.log(arrays)
            const ctx1 = document.getElementById('totalProfit').getContext('2d');
            const ChartTotalProfit = new Chart(ctx1, {

                type: 'line',
                data: {
                    labels: ['пн', 'вт', 'ср', 'чт', 'пт', 'сб', 'вс'],
                    datasets: [{
                        data: arrays,
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
            /*profitabilityIndicators*/
            const ctx2 = document.getElementById('profitabilityIndicators').getContext('2d');

            const ChartProfitabilityIndicators = new Chart(ctx2, {

                type: 'line',
                data: {
                    labels: ['пн', 'вт', 'ср', 'чт', 'пт', 'сб', 'вс'],
                    datasets: [{
                        tension: 0.6,
                        lineCap: 'round',
                        borderJoinStyle: "round",
                        data: arrays,
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
                            display: false,
                        },
                        y: {
                            display: false,
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
    });
    request2.send();
})



