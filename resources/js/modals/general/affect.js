var AffectGeneralAccount = function () {
    $('#affectModal').on('show.bs.modal', function(event) {
        var modal = $(this)
        var input = ''
        $('.checkAccount:checkbox:checked').each(function(i) {
            rowId = $(this).val()
            input = "<input type='hidden' class='selectedRow' name='row"+[i]+"' value='"+ rowId +"'>"
            modal.find('.modal-body .selected-rows-list').append(input)
        })

        modal.find('.modal-body p').text("Veuillez affecter les " + modal.find('.modal-body .selectedRow').length + " comptes sélectionnés :")

        // Get lines options while changing group
        $('#affectCerfa1Group').on('change', function() {
            let group_id = $(this).val()
            let affect_cerfa1Line_options = ''

            if (group_id == 0) {
                $('#affectCerfa1Line').prop("disabled", true)
            } else {
                $('#affectCerfa1Line').prop("disabled", false)
            }

            $.ajax({
                type: 'GET',
                url: '/getCerfa1Lines',
                data: {'id': group_id},
                success: function(lines) {
                    affect_cerfa1Line_options += '<option value="0" selected>Sélectionner un secteur...</option>'
                    lines.forEach(line => {
                        affect_cerfa1Line_options += '<option value="' + line.id + '">' + line.name + '</option>'
                    });

                    $('#affectCerfa1Line').find('option').remove().end().append(affect_cerfa1Line_options)
                },
                error:function(){}
            })
        })

        $('#affectForm').on('submit', function(e) {
            e.preventDefault()
            $.ajax({
                type: "POST",
                url: "/comptabilite-generale/affect",
                data: $('#affectForm').serialize(),
                success: function (response) {
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
    $('#affectModal').on('hide.bs.modal', function () {
        var modal = $(this)
        modal.find('.modal-body .selected-rows-list').empty()
    })
}(jQuery);
