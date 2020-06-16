$('#editModal').on('show.bs.modal', function(e) {
    let modal = $(this)
    let button = $(e.relatedTarget)
    let inputId = modal.find('#editId')
    let inputName = modal.find('#editName')
    let inputActive = modal.find('#editActive')
    let selectCerfaGroup = modal.find('#editCerfa1Group')
    let selectCerfaLine = modal.find('#editCerfa1Line')

    // Get account to edit
    $.ajax({
        type: 'GET',
        url: `/api/generalAccounts/edit/${button.data('id')}`,
        dataType: 'JSON',
        success: accountSuccess,
        error:function() {console.log(error.responseText.message)}
    })
    function accountSuccess(account) {
        // fill id field
        inputId.val(account.id)

        // fill name field
        inputName.val(account.name)

        // fill active toggle field
        if(account.active === 1) {
            inputActive.val(1).prop('checked', true)
        } else {
            inputActive.val(0).prop('checked', false)
        }
        // update toggle activation field value
        inputActive.change(function() {
            if (this.checked) {
                inputActive.val(1)
            } else {
                inputActive.val(0)
            }
        })

        // Get cerfa groups options
        $.ajax({
            type: 'GET',
            url: '/api/cerfa1/groups',
            success: function(response) {
                response.forEach(cerfaGroup => {
                    selectCerfaGroup.append(`<option value=${cerfaGroup.id}>${cerfaGroup.name}</option>`)
                });
            },
            error:function(){console.log(error.responseText.message)}
        })

        // Check if current account is affected to a cerfa line
        if (account.cerfa1_line !== null) {
            selectCerfaGroup.val(account.cerfa1_line.cerfa1_groupId).prop("selected", true)

            // Get cerfa line options
            let lineOp = ''
            $.ajax({
                type: 'GET',
                url: `/api/cerfa1/group/${account.cerfa1_line.cerfa1_groupId}/lines`,
                success: cerfaLinesSuccess,
                error:function(){console.log(error.responseText.message)}
            })
            function cerfaLinesSuccess(response) {
                response.forEach(line => {
                    lineOp += `<option value="${line.id}">${line.name}</option>`
                });
                // Clear cerfa line options / append new options / select current cerfa line
                selectCerfaLine.find('option').remove().end().append(lineOp).val(account.cerfa1_line.id).prop("selected", true).prop("disabled", false)
            }
        } else {
            selectCerfaGroup.val(0)
            selectCerfaLine.find('option').remove().end().prop("disabled", true)
        }
    }

    // Listener for cerfa group change
    selectCerfaGroup.on('change', function() {
        let groupId = $(this).val()
        let newLineOp = ''

        if (groupId == 0) {
            selectCerfaLine.prop("disabled", true)
        } else {
            selectCerfaLine.prop("disabled", false)
        }

        // Get new cerfa line options
        $.ajax({
            type: 'GET',
            url: `/api/cerfa1/group/${groupId}/lines`,
            success: cerfaLinesChangeSuccess,
            error:function() {console.log(error.responseText.message)}
        })
        function cerfaLinesChangeSuccess(response) {
            newLineOp += '<option value="0" selected>Sélectionner une ligne...</option>'
            response.forEach(line => {
                newLineOp += `<option value="${line.id}">${line.name}</option>`
            });
            // Clear cerfa line options / append new options
            selectCerfaLine.find('option').remove().end().append(newLineOp)
        }
    })

    // Submit form
    $('#editForm').on('submit', function(e) {
        e.preDefault()
        let accountId = inputId.val()

        $.ajax({
            type: "PATCH",
            url: `/api/generalAccounts/update/${accountId}`,
            data: $('#editForm').serialize(),
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
$('#editModal').on('hide.bs.modal', function () {
    $(this).find('input').val('')
    $(this).find('#editCerfa1Group').find('option').remove().end().append("<option value='0'>Sélectionner un groupe...</option>")
    $(this).find('#editCerfa1Line').find('option').remove().end().prop("disabled", true)
})
