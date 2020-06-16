$('#addModal').on('show.bs.modal', function() {
    let modal = $(this)
    let inputActive = modal.find('#addActive')
    let selectCerfaGroup = modal.find('#addCerfa1Group')
    let selectCerfaLine = modal.find('#addCerfa1Line')

    // Check active toggle by default
    inputActive.prop('checked', true).change(function() {
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
            success: cerfaLinesChangeSuccess,
            error:function(){console.log(error.responseText.message)}
        })
        function cerfaLinesChangeSuccess(response) {
            lineOp += '<option value="0" selected>Sélectionner une ligne...</option>'
            response.forEach(line => {
                lineOp += `<option value="${line.id}">${line.name}</option>`
            })
            selectCerfaLine.find('option').remove().end().append(lineOp)
        }
    })

    // Submit form
    $('#addForm').on('submit', function(e) {
        e.preventDefault()
        $.ajax({
            type: "POST",
            url: "/api/generalAccounts",
            data: $('#addForm').serialize(),
            success: function() {
                modal.modal('hide')
                location.reload()
            },
            error: function(error) {
                console.log(error.responseText.message)
                alert("Une erreur est survenue. Vérifiez ceci : les champs marqués d'un * sont renseignés, le code que vous tentez d'ajouter n'existe pas déjà ; puis recommencez.")
            }
        })
    })
})
$('#addModal').on('hide.bs.modal', function () {
    $(this).find('input').val('')
    $(this).find('#addCerfa1Group').find('option').remove().end().append("<option value='0'>Sélectionner un groupe...</option>")
    $(this).find('#addCerfa1Line').find('option').remove().end().prop("disabled", true)
})
