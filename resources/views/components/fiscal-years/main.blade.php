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
                    {{-- @foreach ($fiscalYears as $row)
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
                    @endif --}}
                </tbody>
            </table>
        </div>
    </div>
</div>
