var ActivateGeneralAccount = function () {
    $('#activateToggleModal').on('show.bs.modal', function (event) {
        var modal = $(this)
        var input = ''
        $('.checkAccount:checkbox:checked').each(function(i) {
            rowId = $(this).val()
            input = "<input type='hidden' class='selectedRow' name='row"+[i]+"' value='"+ rowId +"'>"
            modal.find('.selected-rows-list').append(input)
        })
        var button = $(event.relatedTarget);
        var action = button.data('action');
        var state = button.data('state')

        modal.find('.modal-body p').text("Êtes-vous sûr de modifier " + modal.find('.modal-body .selectedRow').length + " comptes en '" + state + "' ?")

        $('#activateToggleForm').on('submit', function(e) {
            e.preventDefault()
            $.ajax({
                type: "POST",
                url: "/comptabilite-generale/" + action,
                data: $('#activateToggleForm').serialize(),
                success: function (response) {
                    console.log(response)
                    modal.modal('hide')
                    location.reload()
                },
                error: function (error) {
                    console.log(error)
                    alert('Une erreur est survenue :( ')
                }
            })
        })
    })
    $('#activateToggleModal').on('hide.bs.modal', function () {
        var modal = $(this)
        modal.find('.modal-body .selected-rows-list').empty()
    })
}(jQuery);

