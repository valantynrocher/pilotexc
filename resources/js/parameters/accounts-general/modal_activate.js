$('#activateToggleModal').on('show.bs.modal', function(e) {
    let modal = $(this)
    let button = $(e.relatedTarget);

    // catch all selected accounts id into input fields
    $('.checkAccount:checkbox:checked').each(function(i) {
        let inputSelectedRows = ''
        let accountId = $(this).data('id')
        inputSelectedRows = `<input type='hidden' class='selectedRow' name='row${i}' value='${accountId}'>`
        modal.find('.selected-rows-list').append(inputSelectedRows)
    })

    modal.find('.modal-body p').text(`Êtes-vous sûr de modifier ${modal.find('.modal-body .selectedRow').length} comptes en ${button.data('state')} ?`)

    // Submit form
    $('#activateToggleForm').on('submit', function(e) {
        e.preventDefault()
        $.ajax({
            type: "POST",
            url: `/api/generalAccounts/${button.data('action')}`,
            data: $('#activateToggleForm').serialize(),
            success: function() {
                modal.modal('hide')
                location.reload()
            },
            error: function(error) {
                console.log(error.responseText.message)
                alert('Une erreur est survenue.')
            }
        })
    })
})
$('#activateToggleModal').on('hide.bs.modal', function() {
    $(this).find('.selected-rows-list').empty()
})

