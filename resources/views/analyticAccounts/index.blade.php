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
                            <button type="button" class="btn mb-2 mr-2 bg-pink" data-target="#addModal" data-toggle="modal"><i class="fas fa-plus-circle mr-2"></i>Créer</button>
                        </div>
                        <div>
                            <button type="button" class="btn bg-pink disabled"><i class="fas fa-file-import mr-2"></i>Importer</button>
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
                            <button type="button" id="affectBtn" class="select-action btn btn-info disabled"
                            data-target="#affectModal" data-toggle="modal">
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
                <table id="analytic-accounts" class="table table-bordered table-hover" style="width:100%">
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
                        @foreach ($accounts as $row)
                            <tr data-id="{{ $row->id }}">
                                <td class="align-middle selection-cell checkbox-cell" id="selectCell"><input type="checkbox" class="checkAccount" value="{{ $row->id }}"></td>
                                <td class="align-middle selection-cell">{{ $row->id }}</td>
                                <td class="align-middle selection-cell">
                                    @if ($row->active === 1)
                                        <span class="badge badge-success mr-2">Actif</span>
                                    @else
                                        <span class="badge badge-danger mr-2">Inactif</span>
                                    @endif
                                    {{ $row->name }}
                                </td>
                                <td class="align-middle selection-cell">{{ $row->service['name'] }}</td>
                                <td class="align-middle selection-cell">{{ $row->service['sector']['name'] }}</td>
                                <td class="align-middle selection-cell">{{ $row->service['sector']['folder']['name'] }}</td>
                                <td class="align-middle selection-cell">{{ $row->structure['name'] }}</td>
                                <td class="text-center align-middle selection-cell">
                                    <span class="invisible">{{ $row->active }}</span>
                                </td>
                                <td class="align-middle text-center actions-cell">
                                    <a class="btn bg-maroon btn-sm m-2" href="#editModal" id="editAccountBtn" data-toggle="modal" data-object="{{ $row }}">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <a class="btn btn-outline-danger btn-sm m-2" href="#deleteModal" id="deleteAccountBtn" data-toggle="modal" data-id="{{ $row->id }}">
                                        <i class="fas fa-trash"></i>
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
                        <div class="col-lg-2 col-4 form-group p-4">
                            <div class="custom-control custom-switch custom-switch-off-normal custom-switch-on-info">
                                <input type="checkbox" name="active" class="custom-control-input" id="addActive" value="1">
                                <label class="custom-control-label" for="addActive">Actif</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-8 form-group">
                            <label for="addId">Code</label>
                            <input type="number" name="id" id="addId" class="form-control" required>
                            <small>Saisir un code non présent dans votre plan de compte.</small>
                        </div>
                        <div class="col-lg-7 col-sm-12 form-group">
                            <label for="addName">Libellé de compte</label>
                            <input type="text" name="name" id="addName" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 form-group">
                            <label for="addStructure">Structure</label>
                            <select name="structure_id" id="addStructure" class="custom-select">
                                <option value="0" selected>Sélectionner une structure...</option>
                                @foreach ($structures as $structure)
                                    <option value="{{ $structure->id }}">{{ $structure->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6 form-group">
                            <label for="folder">Dossier</label>
                            <select name="folder" id="folder" class="custom-select">
                                <option value="0" selected>Sélectionner un dossier...</option>
                                @foreach ($folders as $folder)
                                    <option value="{{ $folder->id }}">{{ $folder->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6 form-group">
                            <label for="sector">Secteur</label>
                            <select name="sector" id="sector" class="custom-select" disabled>
                            </select>
                        </div>
                        <div class="col-lg-6 form-group">
                            <label for="service">Service</label>
                            <select name="service_id" id="service" class="custom-select" disabled>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn bg-pink">Créer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Affect Modal -->
<div class="modal fade" id="affectModal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Affecter la sélection de comptes</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form id="affectForm">
                <div class="modal-body">
                    <p></p>
                    <div class="selected-rows-list"></div>
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 form-group">
                            <label for="affectStructure">Structure</label>
                            <select name="structure_id" id="affectStructure" class="custom-select">
                                <option value="0" selected>Sélectionner une structure...</option>
                                @foreach ($structures as $structure)
                                    <option value="{{ $structure->id }}">{{ $structure->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6 form-group">
                            <label for="affectFolder">Dossier</label>
                            <select name="folder" id="affectFolder" class="custom-select">
                                <option value="0" selected>Sélectionner un dossier...</option>
                                @foreach ($folders as $folder)
                                    <option value="{{ $folder->id }}">{{ $folder->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6 form-group">
                            <label for="affectSector">Secteur</label>
                            <select name="sector" id="affectSector" class="custom-select" disabled>
                            </select>
                        </div>
                        <div class="col-lg-6 form-group">
                            <label for="affectService">Service</label>
                            <select name="service_id" id="affectService" class="custom-select" disabled>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-info">Confirmer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Activate/Desactivate Modal -->
<div class="modal fade" id="activateToggleModal" style="display: none;" aria-hidden="true">
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
                    <div class="selected-rows-list"></div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" id="selectCloseModal" data-dismiss="modal">Close</button>
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
                        <div class="col-lg-2 col-4 form-group p-4">
                            <div class="custom-control custom-switch custom-switch-off-normal custom-switch-on-info">
                                <input type="checkbox" name="active" class="custom-control-input" id="editActive" value="1">
                                <label class="custom-control-label" for="editActive">Actif</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-8 form-group">
                            <label for="editId">Code</label>
                            <input type="number" name="id" id="editId" class="form-control" disabled required>
                        </div>
                        <div class="col-lg-7 col-sm-12 form-group">
                            <label for="editName">Libellé de compte</label>
                            <input type="text" name="name" id="editName" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 form-group">
                            <label for="editStructure">Structure</label>
                            <select name="structure_id" id="editStructure" class="custom-select">
                                <option value="0" selected>Sélectionner une structure...</option>
                                @foreach ($structures as $structure)
                                    <option value="{{ $structure->id }}">{{ $structure->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6 form-group">
                            <label for="editFolder">Dossier</label>
                            <select name="folder" id="editFolder" class="custom-select">
                                <option value="0" selected>Sélectionner un dossier...</option>
                                @foreach ($folders as $folder)
                                    <option value="{{ $folder->id }}">{{ $folder->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6 form-group">
                            <label for="editSector">Secteur</label>
                            <select name="sector" id="editSector" class="custom-select">
                            </select>
                        </div>
                        <div class="col-lg-6 form-group">
                            <label for="editService">Service</label>
                            <select name="service_id" id="editService" class="custom-select">
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn bg-maroon">Sauvegarder</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-danger">
            <div class="modal-header">
                <h6 class="modal-title">Supprimer le compte analytique</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="deleteForm">
                @csrf
                <div class="modal-body">
                    <p></p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-outline-light">Confirmer</button>
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

            // Rows "select all"
            $('#checkAll').change(function() {
                $('.checkAccount').prop('checked', $(this).prop('checked'))
            });

            // selection while click on the line
            // $('table > tbody > tr > td.selection-cell').click(function(event) {
            //     event.stopPropagation();
            //     var $this = $(this);
            //     var trId = $this.closest('tr').data('id');
            //     var inputElt = $('tr[data-id='+trId+'] > td.checkbox-cell > input:checkbox')
            //     inputElt.prop("checked", !inputElt.prop("checked"))
            // })

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

        // Add Modal script
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

        // Affect Modal script
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

        // Activate Toggle Modal script (action on rows selection only)
        $('#activateToggleModal').on('show.bs.modal', function (event) {
            var modal = $(this)
            var input = ''
            $('.checkAccount:checkbox:checked').each(function(i) {
                rowId = $(this).val()
                input = "<input type='hidden' class='selectedRow' name='row"+[i]+"' value='"+ rowId +"'>"
                modal.find('.modal-body .selected-rows-list').append(input)
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
        $('#activateToggleModal').on('hide.bs.modal', function () {
            var modal = $(this)
            modal.find('.modal-body .selected-rows-list').empty()
        })

        // Edit Modal script
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

        // Delete Modal script
        $('#deleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var modal = $(this)

            modal.find('.modal-body p').text("Voulez-vous supprimer le compte n° " + id + " de votre plan de compte ?")

            $('#deleteForm').on('submit', function(e) {
                e.preventDefault()
                $.ajax({
                    type: "DELETE",
                    url: "/comptabilite-analytique/destroy/" + id,
                    data: $('#deleteForm').serialize(),
                    success: function (response) {
                        modal.modal('hide')
                        location.reload()
                    },
                    error: function (error) {
                        alert('Une erreur est survenue :( ')
                    }
                })
            })
        })
    </script>
@endsection
