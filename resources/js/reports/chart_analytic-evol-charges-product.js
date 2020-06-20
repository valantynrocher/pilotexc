$(document).ready(function() {
    let spinner = $('#spinner1')
    let ctx = $('#analyticalEvolutionChart')
    let sectorId = $(document).find('#analyticalEvolutionChartFilter')

    let renderChart = function() {
        $.ajax({
            type: 'GET',
            url: `/api/reports/analyticalEvolutionChart/sector/${sectorId}`,
            dataType: 'JSON',
            beforeSend: function() {

            },
            success: function (response) {
                spinner.hide()
                let myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: response.labels,
                        datasets: response.datasets
                    },
                    options: {
                        responsive: true,
                        title: {
                            display: false
                        },
                        tooltips: {
                            mode: 'index',
                            intersect: true
                        }
                    }
                })
            },
            error:function() {console.log(error)}
        })
    }

    // Initialize chart data
    renderChart()



})
