var AddFiscalYear = function () {
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
        let button = $(event.relatedTarget)
        let modal = $(this)

        let nameInput = modal.find('.modal-body #addName')
        let nameValInit = "Exercice "
        nameInput.val(nameValInit)

        let monthStartSelectElt = modal.find('.modal-body #addMonthStart')
        function getMonthStartVal() {
            return monthStartSelectElt.val()
        }

        let monthEndSelectElt = modal.find('.modal-body #addMonthEnd');
        function getMonthEndVal() {
            return monthEndSelectElt.val()
        }

        let yearStartSelectElt = modal.find('.modal-body #addYearStart')
        function getYearStartVal() {
            return yearStartSelectElt.val()
        }

        let yearEndSelectElt = modal.find('.modal-body #addYearEnd')
        function getYearEndVal() {
            return yearEndSelectElt.val()
        }

        // Month select changing
        monthStartSelectElt.change(function() {
            modal.find('.modal-body #addMonthEnd .monthEndOp').remove()

            let monthSelect = $(this)
            let monthStart = getMonthStartVal()

            function appendMonthEndOption(value) {
                let monthEndOp = '<option class="monthEndOp" value="'+ months[value][0] +'" selected>'+ months[value][1] +'</option>'
                monthEndSelectElt.append(monthEndOp)
            }

            if(monthStart == "01") {
                let monthEnd = 12
                appendMonthEndOption(monthEnd)

                if(getYearStartVal() == getYearEndVal()) {
                    return
                } else {
                    modal.find('.modal-body #addYearStart, .modal-body #addYearEnd').val("0")
                    nameInput.val(nameValInit)
                }
            } else {
                let monthEnd = parseInt(monthStart) - 1
                appendMonthEndOption(monthEnd)

                if(getYearStartVal() == getYearEndVal()) {
                    modal.find('.modal-body #addYearStart, .modal-body #addYearEnd').val("0")
                    nameInput.val(nameValInit)
                } else {
                    return
                }
            }
        })

        // Year select changing
        yearStartSelectElt.change(function() {
            modal.find('.modal-body #addMonthEnd .yearEndOp').remove()
            nameInput.val(nameValInit)
            let nameVal = ''

            let yearSelect = $(this)
            let yearStart = yearSelect.val()
            let yearEnd = ''
            let monthStart = getMonthStartVal()

            function appendYearEndOption(value) {
                let yearEndOp = '<option class="yearEndOp" value="'+ value +'" selected>'+ value +'</option>'
                yearEndSelectElt.append(yearEndOp)
            }

            if(monthStart == "01") {
                yearEnd = parseInt(yearStart)
                appendYearEndOption(yearEnd)
            } else {
                yearEnd = parseInt(yearStart) + 1
                appendYearEndOption(yearEnd)
            }
        })

        modal.find('select').change(function() {
            let monthStart = getMonthStartVal()
            let monthEnd = getMonthEndVal()
            let yearStart = getYearStartVal()
            let yearEnd = getYearEndVal()

            nameVal = nameValInit + monthStart + '-' + yearStart + '/' + monthEnd + '-' + yearEnd
            nameInput.val(nameVal)
        })

        // Name input automatic filling

        $('#addFiscalYearForm').on('submit', function(e) {
            e.preventDefault()
            console.log($('#addFiscalYearForm').serialize())
            $.ajax({
                type: "POST",
                url: "/storeFiscalYear",
                data: $('#addFiscalYearForm').serialize(),
                success: function (response) {
                    modal.modal('hide')
                    location.reload()
                },
                error: function (error) {
                    alert('Une erreur est survenue à la création du compte ! :( ')
                }
            })
        })
    });
    $('#addFiscalYearModal').on('hide.bs.modal', function (event) {
        let modal = $(this)
        modal.find('.modal-body #addMonthEnd .monthEndOp').remove()
        modal.find('.modal-body #addMonthEnd .yearEndOp').remove()
    })
}(jQuery);
