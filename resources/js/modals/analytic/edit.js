var EditAnalyticAccount = function () {
    $('#editModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var datas = button.data('object')
        var modal = $(this)

        console.log(datas)

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

        let data_folder_id = datas.service.sector.folder.id
        let data_sector_id = datas.service.sector.id
        let data_service_id = datas.service.id

        modal.find('.modal-body #editId').val(datas.id)
        modal.find('.modal-body #editName').val(datas.name)
        modal.find('.modal-body #editStructure').val(datas.structure_id).prop("selected", true)
        modal.find('.modal-body #editFolder').val(data_folder_id).prop("selected", true)

        let folder_select = modal.find('#editFolder')
        let sector_select = modal.find('#editSector')
        let service_select = modal.find('#editService')

        // Get current sector and sectors list according to current folder affected to current row
        let sectors_options = ''
        $.ajax({
            type: 'GET',
            url: '/getSectors',
            data: {'id': data_folder_id},
            success: function(sectors) {
                sectors.forEach(sector => {
                    sectors_options += '<option value="' + sector.id + '">' + sector.name + '</option>'
                });

                sector_select.find('option').remove().end().append(sectors_options)
                sector_select.val(data_sector_id).prop("selected", true)
            },
            error:function(){}
        })

        // Get current service and services list according to current sector affected to current row
        let services_options = ''
        $.ajax({
            type: 'GET',
            url: '/getServices',
            data: {'id': data_sector_id},
            success: function(services) {
                services.forEach(service => {
                    services_options += '<option value="' + service.id + '">' + service.name + '</option>'
                });

                service_select.find('option').remove().end().append(services_options)
                service_select.val(data_service_id).prop("selected", true)
            },
            error:function(){}
        })

        // Change Sectors options while changing folder select
        modal.find(folder_select).on('change', function() {
            let folder_id = $(this).val()

            sector_select.find('option').remove().end()
            service_select.find('option').remove().end().prop("disabled", true)

            if (folder_id == 0) {
                sector_select.prop("disabled", true)
            } else {
                sector_select.prop("disabled", false)
            }

            let new_sectors_options = ''

            $.ajax({
                type: 'GET',
                url: '/getSectors',
                data: {'id': folder_id},
                success: function(sectors) {
                    sector_select.empty()
                    new_sectors_options += '<option value="0" selected>Sélectionner un secteur...</option>'
                    sectors.forEach(sector => {
                        new_sectors_options += '<option value="' + sector.id + '">' + sector.name + '</option>'
                    });

                    sector_select.find('option').remove().end().append(new_sectors_options)
                },
                error:function(){}
            })
        })

        // Change Services options while changing sector select
        modal.find(sector_select).on('change', function() {
            let sector_id = $(this).val()

            if (sector_id == 0) {
                service_select.prop("disabled", true)
            } else {
                service_select.prop("disabled", false)
            }

            let new_services_options = ''

            $.ajax({
                type: 'GET',
                url: '/getServices',
                data: {'id': sector_id},
                success: function(services) {
                    new_services_options += '<option selected>Sélectionner un service...</option>'
                    services.forEach(service => {
                        new_services_options += '<option value="' + service.id + '">' + service.name + '</option>'
                    });

                    service_select.find('option').remove().end().append(new_services_options)
                },
                error:function(){}
            })
        })

        // Send datas
        $('#editForm').on('submit', function(e) {
            e.preventDefault()
            $.ajax({
                type: "PATCH",
                url: "/comptabilite-analytique/edit/" + datas.id,
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
