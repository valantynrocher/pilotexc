@extends('adminlte::page')

@section('title', 'Tableau de bord')

@section('content_header')
<h1>Tableau de bord</h1>
@stop

@section('content')
    <div class="row">
        @include('components.reports.analytic-evol-charges-product')
        @include('components.reports.analytic-sector-division')
        @include('components.reports.products-division-sector')
        @include('components.reports.charges-division-sector')
    </div>
@stop


@section('js')
<script src="{{ asset('/vendor/chart.js/Chart.js') }}"></script>
<script src="{{ asset('/js/dashboard/reports.js') }}"></script>
@stop
