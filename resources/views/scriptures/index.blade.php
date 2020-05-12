@extends('layouts.app')


@section('title')Gestion des écritures
@endsection


@section('content')
<!-- Main content -->
<section class="content">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> Succès !</h5>
            {{ session('success') }}
        </div>
    @endif
    <!-- Advanced features card -->
    <div class="card">
        <div class="card-header bg-indigo">
            <h4 class="card-title bg-indigo">Fonctionnalités</h4>
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
                        <button type="button" class="btn btn-primary" data-target="#importModal" data-toggle="modal"><i class="fas fa-file-import mr-2"></i>Importer</button>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div>
                        <h6></h6>
                    </div>
                    <div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scriptures resume card -->
    <div class="card">
        <div class="card-header bg-lightblue">
            <h4 class="card-title bg-lightblue">Résumé de mes exercices</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead class="thead-light">
                        <tr>
                            <th>Exercices</th>
                            @foreach ($structures as $structure)
                                <th class="text-right">{{$structure->name}}</th>
                            @endforeach
                            <th class="text-right">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($exercises as $exercise => $results)
                            <tr>
                                <td>{{$exercise}}</td>
                                @foreach ($results['Structures'] as $structure => $result)
                                    <td class="text-right">{{number_format($result, 0, ',', ' ')}} €</td>
                                @endforeach
                                <td class="text-right">
                                    <h5><span class="badge @if ($results['Total'] >= 0) badge-success
                                    @else badge-danger @endif">{{number_format($results['Total'], 0, ',', ' ')}} €</span></h5>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<!-- Import Modal -->
<div class="modal fade" id="importModal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Importer les écritures</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="addFiscalYearForm" action="{{route('scriptures.import')}}" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-exclamation-triangle"></i> Lisez bien ceci :</h5>
                        - chaque import s'effectue sur un exercice comptable unique <br>
                        - l'import ne peut se faire que pour un exercice 'En cours' <br>
                        - l'application enregistre automatiquement les écritures qui correspondent à l'exercice choisit<br>
                        - les écritures précédemment importées seront écrasées<br>
                        - votre fichier d'écritures doit être structuré ainsi : section analytique, code général, date, journal, n° pièce, libellé, montant débit, montant crédit, type (Situation, Réalisé)
                    </div>
                    @csrf
                    <div class="form-group">
                        <label for="fiscalYear">Exercice comptable : </label>
                        <select name="fiscal_year_id" class="form-control" id="fiscalYear" required>
                            <option value="">Sélectionnez un exercice comptable...</option>
                            @foreach ($inProgressFiscalYears as $exercise)
                                <option value="{{$exercise->id}}">{{$exercise->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="scripturesImport">Sélectionnez un fichier à importer</label>
                        <input type="file" class="form-control mr-5" name="scriptures" id="scripturesImport" aria-describedby="fileHelp" required>
                        <small id="fileHelp" class="form-text text-muted">(Taille maximum : 5 Mo, Formats acceptés : *.xlsx, *.xls, *.csv)</small>
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Importer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


@section('script')

@endsection
