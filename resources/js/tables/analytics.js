var AnalyticsTable = function () {
    var table = $('#analytic-accounts').DataTable({
        paging: false,
        language: {
            "zeroRecords": "Aucun résultat",
            "info": "Affiche de _START_ à _END_ sur _TOTAL_ lignes",
            "infoEmpty": "",
            "emptyTable": "Aucune donnée à afficher. Importez d'abord votre plan de compte",
            "infoFiltered": "(Filtré par _MAX_ total entrées)",
            "decimal": ",",
            "thousands": " "
        },
        columnDefs: [
            {
                "targets": [ 7 ],
                "visible": false
            }
        ]
    });

    $('#analytic-accounts_wrapper .row:first-child').hide();

    // Rows "select all"
    $('#checkAll').change(function() {
        $('.checkAccount').prop('checked', $(this).prop('checked'))
    });

    // Enabled or disabled actions button for selection
    $('.checkAccount, #checkAll').change(function() {
        if ($('input:checkbox:checked').length > 0) {
            $('.select-action').removeClass('disabled')
            $('.select-action').css('pointer-events', 'initial')
        } else {
            $('.select-action').addClass('disabled')
            $('.select-action').css('pointer-events', 'none')

        }
    })

    // Filter 'active'
    $('#activeSelect').change(function() {
        table.column( $(this).data('column') )
        .search( $(this).val() )
        .draw();
        console.log($(this).val())
    });

    $('#searchInput').on( 'keyup', function () {
        table.search( this.value ).draw();
    } );

    // spin effect on hover icon
    $('.fa-sync-alt').hover(function() {
        $(this).addClass('fa-spin');
    }, function() {
        $(this).removeClass('fa-spin');
    });

    // reloading page
    $('#reloadAccounts').click(function(e) {
        e.preventDefault()
        $.ajax({
            type: "GET",
            url: "/comptabilite-analytique",
            success: function (response) {
                location.reload()
            },
            error: function (error) {
                console.log(error)
                alert('Une erreur est survenue ! :( ')
            }
        })
    });
}(jQuery);

