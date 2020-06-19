@extends('adminlte::page')

@section('plugins.Datatables', true)

@section('title', 'Paramètres')

@section('content_header')
<h1>Paramètres > Exercices comptables</h1>
@stop

@section('content')
    @include('components.fiscal-years.card-functions')
    @include('components.fiscal-years.card-table')
    @include('components.fiscal-years.modal_create')
    @include('components.fiscal-years.modal_edit')
@stop


@section('js')
<script src="{{ asset('js/parameters/fiscal-years.js') }}"></script>
@stop
