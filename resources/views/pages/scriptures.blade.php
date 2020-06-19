@extends('adminlte::page')

@section('plugins.Datatables', true)

@section('title', 'Écritures comptables')

@section('content_header')
<h1>Importer des écritures comptables</h1>
@stop

@section('content')
    @include('components.scriptures.card-functions')
    @include('components.scriptures.card-table')
    @include('components.scriptures.modal_import')
@stop


@section('js')
<script src="{{ asset('js/scriptures/scriptures.js') }}"></script>
@stop
