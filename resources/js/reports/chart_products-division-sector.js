$(document).ready(function() {
    let spinner = $('#spinner2')
    let ctx = $('#productsDivisionChart')
    let filter = $('#productsDivisionChartFilter')
    let pieChart
    let filterDefaultValue

    // Get Sector Options (filter)
    $.ajax({
        type: 'GET',
        url: '/api/fiscalYears/getLastFive',
        success: function(response) {
            response.forEach(fiscalYear => {
                filter.append(`<option value=${fiscalYear.id}>${fiscalYear.name}</option>`)
            })
            filterDefaultValue = filter.find('option:first-child').val()

            // Initialize chart data when filter options are loaded
            renderChart(filterDefaultValue)
        },
        error:function(error) {console.log(error)}
    })

    // Listener on sector (filter) change
    filter.on('change', function() {
        let fiscalYearId = $(this).val()
        renderChart(fiscalYearId)
    })


    // Render Chart JS element
    let renderChart = function(fiscalYearId) {
        $.ajax({
            type: 'GET',
            url: `/api/reports/productsDivisionChart/fiscalYear/${fiscalYearId}`,
            dataType: 'JSON',
            beforeSend: function() {
                spinner.show()
            },
            success: function (response) {
                spinner.hide()
                ctx.show()
                // if the chart is not undefined then destory the old one so we can create a new one later
                if (pieChart) {
                    pieChart.destroy();
                }
                // Create chart
                pieChart = new Chart(ctx, {
                    type: 'pie',
                    options: {
                        responsive: true,
                        title: {
                            display: false
                        },
                        animation: {
                            animateScale: true,
                            animateRotate: true
                        }
                    }
                })

                // Fill chart with response
                pieChart.data = {
                    labels: response.labels,
                    datasets: response.datasets
                }

                pieChart.update()
            },
            error:function(error) {console.log(error)}
        })
    }
})
