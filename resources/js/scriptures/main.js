const url = "/api/scriptures"

// Datatable init
let table = $('#scriptures').DataTable( {
    processing: true,
    ajax: {
        url: url,
        type: 'GET',
        dataSrc: ''
    },
    columns: [
        {
            className: 'details-control text-center',
            orderable: false,
            data: null,
            defaultContent: '<i class="fas fa-plus-circle toggleChildRow"></i>'
        },
        {
            targets: 1,
            data: "title"
        },
        {
            targets: 2,
            data: "status",
            render: function(data) {
                let badgeClass = ''
                if (data === 'En cours') {
                    badgeClass = 'badge-warning'
                } else if (data === 'Clôturé') {
                    badgeClass = 'badge-danger'
                }
                return `<span class="badge ${badgeClass} mr-2">
                ${data}
                </span>`
            }
        },
        {
            targets: 3,
            data: "count",
            className: 'text-center',
        },
        {
            targets: 4,
            data: "result",
            render: function(data) {
                let badgeClass = ''
                let result = data.toFixed(0).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1 ')
                if (parseInt(result) >= 0) {
                    badgeClass = 'badge-success'
                } else {
                    badgeClass = 'badge-danger'
                }
                return `<span class="badge ${badgeClass} mr-2">
                ${result} €
                </span>`
            },
            className: 'text-center',
        }
    ],
    language: {
        "zeroRecords": "Aucun résultat",
        "info": "Affiche de _START_ à _END_ sur _TOTAL_ lignes",
        "infoEmpty": "",
        "emptyTable": "Aucune donnée à afficher. Importez d'abord vos écritures comptables.",
        "infoFiltered": "(Filtré par _MAX_ total entrées)",
        "decimal": ",",
        "thousands": " "
    },
    paging: false
})

/* Formatting function for row details */
function format(d) {
    // `d` is the original data object for the row
    let structures = d.structures
    let childTable = $('<table class="table table-bordered"></table>').append('<thead></thead>').append('<tr></tr>')
    childTable.append('<th scope="col">Structure</th><th scope="col">Écritures</th><th scope="col">Résultat</th>')

    $.each(structures, function(key, object) {
        let result = object.result
        result = result.toFixed(0).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1 ')

        let badgeClass = ''
        if (parseInt(result) >= 0) {
            badgeClass = 'badge-success'
        } else {
            badgeClass = 'badge-danger'
        }
        childTable.append('<tbody></tbody>').append(`<td>${object.name}</td><td>${object.count}</td><td><span class="badge ${badgeClass} mr-2">
        ${result} €</span></td>`)
    })
    return childTable
}

// Add event listener for opening and closing details
$('#scriptures tbody').on('click', 'td.details-control', function(e) {
    var tr = $(this).closest('tr');
    var row = table.row(tr);
    $(e.currentTarget).find('.toggleChildRow').toggleClass('fa-plus-circle').toggleClass('fa-minus-circle')

    if (row.child.isShown()) {
        // This row is already open - close it
        row.child.hide();
        tr.removeClass('shown');
    }
    else {
        // Open this row
        row.child(format(row.data())).show();
        tr.addClass('shown');

    }
} );

// Hide default search row
$('.dataTables_wrapper .row:first-child').hide()

// reload icon : spin on hover
$('.fa-sync-alt').hover(function() {
    $(this).addClass('fa-spin')
}, function() {
    $(this).removeClass('fa-spin')
})
// reload data in the table
$('#reloadAccounts').click(function(e) {
    e.preventDefault()
    $.ajax({
        type: "GET",
        url: url,
        success: function () {
            table.ajax.reload()
        },
        error: function () {
            alert('Impossible de charger les données.')
        }
    })
})
