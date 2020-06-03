var AddAnalyticAccount = function () {
    $('#addModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var modal = $(this)

        // Active toggle checkbox
        modal.find('.modal-body #addActive').prop('checked', true)
        modal.find('.modal-body #addActive').change(function() {
            if (this.checked) {
                modal.find('.modal-body #addActive').val(1)
            } else {
                modal.find('.modal-body #addActive').val(0)
            }
        })

        // Get Sectors options while changing folder
        $('#folder').on('change', function() {
            let folder_id = $(this).val()
            let add_sector_options = ''

            if (folder_id == 0) {
                $('#sector').prop("disabled", true)
                $('#service').prop("disabled", true)
            } else {
                $('#sector').prop("disabled", false)
            }

            $.ajax({
                type: 'GET',
                url: '/getSectors',
                data: {'id': folder_id},
                success: function(sectors) {
                    add_sector_options += '<option value="0" selected>Sélectionner un secteur...</option>'
                    sectors.forEach(sector => {
                        add_sector_options += '<option value="' + sector.id + '">' + sector.name + '</option>'
                    });

                    $('#sector').find('option').remove().end().append(add_sector_options)
                },
                error:function(){}
            })
        })

        // Get Services options while changing sector
        $('#sector').on('change', function() {
            let sector_id = $(this).val()
            let folder_id = $('#folder').val()
            let add_service_options = ''

            if (sector_id == 0) {
                $('#service').prop("disabled", true)
            } else {
                $('#service').prop("disabled", false)
            }

            $.ajax({
                type: 'GET',
                url: '/getServices',
                data: {'id': sector_id},
                success: function(services) {
                    add_service_options += '<option selected>Sélectionner un service...</option>'
                    services.forEach(service => {
                        add_service_options += '<option value="' + service.id + '">' + service.name + '</option>'
                    });

                    $('#service').find('option').remove().end().append(add_service_options)
                },
                error:function(){

                }
            })
        })

        $('#addForm').on('submit', function(e) {
            e.preventDefault()
            $.ajax({
                type: "POST",
                url: "/comptabilite-analytique",
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
