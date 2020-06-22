$(document).ready(function() {
    let ctx = $('#analyticalEvolutionChart')
    let spinner = ctx.siblings()
    let filter = $('#analyticalEvolutionChartFilter')
    let chart

    // Get Sector Options (filter)
    $.ajax({
        type: 'GET',
        url: '/api/sectors/',
        success: function(response) {
            response.forEach(sector => {
                filter.append(`<option value=${sector.id}>${sector.name}</option>`)
            })
        },
        error:function() {console.log(error)}
    })

    // Listener on sector (filter) change
    filter.on('change', function() {
        let sectorId = $(this).val()
        renderChart(sectorId)
    })

    // Render Chart JS element
    let renderChart = function(sectorId = 0) {
        $.ajax({
            type: 'GET',
            url: `/api/reports/analyticalEvolutionChart/sector/${sectorId}`,
            dataType: 'JSON',
            beforeSend: function() {
                spinner.show()
            },
            success: function (response) {
                spinner.hide()
                ctx.show()
                // if the chart is not undefined then destory the old one so we can create a new one later
                if (chart) {
                    chart.destroy();
                }
                // Create chart
                chart = new Chart(ctx, {
                    type: 'bar',
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

                // Fill chart with response
                chart.data = {
                    labels: response.labels,
                    datasets: response.datasets
                }

                chart.update()
            },
            error:function(error) {console.log(error)}
        })
    }

    // Initialize chart data when document is ready
    renderChart()
})
