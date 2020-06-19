$('#importModal').on('show.bs.modal', function() {
    let modal = $(this)
    let selectFiscalYear = modal.find('#fiscalYear')
    let submitBtn = modal.find('#submitImport')

    // Get fiscal year options
    $.ajax({
        type: 'GET',
        url: `/api/fiscalYears/inProgress`,
        dataType: 'JSON',
        success: success,
        error:function() {console.log(error.responseText.message)}
    })
    function success(response) {
        response.forEach(fiscalYear => {
            selectFiscalYear.append(`<option value="${fiscalYear.id}">${fiscalYear.name}</option>`)
        })
    }

    // Submit form
    $('#addFiscalYearForm').on('submit', function(e) {
        e.preventDefault()
        let formData = new FormData($(this)[0]);
        $.ajax({
            type: "POST",
            url: "/api/scriptures/import",
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function() {
                submitBtn.empty().html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Patientez...`)
            },
            success: function() {
                submitBtn.empty().removeClass('btn-primary').addClass('btn-success').html(`<i class="fas fa-check-circle"></i> Réussi !`)
                setTimeout(function() {
                    modal.modal('hide')
                    location.reload()
                }, 1000)
            },
            error: function(error) {
                console.log(error)
                submitBtn.empty().removeClass('btn-primary').addClass('btn-danger').html(`<i class="fas fa-times-circle"></i> Échec !`)
                setTimeout(function() {
                    alert("Une erreur est survenue pendant l'import. Si l'erreur persiste, contactez le support Pilotexc.")
                }, 1000)
            }
        })
    })
})
$('#importModal').on('hide.bs.modal', function() {
    $(this).find('#fiscalYear').find('option').remove().end().append(`<option value="0">Sélectionnez un exercice comptable...</option>`)
})
