@extends('layouts.app')


@section('title')Paramètres
@endsection


@section('content')
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-6">
            <!-- Fiscal years -->
            <div class="card card-default">
                <div class="card-header ">
                    <h4 class="card-title">Exercices comptables</h4>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <div>
                                <button type="button" class="btn btn-primary mb-2 mr-2" data-target="#addFiscalYearModal" data-toggle="modal"><i class="fas fa-plus-circle mr-2"></i>Créer</button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead class="thead-light">
                                <tr>
                                    <th>Libellé</th>
                                    <th>Début</th>
                                    <th>Fin</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($fiscalYears as $row)
                                    <tr>
                                        <td>{{$row->name}}</td>
                                        <td>
                                            @if ($row->month_start < 10)
                                                0{{$row->month_start}}
                                            @else
                                                {{$row->month_start}}
                                            @endif
                                            / {{$row->year_start}}
                                        </td>
                                        <td>
                                            @if ($row->month_end < 10)
                                                0{{$row->month_end}}
                                            @else
                                                {{$row->month_end}}
                                            @endif
                                            / {{$row->year_end}}
                                        </td>
                                        <td>
                                            <span class="badge @if ($row->status === 'En cours')badge-warning @elseif ($row->status === 'Clôturé') badge-danger @endif mr-2">
                                                {{$row->status}}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                                @if (count($fiscalYears) === 0)
                                    <tr>
                                        <td colspan="4">Aucune donnée à afficher</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Add Fiscal Year Modal -->
<div class="modal fade" id="addFiscalYearModal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Ajouter un exercice comptable</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form id="addFiscalYearForm">
                <div class="modal-body">
                    @csrf
                    <div class="row mb-3">
                        <div class="col">
                            <small>Les champs marqués d'un ** se complètent automatiquement.</small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8 form-group">
                            <label class="mr-3" for="addName">Libellé **</label>
                            <input type="text" name="name" id="addName" class="form-control" readonly>
                        </div>
                        <div class="col-4 form-group">
                            <label for="addStatus">Statut</label>
                            <select type="text" name="status" id="addStatus" class="form-control">
                                <option value="En cours">En cours</option>
                                <option value="Clôturé">Clôturé</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 form-group">
                            <label for="addMonthStart">Mois de début</label>
                            <select name="month_start" id="addMonthStart" class="form-control">
                                <option value="00">Sélectionnez un mois de début...</option>
                                <option value="01">Janvier</option>
                                <option value="02">Février</option>
                                <option value="03">Mars</option>
                                <option value="04">Avril</option>
                                <option value="05">Mai</option>
                                <option value="06">Juin</option>
                                <option value="07">Juillet</option>
                                <option value="08">Août</option>
                                <option value="09">Septembre</option>
                                <option value="10">Octobre</option>
                                <option value="11">Novembre</option>
                                <option value="12">Décembre</option>
                            </select>
                        </div>
                        <div class="col-6 form-group">
                            <label for="addYearStart">Année de début</label>
                            <select name="year_start" id="addYearStart" class="form-control">
                                <option value="0">Sélectionnez une année de début...</option>
                                <option value="2015">2015</option>
                                <option value="2016">2016</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 form-group">
                            <label for="addMonthEnd">Mois de fin **</label>
                            <select name="month_end" id="addMonthEnd" class="form-control" readonly>
                            </select>
                        </div>
                        <div class="col-6 form-group">
                            <label for="addYearEnd">Année de fin **</label>
                            <select name="year_end" id="addYearEnd" class="form-control" readonly>
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

@endsection


@section('script')

@endsection
