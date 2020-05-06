@extends('layouts.app')

@section('title')Rapports
@endsection

@section('subTitle')
@endsection


@section('content')
<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <!-- AREA CHART 1 -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Évolution analytique par secteur</h3>
                    </div>
                    <div class="card-body" style="display: block;">
                        <form action="" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="sectorSelect">Secteur :</label>
                                <select name="sector" class="form-control" id="sectorSelect">
                                    @foreach ($sectorOp as $op)
                                        <option value="{{$op->id}}">{{$op->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                        <div id="app">
                            {!! $chart->container() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    {!! $chart->script() !!}
    <script>
        $('#sectorSelect').change(function() {
            let sector_id = $(this).val()
            console.log({{ $chart->id }}_api_url)
            {{ $chart->id }}_refresh('/chart-data/' + sector_id);
        })
    </script>
@endsection
