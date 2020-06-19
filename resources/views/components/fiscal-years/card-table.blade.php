@section('plugins.Datatables', true)

<div class="card">
    <div id="fiscalYearsTable" class="panel-collapse in collapse show" style="">
        <div class="card-body">
            <div class="table-responsive p-0">
                <table id="fiscal-years" class="table table-hover text-nowrap">
                    <thead class="thead-light">
                        <tr>
                            <th>Libellé</th>
                            <th>Début</th>
                            <th>Fin</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- <tr>
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
                        </tr> --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
