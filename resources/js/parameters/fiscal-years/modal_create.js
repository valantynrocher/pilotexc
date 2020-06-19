let months = {
    1: [
        "01",
        "Janvier"
    ],
    2: [
        "02",
        "Février"
    ],
    3: [
        "03",
        "Mars"
    ],
    4: [
        "04",
        "Avril"
    ],
    5: [
        "05",
        "Mai"
    ],
    6: [
        "06",
        "Juin"
    ],
    7: [
        "07",
        "Juillet"
    ],
    8: [
        "08",
        "Août"
    ],
    9: [
        "09",
        "Septembre"
    ],
    10: [
        "10",
        "Octobre"
    ],
    11: [
        "11",
        "Novembre"
    ],
    12: [
        "12",
        "Décembre"
    ]
}

// Add Modal script
$('#addFiscalYearModal').on('show.bs.modal', function (event) {
    let modal = $(this)
    let inputName = modal.find('#addName')
    let inputNameValue = "Exercice "
    inputName.val(inputNameValue)
    let selectMonthStart = modal.find('#addMonthStart')
    let selectMonthEnd = modal.find('#addMonthEnd');
    let selectYearStart = modal.find('#addYearStart')
    let selectYearEnd = modal.find('#addYearEnd')

    // Listener on month start change
    selectMonthStart.change(function() {
        selectMonthEnd.find('option').remove()

        function appendMonthEndOption(value) {
            let monthEndOp = `<option value="${months[value][0]}" selected>${months[value][1]}</option>`
            selectMonthEnd.append(monthEndOp)
        }

        if(selectMonthStart.val() == "01") {
            let monthEnd = 12
            appendMonthEndOption(monthEnd)

            if(selectYearStart.val() == selectYearEnd.val()) {
                return
            } else {
                modal.find('#addYearStart, #addYearEnd').val(0)
                inputName.val(inputNameValue)
            }
        } else {
            let monthEnd = parseInt(selectMonthStart.val()) - 1
            appendMonthEndOption(monthEnd)

            if(selectYearStart.val() == selectYearEnd.val()) {
                modal.find('#addYearStart, #addYearEnd').val("0")
                inputName.val(inputNameValue)
            } else {
                return
            }
        }
    })

    // Listener on year start change
    selectYearStart.change(function() {
        selectYearEnd.find('option').remove()
        inputName.val(inputNameValue)
        let yearStart = $(this).val()
        let yearEnd = ''

        function appendYearEndOption(value) {
            let yearEndOp = `<option value="${value}" selected>${value}</option>`
            selectYearEnd.append(yearEndOp)
        }

        if(selectMonthStart.val() == "01") {
            yearEnd = parseInt(yearStart)
            appendYearEndOption(yearEnd)
        } else {
            yearEnd = parseInt(yearStart) + 1
            appendYearEndOption(yearEnd)
        }

        if(selectYearStart.val() == 0) {
            selectYearEnd.find('option').remove()
        }
    })

    // Listener for select change
    modal.find('select').change(function() {
        let monthStart = selectMonthStart.val()
        let monthEnd = selectMonthEnd.val()
        let yearStart = selectYearStart.val()
        let yearEnd = selectYearEnd.val()

        // Auto fill name input
        inputName.val(inputNameValue + monthStart + '-' + yearStart + '/' + monthEnd + '-' + yearEnd)
    })

    $('#addFiscalYearForm').on('submit', function(e) {
        e.preventDefault()
        console.log($('#addFiscalYearForm').serialize())
        $.ajax({
            type: "POST",
            url: "/api/fiscalYears",
            data: $('#addFiscalYearForm').serialize(),
            success: function() {
                modal.modal('hide')
                location.reload()
            },
            error: function(error) {
                console.log(error.responseText.message)
                alert("Une erreur est survenue. Vérifiez ceci : les champs marqués d'un * sont renseignés, le code que vous tentez d'ajouter n'existe pas déjà ; puis recommencez.")
            }
        })
    })
});
$('#addFiscalYearModal').on('hide.bs.modal', function() {
    $(this).find('#addMonthStart, #addYearStart').val(0)
    $(this).find('#addMonthEnd, #addYearEnd').empty()
})
