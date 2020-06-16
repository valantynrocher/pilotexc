let url = "/api/analyticAccounts"

// Datatable init
let table = $('#analytic-accounts').DataTable( {
    processing: true,
    ajax: {
        url: url,
        dataSrc: ''
    },
    columnDefs: [
        {
            targets: 0,
            data: null,
            className: 'align-middle text-center selectRow',
            searchable: false,
            orderable: false,
            render: function (data, type, full, meta) {
                return `<input type="checkbox" class="checkAccount" id="check_${data.id}" data-id="${data.id}">`
            },
            width: "5%"
        },
        {
            targets: 1,
            data: "id",
            className: 'align-middle',
            width: "10%"
        },
        {
            targets: 2,
            data: null,
            render: function (data, type, full, meta) {
                if(data.active) {
                    return `<span class="badge badge-success mr-2">Actif</span> ${data.name}`
                } else {
                    return `<span class="badge badge-danger mr-2">Inactif</span> ${data.name}`
                }
            },
            className: 'align-middle',
            width: "25%"
        },
        {
            targets: 3,
            data: null,
            className: 'align-middle',
            render: function (data, type, full, meta) {
                if(data.structure_id !== null) {
                    return `<span class="badge badge-secondary">${data.structure.name}</span>`
                } else {
                    return '<small><i class="fas fa-exclamation-circle"></i> Aucune affectation<small>'
                }
            },
        },
        {
            targets: 4,
            data: null,
            className: 'align-middle',
            render: function (data, type, full, meta) {
                if(data.service_id !== null) {
                    return `${data.service.name}
                    <br>
                    <small>Secteur : </small><span class="badge badge-info">${data.service.sector.name}</span>
                    <br>
                    <small>Dossier : </small><span class="badge badge-info">${data.service.sector.folder.name}</span>`
                } else {
                    return '<small><i class="fas fa-exclamation-circle"></i> Aucune affectation<small>'
                }
            },
        },
        {
            targets: 5,
            data: "active",
            visible: false
        },
        {
            targets: -1,
            data: null,
            className: "align-middle text-center actions-cell",
            render: function (data, type, full, meta) {
                return `<a class="btn bg-teal btn-sm m-2 editAccountBtn" href="#editModal" data-toggle="modal" data-id="${data.id}">
                <i class="fas fa-pencil-alt"></i>
                </a>
                <a class="btn btn-outline-danger btn-sm m-2 deleteAccountBtn" href="#deleteModal" data-toggle="modal" data-id="${data.id}">
                <i class="fas fa-trash"></i>
                </a>`
            },
            orderable: false,
            width: "15%"
        }],
        language: {
            "zeroRecords": "Aucun résultat",
            "info": "Affiche de _START_ à _END_ sur _TOTAL_ lignes",
            "infoEmpty": "",
            "emptyTable": "Aucune donnée à afficher. Importez d'abord votre plan de compte",
            "infoFiltered": "(Filtré par _MAX_ total entrées)",
            "decimal": ",",
            "thousands": " "
        },
        scrollY: 300,
        scrollCollapse: true,
        order: [[1, 'asc']],
        paging: false,
    })

// reload data in the table
$('#reloadAccounts').click(function(e) {
    e.preventDefault()
    $.ajax({
        type: "GET",
        url: url,
        success: function (response) {
            table.ajax.reload()
        },
        error: function (error) {
            alert('Impossible de charger les données.')
        }
    })
})

// Filter 'active'
$('#activeSelect').change(function() {
    table.column( $(this).data('column') )
    .search( $(this).val() )
    .draw()
})

// Search input
$('#searchInput').on( 'keyup', function () {
    table.search( this.value ).draw()
})

// reload icon : spin on hover
$('.fa-sync-alt').hover(function() {
    $(this).addClass('fa-spin')
}, function() {
    $(this).removeClass('fa-spin')
})

// Hide default search row
$('.dataTables_wrapper .row:first-child').hide()

// Rows "select all"
$('#checkAll').change(function() {
    $('.checkAccount').prop('checked', $(this).prop('checked'))
})

// Enabled or disabled actions button for selection
$('.dataTables_wrapper').on('change', "input:checkbox", function() {
    if ($('.dataTables_wrapper').find('input:checkbox:checked').length > 0) {
        $('.select-action').removeClass('disabled')
        $('.select-action').css('pointer-events', 'initial')
    } else {
        $('.select-action').addClass('disabled')
        $('.select-action').css('pointer-events', 'none')
    }
})
