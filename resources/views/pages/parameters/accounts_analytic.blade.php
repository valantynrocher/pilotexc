@extends('adminlte::page')

@section('plugins.Datatables', true)

@section('title', 'Paramètres')

@section('content_header')
<h1>Paramètres > Plan de comptes analytique</h1>
@stop

@section('content')
    @include('components.analytic-accounts.card-functions')
    @include('components.analytic-accounts.card-table')
    @include('components.analytic-accounts.modal_activation')
    @include('components.analytic-accounts.modal_affect')
    @include('components.analytic-accounts.modal_create')
    @include('components.analytic-accounts.modal_delete')
    @include('components.analytic-accounts.modal_edit')
@stop


@section('js')
<script src="{{ asset('js/parameters/accounts-analytic.js') }}"></script>
@stop
