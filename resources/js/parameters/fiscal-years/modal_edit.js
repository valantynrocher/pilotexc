$('#editFiscalYearModal').on('show.bs.modal', function(e) {
    let modal = $(this)
    let button = $(e.relatedTarget)
    let selectStatus = modal.find('#editStatus')
    let nameFiscalYear = modal.find('#nameFiscalYear')

    // Get account to edit
    $.ajax({
        type: 'GET',
        url: `/api/fiscalYears/edit/${button.data('id')}`,
        dataType: 'JSON',
        success: fiscalYearSurccess,
        error:function() {console.log(error.responseText.message)}
    })
    function fiscalYearSurccess(response) {
        selectStatus.val(response.status).prop('selected', true)
        nameFiscalYear.text(response.name)
        $('#editFiscalYearForm').append(`<input type='hidden' id="fiscalYearId" value='${response.id}'>`)
    }

    // Submit form
    $('#editFiscalYearForm').on('submit', function(e) {
        e.preventDefault()
        let fiscalYearId = modal.find('#fiscalYearId').val()

        $.ajax({
            type: "PATCH",
            url: `/api/fiscalYears/update/${fiscalYearId}`,
            data: $('#editFiscalYearForm').serialize(),
            success: function() {
                modal.modal('hide')
                location.reload()
            },
            error: function(error) {
                console.log(error.responseText.message)
                alert("Une erreur est survenue. Vérifiez que les champs marqués d'un * sont renseignés, puis recommencez.")
            }
        })

    })
})
