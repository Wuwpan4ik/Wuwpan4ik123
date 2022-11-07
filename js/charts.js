/*totalProfit*/

const ctx1 = document.getElementById('totalProfit').getContext('2d');

const ChartTotalProfit = new Chart(ctx1, {

    type: 'line',
    data: {
        labels: ['пн', 'вт', 'ср', 'чт', 'пт', 'сб', 'вс'],
        datasets: [{
            data: [0, 4, 3, 5, 10, 2, 5],
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

        pointRadius: [0, 0, 0, 0, 0, 0, 5],
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
            data: [0,0, 0, 2000, 10, 0, 0],
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

        pointRadius: [0, 0, 0, 6, 0, 0, 0],
        scales: {
            x: {
                ticks: {
                    display: false
                },
                grid:{
                    display: false
                },
            },
            y: {
                ticks: {
                    display: false
                },
                grid: {
                    display: false,
                    border: false
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
