var DeleteAnalyticAccount = function () {
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var modal = $(this)

        modal.find('.modal-body p').text("Voulez-vous supprimer le compte n° " + id + " de votre plan de compte ?")

        $('#deleteForm').on('submit', function(e) {
            e.preventDefault()
            $.ajax({
                type: "DELETE",
                url: "/comptabilite-analytique/destroy/" + id,
                data: $('#deleteForm').serialize(),
                success: function (response) {
                    modal.modal('hide')
                    location.reload()
                },
                error: function (error) {
                    alert('Une erreur est survenue :( ')
                }
            })
        })
    })
}(jQuery);
