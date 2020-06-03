var AffectAnalyticAccount = function () {
    $('#affectModal').on('show.bs.modal', function(event) {
        var modal = $(this)
        var input = ''
        $('.checkAccount:checkbox:checked').each(function(i) {
            rowId = $(this).val()
            input = "<input type='hidden' class='selectedRow' name='row"+[i]+"' value='"+ rowId +"'>"
            modal.find('.modal-body .selected-rows-list').append(input)
        })

        modal.find('.modal-body p').text("Veuillez affecter les " + modal.find('.modal-body .selectedRow').length + " comptes sélectionnés :")

        // Get Sectors options while changing folder
        $('#affectFolder').on('change', function() {
            let folder_id = $(this).val()
            let affect_sector_options = ''

            if (folder_id == 0) {
                $('#affectSector').prop("disabled", true)
                $('#affectService').prop("disabled", true)
            } else {
                $('#affectSector').prop("disabled", false)
            }

            $.ajax({
                type: 'GET',
                url: '/getSectors',
                data: {'id': folder_id},
                success: function(sectors) {
                    affect_sector_options += '<option value="0" selected>Sélectionner un secteur...</option>'
                    sectors.forEach(sector => {
                        affect_sector_options += '<option value="' + sector.id + '">' + sector.name + '</option>'
                    });

                    $('#affectSector').find('option').remove().end().append(affect_sector_options)
                },
                error:function(){}
            })
        })
        // Get Services options while changing sector
        $('#affectSector').on('change', function() {
            let sector_id = $(this).val()
            let folder_id = $('#affectFolder').val()
            let affect_service_options = ''

            if (sector_id == 0) {
                $('#affectService').prop("disabled", true)
            } else {
                $('#affectService').prop("disabled", false)
            }

            $.ajax({
                type: 'GET',
                url: '/getServices',
                data: {'id': sector_id},
                success: function(services) {
                    affect_service_options += '<option selected>Sélectionner un service...</option>'
                    services.forEach(service => {
                        affect_service_options += '<option value="' + service.id + '">' + service.name + '</option>'
                    });

                    $('#affectService').find('option').remove().end().append(affect_service_options)
                },
                error:function(){

                }
            })
        })

        $('#affectForm').on('submit', function(e) {
            e.preventDefault()
            $.ajax({
                type: "POST",
                url: "/comptabilite-analytique/affect",
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
