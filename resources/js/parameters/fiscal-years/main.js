const url = "/api/fiscalYears"

// Datatable init
let table = $('#fiscal-years').DataTable( {
    processing: true,
    ajax: {
        url: url,
        dataSrc: ''
    },
    columnDefs: [
        {
            targets: 0,
            data: "name"
        },
        {
            targets: 1,
            data: null,
            render: function(data) {
                let monthStart = ''
                if (data.month_start < 10) {
                    monthStart = `0${data.month_start}`
                } else {
                    monthStart = data.month_start
                }
                return `${monthStart}/${data.year_start}`
            }
        },
        {
            targets: 2,
            data: null,
            render: function(data) {
                let monthEnd = ''
                if (data.month_end < 10) {
                    monthEnd = `0${data.month_end}`
                } else {
                    monthEnd = data.month_end
                }
                return `${monthEnd}/${data.year_end}`
            }
        },
        {
            targets: 3,
            data: null,
            render: function(data) {
                let badgeClass = ''
                if (data.status === 'En cours') {
                    badgeClass = 'badge-warning'
                } else if (data.status === 'Clôturé') {
                    badgeClass = 'badge-danger'
                }
                return `<span class="badge ${badgeClass} mr-2">
                    ${data.status}
                </span>`
            }
        },
        {
            targets: -1,
            data: null,
            className: "align-middle text-center actions-cell",
            render: function(data) {
                return  `<a class="btn btn-warning btn-sm m-2 editFiscalYearBtn" href="#editFiscalYearModal" data-toggle="modal" data-id="${data.id}">
                <i class="fas fa-pencil-alt"></i>
                </a>`
            },
            orderable: false,
        }
    ],
    language: {
        "zeroRecords": "Aucun résultat",
        "info": "Affiche de _START_ à _END_ sur _TOTAL_ lignes",
        "infoEmpty": "",
        "emptyTable": "Aucune donnée à afficher. Ajoutez votre premier exercice comptable.",
        "infoFiltered": "(Filtré par _MAX_ total entrées)",
        "decimal": ",",
        "thousands": " "
    },
    scrollY: 300,
    scrollCollapse: true,
    order: [[1, 'asc']],
    paging: false,
})

// Hide default search row
$('.dataTables_wrapper .row:first-child').hide()
