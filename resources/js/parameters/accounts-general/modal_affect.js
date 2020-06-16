$('#affectModal').on('show.bs.modal', function() {
    let modal = $(this)
    let selectCerfaGroup = modal.find('#affectCerfa1Group')
    let selectCerfaLine = modal.find('#affectCerfa1Line')

    // catch all selected accounts id into input fields
    $('.checkAccount:checkbox:checked').each(function(i) {
        let inputSelectedRows = ''
        let accountId = $(this).data('id')
        inputSelectedRows = `<input type='hidden' class='selectedRow' name='row${i}' value='${accountId}'>`
        modal.find('.selected-rows-list').append(inputSelectedRows)
    })

    // show info message with number of selected accounts
    modal.find('.modal-body p').text(`Veuillez affecter les ${modal.find('.modal-body .selectedRow').length} comptes sélectionnés :`)

    // Get cerfa groups options
    $.ajax({
        type: 'GET',
        url: '/api/cerfa1/groups',
        success: function(response) {
            response.forEach(cerfaGroup => {
                selectCerfaGroup.append(`<option value="${cerfaGroup.id}">${cerfaGroup.name}</option>`)
            })
        },
        error:function() {console.log(error.responseText.message)}
    })


    // Listener for cerfa group change
    selectCerfaGroup.on('change', function() {
        let groupId = $(this).val()
        let lineOp = ''

        if (groupId == 0) {
            selectCerfaLine.prop("disabled", true)
        } else {
            selectCerfaLine.prop("disabled", false)
        }

        $.ajax({
            type: 'GET',
            url: `/api/cerfa1/group/${groupId}/lines`,
            success: success,
            error:function(){console.log(error.responseText.message)}
        })
        function success(response) {
            lineOp += '<option value="0" selected>Sélectionner un secteur...</option>'
            response.forEach(line => {
                lineOp += `<option value="${line.id}">${line.name}</option>`
            })

            selectCerfaLine.find('option').remove().end().append(lineOp)
        }
    })

    $('#affectForm').on('submit', function(e) {
        e.preventDefault()
        $.ajax({
            type: "POST",
            url: "/api/generalAccounts/affect",
            data: $('#affectForm').serialize(),
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
$('#affectModal').on('hide.bs.modal', function() {
    $(this).find('.selected-rows-list').empty()
    $(this).find('#affectCerfa1Group').empty().append("<option value='0'>Sélectionner un groupe...</option>")
    $(this).find('#affectCerfa1Line').empty().prop("disabled", true)
})
