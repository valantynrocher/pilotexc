@extends('layouts.app')


@section('title')Comptabilité analytique
@endsection


@section('content')
<!-- Main content -->
<section class="content">
    <!-- Advanced features card -->
    <div class="card">
        <div class="card-header bg-pink">
            <h4 class="card-title bg-pink">
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
                            <button type="button" class="btn btn-primary mb-2 mr-2" data-target="#addModal" data-toggle="modal"><i class="fas fa-plus-circle mr-2"></i>Créer</button>
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
                            <select class="custom-select filter-select" data-column="7" id="activeSelect">
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
        <div class="card-header bg-maroon">
            <h4 class="card-title bg-maroon">
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
                <!-- Analytic accounts table -->
                <table id="analytic-accounts" class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th><input type="checkbox" id="checkAll"></th>
                            <th>Section</th>
                            <th>Libellé</th>
                            <th>Service</th>
                            <th>Secteur</th>
                            <th>Dossier</th>
                            <th>Structure</th>
                            <th>Actif</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $row)
                            <tr>
                                <td class="align-middle" id="selectCell"><input type="checkbox" class="checkAccount" value="{{ $row->id }}"></td>
                                <td class="align-middle">{{ $row->id }}</td>
                                <td class="align-middle">
                                    @if ($row->active === 1)
                                        <span class="badge badge-success mr-2">Actif</span>
                                    @else
                                        <span class="badge badge-danger mr-2">Inactif</span>
                                    @endif
                                    {{ $row->name }}
                                </td>
                                <td class="align-middle">{{ $row->service }}</td>
                                <td class="align-middle">{{ $row->sector }}</td>
                                <td class="align-middle">{{ $row->folder }}</td>
                                <td class="align-middle">{{ $row->structure }}</td>
                                <td class="text-center align-middle">
                                    <span class="invisible">{{ $row->active }}</span>
                                </td>
                                <td class="align-middle text-center">
                                    <a class="btn bg-maroon btn-sm m-2" href="#editModal" id="editAccountBtn" data-toggle="modal" data-object="{{ $row }}">
                                        <i class="fas fa-pencil-alt mr-1"></i> Éditer
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th><input type="checkbox" id="checkAll"></th>
                            <th>Section</th>
                            <th>Libellé</th>
                            <th>Service</th>
                            <th>Secteur</th>
                            <th>Dossier</th>
                            <th>Structure</th>
                            <th>Actif</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->

<!-- Add Modal -->
<div class="modal fade" id="addModal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Ajouter un compte analytique</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form id="addForm">
                <div class="modal-body">

                    @csrf

                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label for="addId">Code</label>
                            <input type="number" name="id" id="addId" class="form-control" required>
                            <small>Saisir un numéro non présent dans votre plan de compte actuel</small>
                        </div>
                        <div class="col-md-7 form-group">
                            <label for="addName">Libellé de compte</label>
                            <input type="text" name="name" id="addName" class="form-control" required>
                        </div>
                        <div class="col-md-2 form-group p-4">
                            <div class="custom-control custom-switch custom-switch-off-normal custom-switch-on-info">
                                <input type="checkbox" name="active" class="custom-control-input" id="addActive" value="1">
                                <label class="custom-control-label" for="addActive">Actif</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="addService">Service</label>
                            <input type="text" name="service" id="addService" class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="addSector">Secteur</label>
                            <input type="text" name="sector" id="addSector" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="addFolder">Dossier</label>
                            <input type="text" name="folder" id="addFolder" class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="addStructure">Structure</label>
                            <input type="text" name="structure" id="addStructure" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Créer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Import Modal -->


<!-- Activate Modal -->
<div class="modal fade" id="activateToggleModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Action sur la sélection</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="activateToggleForm">
                @csrf
                <div class="modal-body">
                    <p></p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info">Confirmer</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Edit Modal -->
<div class="modal fade" id="editModal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Modifier le compte analytique</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form id="editForm">
                <div class="modal-body">

                    @csrf

                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label for="editId">Code</label>
                            <input type="number" name="id" id="editId" class="form-control" disabled required>
                        </div>
                        <div class="col-md-7 form-group">
                            <label for="editName">Libellé de compte</label>
                            <input type="text" name="name" id="editName" class="form-control" required>
                        </div>
                        <div class="col-md-2 form-group p-4">
                            <div class="custom-control custom-switch custom-switch-off-normal custom-switch-on-info">
                                <input type="checkbox" name="active" class="custom-control-input" id="editActive" value="1">
                                <label class="custom-control-label" for="editActive">Actif</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="editService">Service</label>
                            <input type="text" name="service" id="editService" class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="editSector">Secteur</label>
                            <input type="text" name="sector" id="editSector" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="editFolder">Dossier</label>
                            <input type="text" name="folder" id="editFolder" class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="editStructure">Structure</label>
                            <input type="text" name="structure" id="editStructure" class="form-control">
                        </div>
                    </div>

                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-info" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-info">Sauvegarder</button>
                </div>
            </form>
        </div>
    </div>
</div>
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
                        url: "/comptabilite-analytique/" + action,
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
            modal.find('.modal-body #editService').val(datas.service)
            modal.find('.modal-body #editSector').val(datas.sector)
            modal.find('.modal-body #editFolder').val(datas.folder)
            modal.find('.modal-body #editStructure').val(datas.structure)

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
    </script>
@endsection
