@extends('adminlte::page')

@section('plugins.Datatables', true)

@section('title', 'Paramètres')

@section('content_header')
<h1>Paramètres > Plan de comptes général</h1>
@stop

@section('content')
    @include('components.general-accounts.card-functions')
    @include('components.general-accounts.card-table')
    @include('components.general-accounts.modal_activation')
    @include('components.general-accounts.modal_affect')
    @include('components.general-accounts.modal_create')
    @include('components.general-accounts.modal_delete')
    @include('components.general-accounts.modal_edit')
@stop


@section('js')
<script src="{{ asset('js/parameters/accounts-general.js') }}"></script>
@stop
