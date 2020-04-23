@extends('layouts.app')


@section('title')Gestion des écritures
@endsection


@section('content')
<!-- Main content -->
<section class="content">
    <!-- Advanced features card -->
    <div class="card">
        <div class="card-header bg-olive">
            <h4 class="card-title bg-olive">
                <a data-toggle="collapse" href="#advancedFeatures" class="" aria-expanded="true">
                    Fonctionnalités <i class="right fas fa-angle-down ml-2"></i>
                  </a>
            </h4>
        </div>
        <div id="advancedFeatures" class="panel-collapse in collapse show" style="">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <div>
                            <h6>Actions</h6>
                        </div>
                        <div>
                            <button type="button" class="btn btn-primary disabled"><i class="fas fa-file-import mr-2"></i>Importer</button>
                        </div>
                    </div>
                    <div class="col-md-5 mb-3">
                        <div>
                            <h6>Filtrer par</h6>
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend"><label class="input-group-text">Actif</label></div>
                            <select class="custom-select filter-select" data-column="4" id="activeSelect">
                                <option value="">Tous</option>
                                <option value="1">Oui</option>
                                <option value="0">Non</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <div class="input-group-prepend"><label class="input-group-text">Recherche</label></div>
                            <input type="text" id="searchInput" class="form-control" placeholder="Votre mot-clé">
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div>
                            <h6>Actions sur sélection en cours</h6>
                        </div>
                        <div class="mb-2">
                            <button type="button" id="affectBtn" class="select-action btn btn-info disabled">
                                <i class="fas fa-folder-open mr-2"></i>Affecter
                            </button>
                        </div>
                        <div>
                            <button type="button" id="activateBtn" class="select-action btn btn-info mb-2 mr-2 disabled"
                            data-target="#activateToggleModal" data-action="activate" data-state="Actif" data-toggle="modal">
                                <i class="fas fa-check-circle mr-2"></i>Activer
                            </button>

                            <button type="button" id="desactivateBtn" class="select-action btn btn-info mb-2 disabled"
                            data-target="#activateToggleModal" data-action="desactivate" data-state="Inactif" data-toggle="modal">
                                <i class="fas fa-times-circle mr-2"></i>Désactiver
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Accounts list card -->
    <div class="card">
        <div class="card-header bg-teal">
            <h4 class="card-title bg-teal">
                Liste des comptes <a href="#" id="reloadAccounts"><i class="fas fa-sync-alt ml-2"></i></a>
            </h4>
        </div>

        {{-- <!-- Uploading form -->
            <form>
                @csrf
                <div class="form-group">
                    <label>Sélectionnez un fichier à importer</label>
                    <small>(Taille maximum : 5 Mo, Formats acceptés : *.xlsx, *.xls, *.csv)</small>
                </div>
                <div class="form-group">
                    <input type="file" class="mr-5" name="select_file">
                    <input type="submit" value="Importer" class="btn btn-danger">
                </div>
            </form> --}}
        <div id="accountsTable" class="panel-collapse in collapse show" style="">
            <div class="card-body">
                <!-- General accounts table -->
                <table id="general-accounts" class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th><input type="checkbox" id="checkAll"></th>
                            <th>Code</th>
                            <th>Sous-classe de compte</th>
                            <th>Libellé</th>
                            <th>Actif</th>
                            <th class="text-center">CERFA 1</th>
                            <th class="text-center">CERFA 2</th>
                            <th class="text-center">CERFA 3</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th>Code</th>
                            <th>Sous-classe de compte</th>
                            <th>Libellé</th>
                            <th>Actif</th>
                            <th class="text-center">CERFA 1</th>
                            <th class="text-center">CERFA 2</th>
                            <th class="text-center">CERFA 3</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection


@section('script')
    <!-- DataTables -->
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="../../plugins/toastr/toastr.min.js"></script>

    <script>
        $(document).ready(function () {
            // DataTable
            var table = $('#general-accounts').DataTable({
                scrollable: true,
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
                        "targets": [ 2, 4 ],
                        "visible": false
                    }
                ]
            });

            // Hide default search row
            $('#general-accounts_wrapper .row:first-child').hide();

            // Activate Toggle Modal script (action on rows selection only)
            $('#activateToggleModal').on('show.bs.modal', function (event) {
                var modal = $(this)
                var input = ''
                $('.checkAccount:checkbox:checked').each(function(i) {
                    rowId = $(this).val()
                    input = "<input type='hidden' class='selectedRow' name='row"+[i]+"' value='"+ rowId +"'>"
                    modal.find('.modal-body').append(input)
                })
                var button = $(event.relatedTarget);
                var action = button.data('action');
                var state = button.data('state')

                modal.find('.modal-body p').text("Êtes-vous sûr de modifier " + modal.find('.modal-body .selectedRow').length + " comptes en '" + state + "' ?")

                $('#activateToggleForm').on('submit', function(e) {
                    e.preventDefault()
                    $.ajax({
                        type: "POST",
                        url: "/comptabilite-generale/" + action,
                        data: $('#activateToggleForm').serialize(),
                        success: function (response) {
                            console.log(response)
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
                    url: "/comptabilite-generale",
                    success: function (response) {
                        location.reload()
                    },
                    error: function (error) {
                        console.log(error)
                        alert('Une erreur est survenue ! :( ')
                    }
                })
            });
        })

        // Edit Modal script
        $('#editModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var datas = button.data('object') // Extract info from data-id attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            if(datas.active === 1) {
                modal.find('.modal-body #editActive').prop('checked', true)
                modal.find('.modal-body #editActive').val(1)
            } else {
                modal.find('.modal-body #editActive').prop('checked', false)
                modal.find('.modal-body #editActive').val(0)
            }
            modal.find('.modal-body #editId').val(datas.id)
            modal.find('.modal-body #editName').val(datas.name)
            modal.find('.modal-body #editLineCerfa1').val(datas.cerfa_line1)
            modal.find('.modal-body #editGroupCerfa1').val(datas.cerfa_group1)
            modal.find('.modal-body #editLineCerfa2').val(datas.cerfa_line2)
            modal.find('.modal-body #editGroupCerfa2').val(datas.cerfa_group2)
            modal.find('.modal-body #editLineCerfa3').val(datas.cerfa_line3)
            modal.find('.modal-body #editGroupCerfa3').val(datas.cerfa_group3)

            modal.find('.modal-body #editActive').change(function() {
                if (this.checked) {
                    modal.find('.modal-body #editActive').val(1)
                } else {
                    modal.find('.modal-body #editActive').val(0)
                }
            })

            $('#editForm').on('submit', function(e) {
                e.preventDefault()
                $.ajax({
                    type: "PATCH",
                    url: "/comptabilite-generale/edit/" + datas.id,
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

        // Add Modal script
        $('#addModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)

            modal.find('.modal-body #addActive').prop('checked', true)

            modal.find('.modal-body #addActive').change(function() {
                if (this.checked) {
                    modal.find('.modal-body #addActive').val(1)
                } else {
                    modal.find('.modal-body #addActive').val(0)
                }
            })

            $('#addForm').on('submit', function(e) {
                e.preventDefault()
                $.ajax({
                    type: "POST",
                    url: "/comptabilite-generale",
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
    </script>
@endsection
