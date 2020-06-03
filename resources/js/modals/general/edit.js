var EditGeneralAccount = function () {
    $('#editModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var datas = button.data('object')
        var modal = $(this)

        modal.find('.modal-body #editActive').change(function() {
            if (this.checked) {
                modal.find('.modal-body #editActive').val(1)
            } else {
                modal.find('.modal-body #editActive').val(0)
            }
        })

        // Fill form with datas of the row
        if(datas.active === 1) {
            modal.find('.modal-body #editActive').prop('checked', true)
            modal.find('.modal-body #editActive').val(1)
        } else {
            modal.find('.modal-body #editActive').prop('checked', false)
            modal.find('.modal-body #editActive').val(0)
        }

        modal.find('.modal-body #editId').val(datas.id)
        modal.find('.modal-body #editName').val(datas.name)

        if (datas.cerfa1_line !== null) {
            modal.find('.modal-body #editCerfa1Group').val(datas.cerfa1_line.cerfa1_group.id).prop("selected", true)
            // Get current line option
            let edit_line_options = ''
            $.ajax({
                type: 'GET',
                url: '/getCerfa1Lines',
                data: {'id': datas.cerfa1_line.cerfa1_group.id},
                success: function(lines) {
                    lines.forEach(line => {
                        edit_line_options += '<option value="' + line.id + '">' + line.name + '</option>'
                    });

                    $('#editCerfa1Line').find('option').remove().end().append(edit_line_options)
                    $('#editCerfa1Line').val(datas.cerfa1_line.id).prop("selected", true)
                },
                error:function(){}
            })

            // Get Lines options while changing group
            $('#editCerfa1Group').on('change', function() {
                let group_id = $(this).val()
                let edit_line_options = ''

                if (group_id == 0) {
                    $('#editCerfa1Line').prop("disabled", true)
                } else {
                    $('#editCerfa1Line').prop("disabled", false)
                }

                $.ajax({
                    type: 'GET',
                    url: '/getCerfa1Lines',
                    data: {'id': group_id},
                    success: function(lines) {
                        edit_line_options += '<option value="0" selected>Sélectionner une ligne...</option>'
                        lines.forEach(line => {
                            edit_line_options += '<option value="' + line.id + '">' + line.name + '</option>'
                        });

                        $('#editCerfa1Line').find('option').remove().end().append(edit_line_options)
                    },
                    error:function(){}
                })
            })
        } else {
            modal.find('.modal-body #editCerfa1Group').val(0)
            modal.find('#editCerfa1Line').find('option').remove().end().prop("disabled", true)
        }



        $('#editForm').on('submit', function(e) {
            e.preventDefault()
            $.ajax({
                type: "PATCH",
                url: "/comptabilite-generale/edit/" + datas.id,
                data: $('#editForm').serialize(),
                success: function (response) {
                    console.log(response)
                    modal.modal('hide')
                    location.reload()
                },
                error: function (error) {
                    console.log(error)
                    alert('Une erreur est survenue à la modification du compte ! :( ')
                }
            })
        })
    })
    $('#editModal').on('hide.bs.modal', function () {
        var modal = $(this)
        modal.find('.custom-select').prop("disabled", false)
    })
}(jQuery);
