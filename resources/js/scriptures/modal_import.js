$('#importModal').on('show.bs.modal', function() {
    let modal = $(this)
    let selectFiscalYear = modal.find('#fiscalYear')
    let scripturesInfo = modal.find('#checkScripturesInfo')
    let formStep2 = modal.find('#step2')
    let formStep3 = modal.find('#step3')
    let inputFile = modal.find('#scripturesImport')
    let inputAmountCheck = modal.find('#amountCheck')
    let amountCheckBtn = modal.find('#amountCheckBtn')
    let amountCheckInfo = modal.find('#amountCheckInfo')
    let submitBtn = modal.find('#submitImport')

    // Get fiscal year options
    $.ajax({
        type: 'GET',
        url: `/api/fiscalYears/inProgress`,
        dataType: 'JSON',
        success: function (response) {
            response.forEach(fiscalYear => {
                selectFiscalYear.append(`<option value="${fiscalYear.id}">${fiscalYear.name}</option>`)
            })
        },
        error:function() {console.log(error.responseText.message)}
    })


    // Listener for fiscal year change to get number of existing scriptures
    selectFiscalYear.on('change', function() {
        let fiscalYearId = $(this).val()
        if(fiscalYearId > 0) {
            $.ajax({
                type: "GET",
                url: `/api/scriptures/countExistingScriptures/${fiscalYearId}`,
                beforeSend: function() {
                    scripturesInfo.html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Calcul en cours...`).removeClass('d-none')
                },
                success: success,
                error: function(error) {
                    console.log(error)
                    scripturesInfo.html('Erreur')
                    formStep2.addClass('d-none')
                }
            })
            function success(response) {
                scripturesInfo.html(`Il y a actuellement <strong>${response.count}</strong> écriture(s) pour cet exercice.`)
                formStep2.removeClass('d-none')
            }
        } else {
            scripturesInfo.addClass('d-none')
            formStep2.addClass('d-none')
            inputFile.val('')
            formStep3.addClass('d-none')
            inputAmountCheck.val('')
        }
    })

    // Listener for file input
    inputFile.on('change', function() {
        let inputValue = $(this).val()
        if(inputValue) {
            formStep3.removeClass('d-none')
        } else {
            formStep3.addClass('d-none')
        }
    })

    // Listener for check amount change
    inputAmountCheck.on('change', function() {
        let amountToCheck = $(this).val()
        if (amountToCheck > 0) {
            amountCheckBtn.removeAttr('disabled')
        } else {
            amountCheckBtn.attr('disabled', 'disabled')
        }
    })

    // listener for checking amount button
    amountCheckBtn.on('click', function(e) {
        e.preventDefault()
        amountCheckInfo.empty().removeClass('alert-success alert-danger').addClass('d-none')
        let formData = new FormData($('#importScriptures')[0])

        $.ajax({
            type: "POST",
            url: "/api/scriptures/checkImportAmount",
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function() {
                amountCheckBtn.empty().html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Patientez...`)
            },
            success: success,
            error: function(error) {
                alert('Une erreur est survenue.')
                console.log(error)
                amountCheckBtn.empty().html('Vérifier')
            }
        })
        function success(response) {
            amountCheckInfo.removeClass('d-none').html(response.message)
            if(response.validate) {
                amountCheckBtn.empty().html(`<i class="fas fa-check-circle"></i>`).attr('disabled', 'disabled')
                submitBtn.removeAttr('disabled')
                amountCheckInfo.addClass('alert-success')
            } else {
                amountCheckBtn.empty().html('Vérifier')
                amountCheckInfo.addClass('alert-danger')
            }
        }
    })

    // Submit form
    $('#importScriptures').on('submit', function(e) {
        e.preventDefault()
        $.ajax({
            type: "POST",
            url: "/api/scriptures/import",
            data: $(this).serialize(),
            beforeSend: function() {
                submitBtn.empty().html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Patientez...`)
            },
            success: function() {
                submitBtn.empty().removeClass('btn-primary').addClass('btn-success').html(`<i class="fas fa-check-circle"></i> Ok !`)
                setTimeout(function() {
                    modal.modal('hide')
                    location.reload()
                }, 1000)
            },
            error: function(error) {
                console.log(error)
                submitBtn.empty().removeClass('btn-primary').addClass('btn-danger').html(`<i class="fas fa-times-circle"></i> Échec !`)
                alert("Une erreur est survenue pendant l'import. Si l'erreur persiste, contactez le support Pilotexc.")
                setTimeout(function() {
                    modal.modal('hide')
                }, 1000)
            }
        })
    })
})
$('#importModal').on('hide.bs.modal', function() {
    $(this).find('#fiscalYear').find('option').remove().end().append(`<option value="0">Sélectionnez un exercice comptable...</option>`)
    $(this).find('#scripturesImport').val('')
    $(this).find('#amountCheck').val('')
    $(this).find('#amountCheckBtn').removeAttr('disabled').empty().html('Vérifier')
    $(this).find('#checkScripturesInfo').empty().addClass('d-none')
    $(this).find('#step2, #step3').addClass('d-none')
    $(this).find('#amountCheckInfo').empty().removeClass('alert-success', 'alert-danger').addClass('d-none')

    $.ajax({
        type: "GET",
        url: "/api/scriptures/truncateTempScriptures"
    })
})
