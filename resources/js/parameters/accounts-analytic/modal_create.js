$('#addModal').on('show.bs.modal', function () {
    let modal = $(this)
    let inputActive = modal.find('#addActive')
    let selectStructure = modal.find('#addStructure')
    let selectFolder = modal.find('#addFolder')
    let selectSector = modal.find('#addSector')
    let selectService = modal.find('#addService')

    // Check active toggle by default
    inputActive.prop('checked', true).change(function() {
        if (this.checked) {
            inputActive.val(1)
        } else {
            inputActive.val(0)
        }
    })

    // Get structures options
    $.ajax({
        type: 'GET',
        url: '/api/structures/',
        success: function(response) {
            response.forEach(structure => {
                selectStructure.append(`<option value=${structure.id}>${structure.name}</option>`)
            })
        },
        error:function() {console.log(error.responseText.message)}
    })

    // Get folders options
    $.ajax({
        type: 'GET',
        url: '/api/folders/',
        success: function(response) {
            response.forEach(folder => {
                selectFolder.append(`<option value=${folder.id}>${folder.name}</option>`)
            })
        },
        error:function() {console.log(error.responseText.message)}
    })

    // Listener for folder change
    selectFolder.on('change', function() {
        let folderId = $(this).val()
        let sectorOp = ''

        if (folderId == 0) {
            selectSector.empty().prop("disabled", true)
            selectService.empty().prop("disabled", true)
        } else {
            selectSector.prop("disabled", false)
        }
        selectService.empty().prop("disabled", true)

        $.ajax({
            type: 'GET',
            url: '/api/sectors/folder/' + folderId,
            success: success,
            error:function() {console.log(error.responseText.message)}
        })
        function success(response) {
            sectorOp += '<option value="0" selected>Sélectionner un secteur...</option>'
            response.forEach(sector => {
                sectorOp += `<option value="${sector.id}">${sector.name}</option>`
            });

            selectSector.find('option').remove().end().append(sectorOp)
        }
    })

    // Listener for sector change
    selectSector.on('change', function() {
        let sectorId = $(this).val()
        let serviceOp = ''

        if (sectorId == 0) {
            selectService.prop("disabled", true).empty()
        } else {
            selectService.prop("disabled", false)
        }

        $.ajax({
            type: 'GET',
            url: '/api/services/sector/' + sectorId,
            success: success,
            error:function() {console.log(error.responseText.message)}
        })
        function success(response) {
            serviceOp += '<option value="0" selected>Sélectionner un service...</option>'
            response.forEach(service => {
                serviceOp += `<option value="${service.id}">${service.name}</option>`
            });

            selectService.find('option').remove().end().append(serviceOp)
        }
    })

    // Submit form
    $('#addForm').on('submit', function(e) {
        e.preventDefault()
        $.ajax({
            type: "POST",
            url: "/api/analyticAccounts",
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
    $(this).find('#addStructure').empty().append("<option value='0'>Sélectionner une structure...</option>")
    $(this).find('#addFolder').empty().append("<option value='0'>Sélectionner un dossier...</option>")
    $(this).find('#addSector').empty().prop("disabled", true)
    $(this).find('#addService').empty().prop("disabled", true)
})
