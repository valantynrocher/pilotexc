@extends('layouts.app')


@section('title')Comptabilité générale
@endsection


@section('content')
<!-- Main content -->
<section class="content">
    <!-- Advanced features card -->
    <div class="card">
        <div class="card-header bg-olive">
            <h4 class="card-title bg-olive">Fonctionnalités</h4>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
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

    <!-- Accounts list card -->
    <div class="card">
        <div class="card-header bg-teal">
            <h4 class="card-title bg-teal">
                Liste des comptes <a href="#" id="reloadAccounts"><i class="fas fa-sync-alt ml-2"></i></a>
            </h4>
        </div>

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
                            <th>CERFA 1</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($accounts as $row)
                            <tr data-id="{{ $row->id }}">
                                <td class="align-middle selection-cell checkbox-cell" id="selectCell"><input type="checkbox" class="checkAccount" value="{{ $row->id }}"></td>
                                <td class="align-middle selection-cell">{{ $row->id }}</td>
                                <td class="align-middle selection-cell">{{ $row->account_subclass_id }}</td>
                                <td class="align-middle selection-cell">
                                    @if ($row->active === 1)
                                        <span class="badge badge-success mr-2">Actif</span>
                                    @else
                                        <span class="badge badge-danger mr-2">Inactif</span>
                                    @endif
                                    {{ $row->name }}
                                </td>
                                <td class="text-center align-middle selection-cell">
                                    <span class="invisible">{{ $row->active }}</span>
                                </td>
                                <td class="align-middle selection-cell">
                                    <small>Groupe : </small>{{ $row->cerfa1Line['cerfa1Group']['name'] }}<br>
                                    <small>Ligne : </small>{{ $row->cerfa1Line['name'] }}
                                </td>
                                <td class="align-middle text-center actions-cell">
                                    <a class="btn bg-teal btn-sm m-2" href="#editModal" id="editAccountBtn" data-toggle="modal" data-object="{{ $row }}">
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
                            <th></th>
                            <th>Code</th>
                            <th>Sous-classe de compte</th>
                            <th>Libellé</th>
                            <th>Actif</th>
                            <th>CERFA 1</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</section>


<!-- Add Modal -->
<div class="modal fade" id="addModal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Ajouter un compte général</h6>
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

                    <div class="form-group mb-2">
                        Regroupement CERFA 1
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="addCerfa1Group">Groupe</label>
                            <select name="cerfa1_group" id="addCerfa1Group" class="custom-select">
                                <option value="0" selected>Sélectionner un groupe...</option>
                                @foreach ($cerfa1Groups as $group)
                                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="addCerfa1Line">Ligne</label>
                            <select name="cerfa1_line_id" id="addCerfa1Line" class="custom-select" disabled>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Créer</button>
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
                    <div class="form-group mb-2">
                        Regroupement CERFA 1
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="affectCerfa1Group">Groupe</label>
                            <select name="cerfa1_group" id="affectCerfa1Group" class="custom-select">
                                <option value="0" selected>Sélectionner un groupe...</option>
                                @foreach ($cerfa1Groups as $group)
                                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="affectCerfa1Line">Ligne</label>
                            <select name="cerfa1_line_id" id="affectCerfa1Line" class="custom-select" disabled>
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
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Annuler</button>
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
                <h6 class="modal-title">Modifier le compte général</h6>
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
                                <input type="checkbox" name="active" class="custom-control-input" id="editActive">
                                <label class="custom-control-label" for="editActive">Actif</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-2">
                        Regroupement CERFA 1
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="editCerfa1Group">Groupe</label>
                            <select name="cerfa1_group" id="editCerfa1Group" class="custom-select">
                                <option value="0">Sélectionner un groupe...</option>
                                @foreach ($cerfa1Groups as $group)
                                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="editCerfa1Line">Ligne</label>
                            <select name="cerfa1_line_id" id="editCerfa1Line" class="custom-select">
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn bg-teal">Sauvegarder</button>
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
                <h6 class="modal-title">Supprimer le compte général</h6>
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
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="{{ asset('plugins/toastr/toastr.min.js')}}"></script>
@endsection
