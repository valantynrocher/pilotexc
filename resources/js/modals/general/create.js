var AddGeneralAccount = function () {
    $('#addModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)

        modal.find('.modal-body #addActive').prop('checked', true)

        modal.find('.modal-body #addActive').change(function() {
            if (this.checked) {
                modal.find('.modal-body #addActive').val(1)
            } else {
                modal.find('.modal-body #addActive').val(0)
            }
        })

        // Get Sectors options while changing group
        $('#addCerfa1Group').on('change', function() {
            let group_id = $(this).val()
            let add_line_options = ''

            if (group_id == 0) {
                $('#addCerfa1Line').prop("disabled", true)
            } else {
                $('#addCerfa1Line').prop("disabled", false)
            }

            $.ajax({
                type: 'GET',
                url: '/getCerfa1Lines',
                data: {'id': group_id},
                success: function(lines) {
                    add_line_options += '<option value="0" selected>Sélectionner une ligne...</option>'
                    lines.forEach(line => {
                        add_line_options += '<option value="' + line.id + '">' + line.name + '</option>'
                    });

                    $('#addCerfa1Line').find('option').remove().end().append(add_line_options)
                },
                error:function(){}
            })
        })

        $('#addForm').on('submit', function(e) {
            e.preventDefault()
            $.ajax({
                type: "POST",
                url: "/comptabilite-generale",
                data: $('#addForm').serialize(),
                success: function (response) {
                    console.log(response)
                    modal.modal('hide')
                    location.reload()
                },
                error: function (error) {
                    console.log(error)
                    alert('Une erreur est survenue à la création du compte ! :( ')
                }
            })
        })
    })
}(jQuery);
