$('#editModal').on('show.bs.modal', function(e) {
    let modal = $(this)
    let button = $(e.relatedTarget)
    let inputId = modal.find('#editId')
    let inputName = modal.find('#editName')
    let inputActive = modal.find('#editActive')
    let selectStructure = modal.find('#editStructure')
    let selectFolder = modal.find('#editFolder')
    let selectSector = modal.find('#editSector')
    let selectService = modal.find('#editService')

    // Get account to edit
    $.ajax({
        type: 'GET',
        url: `/api/analyticAccounts/edit/${button.data('id')}`,
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
        // update active value according to toggle status
        inputActive.change(function() {
            if (this.checked) {
                inputActive.val(1)
            } else {
                inputActive.val(0)
            }
        })

        // Get structures options
        $.ajax({
            type: 'GET',
            url: '/api/structures',
            success: function(response) {
                response.forEach(structure => {
                    selectStructure.append(`<option value=${structure.id}>${structure.name}</option>`)
                })
                selectStructure.val(account.structure_id).prop("selected", true)
            },
            error:function() {console.log(error.responseText.message)}
        })

        // Get folder options
        $.ajax({
            type: 'GET',
            url: '/api/folders',
            success: function(response) {
                response.forEach(folder => {
                    selectFolder.append(`<option value=${folder.id}>${folder.name}</option>`)
                })
                if(account.service !== null) {
                    // Select current folder
                    selectFolder.val(account.service.sector.folder.id).prop("selected", true)
                }
            },
            error:function() {console.log(error.responseText.message)}
        })

        // Check if current account is affected to a service
        if(account.service !== null) {
            // Get sector options
            let sectorOp = ''
            $.ajax({
                type: 'GET',
                url: `/api/sectors/folder/${account.service.sector.folder.id}`,
                success: sectorsSuccess,
                error:function() {console.log(error.responseText.message)}
            })
            function sectorsSuccess(response) {
                response.forEach(sector => {
                    sectorOp += `<option value="${sector.id}">${sector.name}</option>`
                })
                // Clear sector options / append new options / select current sector
                selectSector.append(sectorOp).val(account.service.sector.id).prop("selected", true).prop("disabled", false)
            }

            // Get service options
            let serviceOp = ''
            $.ajax({
                type: 'GET',
                url: `/api/services/sector/${account.service.sector.id}`,
                success: servicesSuccess,
                error:function() {console.log(error.responseText.message)}
            })
            function servicesSuccess(response) {
                response.forEach(service => {
                    serviceOp += `<option value="${service.id}">${service.name}</option>`
                })
                // Clear service options / append new options / select current service
                selectService.append(serviceOp).val(account.service.id).prop("selected", true).prop("disabled", false)
            }
        } else {
            selectFolder.val(0)
            selectSector.find('option').remove().end().prop("disabled", true)
            selectService.find('option').remove().end().prop("disabled", true)
        }
    }

    // Listener for folder change
    selectFolder.on('change', function() {
        let folderId = $(this).val()
        let newSectorOp = ''

        if (folderId == 0) {
            selectSector.empty().prop("disabled", true)
            selectService.empty().prop("disabled", true)
        } else {
            selectSector.prop("disabled", false)
        }
        selectService.empty().prop("disabled", true)

        // Get new sector options
        $.ajax({
            type: 'GET',
            url: `/api/sectors/folder/${folderId}`,
            success: sectorsChangeSuccess,
            error:function() {console.log(error.responseText.message)}
        })
        function sectorsChangeSuccess(response) {
            newSectorOp += '<option value="0" selected>Sélectionner un secteur...</option>'
            response.forEach(sector => {
                newSectorOp += `<option value="${sector.id}">${sector.name}</option>`
            })
            // Clear sector options / append new options
            selectSector.find('option').remove().end().append(newSectorOp)
        }
    })

    // Listener for sector change
    selectSector.on('change', function() {
        let sectorId = $(this).val()
        let newServiceOp = ''

        if (sectorId == 0) {
            selectService.empty().prop("disabled", true)
        } else {
            selectService.prop("disabled", false)
        }

        // Get new service options
        $.ajax({
            type: 'GET',
            url: `/api/services/sector/${sectorId}`,
            success: servicesChangeSuccess,
            error:function() {console.log(error.responseText.message)}
        })
        function servicesChangeSuccess(services) {
            newServiceOp += '<option selected>Sélectionner un service...</option>'
            services.forEach(service => {
                newServiceOp += `<option value="${service.id}">${service.name}</option>`
            })
            // Clear service options / append new options
            selectService.find('option').remove().end().append(newServiceOp)
        }
    })

    // Submit form
    $('#editForm').on('submit', function(e) {
        e.preventDefault()
        let accountId = inputId.val()

        $.ajax({
            type: "PATCH",
            url: `/api/analyticAccounts/update/${accountId}`,
            data: $('#editForm').serialize(),
            success: function () {
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
    $(this).find('#editStructure').find('option').remove().end().append("<option value='0'>Sélectionner une structure...</option>")
    $(this).find('#editFolder').find('option').remove().end().append("<option value='0'>Sélectionner un dossier...</option>")
    $(this).find('#editSector').find('option').remove().end().prop("disabled", true)
    $(this).find('#editService').find('option').remove().end().prop("disabled", true)
})
