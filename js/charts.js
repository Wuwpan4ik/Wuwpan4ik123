const ctx = document.getElementById('totalProfit').getContext('2d');

const myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['','пн', 'вт', 'ср', 'чт', ''],
        datasets: [{
            data: [0, 4, 3, 5, 10],
            borderColor: [
                '#4E73F8'
            ],
            borderWidth: 3,
            pointBackdropPadding: 2,
            pointWidth: 2,
            pointBackgroundWidth: 6,
            pointBackgroundColor: '#4E73F8',
            pointBorderWidth: 10,
            pointBorderColor: 'rgba(78, 115, 248, 0.24)',

        }]
    },
    options: {
        pointRadius: [0, 0, 0, 0,5],
        scales: {
            y: {
                ticks: {
                    display: false
                },
                grid: {
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



