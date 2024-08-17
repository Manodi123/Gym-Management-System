// Fetch weight data from PHP file
fetch('data.php')
    .then(response => response.json())
    .then(weightData => {
        // Create chart using fetched data
        const ctx = document.getElementById('weight-chart').getContext('2d');
        const weightChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: weightData.labels,
                datasets: [{
                    label: 'Weight Progress',
                    data: weightData.data,
                    borderColor: 'blue',
                    fill: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    xAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Months'
                        }
                    }],
                    yAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Weight (kg)'
                        }
                    }]
                }
            }
        });
    })
    .catch(error => {
        console.error('Error fetching weight data:', error);
    });
