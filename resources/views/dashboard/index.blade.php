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
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Évolution analytique des charges et produits en k€</h3>
                    </div>
                    <div class="card-body" style="display: block;">
                        <form method="POST" class="mb-5">
                            @csrf
                            <div class="form-group row">
                                <label for="analyticalEvolutionChartFilter" class="col-sm-3 col-form-label">Secteur :</label>
                                <div class="col-sm-9">
                                    <select name="sector" class="form-control sector-select" id="analyticalEvolutionChartFilter">
                                        <option value="0" selected>TOUS</option>
                                        @foreach ($sectorOp as $op)
                                            <option value="{{$op->id}}">{{$op->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </form>
                        <div id="app">
                            {!! $analyticalEvolutionChart->container() !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <!-- AREA CHART 2 -->
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Répartition des produits par secteur en k€</h3>
                    </div>
                    <div class="card-body" style="display: block;">
                        <form method="POST" class="mb-5">
                            @csrf
                            <div class="form-group row">
                                <label for="productsDivisionChartFilter" class="col-sm-3 col-form-label">Exercice :</label>
                                <div class="col-sm-9">
                                    <select name="exercise" class="form-control exercise-select" id="productsDivisionChartFilter">
                                        @foreach ($yearsOp as $op)
                                            <option value="{{$op->id}}">{{$op->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </form>
                        <div id="app">
                            {!! $productsDivisionChart->container() !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <!-- AREA CHART 3 -->
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Répartition des charges de personnels</h3>
                    </div>
                    <div class="card-body" style="display: block;">
                        {{-- <form method="POST" class="mb-5">
                            @csrf
                            <div class="form-group row">
                                <label for="exerciseSelect" class="col-sm-3 col-form-label">Exercice :</label>
                                <div class="col-sm-9">
                                    <select name="exercise" class="form-control exercise-select" id="exerciseSelect">
                                        @foreach ($yearsOp as $op)
                                            <option value="{{$op->id}}">{{$op->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </form> --}}
                        <div id="app">

                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>

    {{-- Analytical evolution chart sector selection --}}
    {!! $analyticalEvolutionChart->script() !!}
    <script>
        $('#analyticalEvolutionChartFilter').change(function() {
            let sector_id = $(this).val()
            {{ $analyticalEvolutionChart->id }}_refresh('/rapport/evolution-analytique-secteur/' + sector_id);
        })
    </script>

    {{-- Analytical evolution chart sector selection --}}
    {!! $productsDivisionChart->script() !!}
    <script>
        $('#productsDivisionChartFilter').change(function() {
            let exercise_id = $(this).val()
            {{ $productsDivisionChart->id }}_refresh('rapport/repartition-produits-annee/' + exercise_id);
        })
    </script>

    {{-- Analytical evolution chart sector selection --}}

    <script>
        $('#productsDivisionChartFilter').change(function() {
            let exercise_id = $(this).val()
            {{ $productsDivisionChart->id }}_refresh('rapport/repartition-produits-annee/' + exercise_id);
        })
    </script>
@endsection
