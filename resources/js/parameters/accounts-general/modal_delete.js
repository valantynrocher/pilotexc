    $('#deleteModal').on('show.bs.modal', function(e) {
        let modal = $(this)
        let button = $(e.relatedTarget)
        let accountId = button.data('id')

        modal.find('.modal-body p').text(`Voulez-vous supprimer le compte n° ${accountId} de votre plan de compte ?`)

        // Submit form
        $('#deleteForm').on('submit', function(e) {
            e.preventDefault()
            $.ajax({
                type: "DELETE",
                url: `/api/generalAccounts/destroy/${accountId}`,
                data: $('#deleteForm').serialize(),
                success: function() {
                    modal.modal('hide')
                    location.reload()
                },
                error: function(error) {console.log(error.responseText.message)}
            })
        })
    })
