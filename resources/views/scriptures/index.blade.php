@extends('layouts.app')

@section('title')Gestion des écritures
@endsection

@section('subTitle')
@endsection

@section('content')
<!-- Main content -->
<section class="content">
    <div class="card">
        <div class="card-header p-2">
            <ul class="nav nav-pills">
                <!-- import tab -->
                <li class="nav-item"><a class="nav-link active" href="#import" data-toggle="tab"><i class="fas fa-file-import mr-2"></i>Importer</a></li>
                <!-- destroy tab -->
                <li class="nav-item"><a class="nav-link" href="#destroy" data-toggle="tab"><i class="fas fa-trash-restore mr-2"></i>Purger</a></li>
                <!-- history tab -->
                <li class="nav-item"><a class="nav-link" href="#history" data-toggle="tab"><i class="fas fa-history mr-2"></i>Historique</a></li>
                <!-- writting tab -->
                <li class="nav-item"><a class="nav-link disabled" href="#" data-toggle="tab"><i class="fas fa-keyboard mr-2"></i>Saisie</a></li>
            </ul>
        </div><!-- /.card-header -->

        <div class="card-body">
            <div class="tab-content">
                <!-- import tab pane -->
                <div class="tab-pane active" id="import">

                </div>

                <!-- destroy tab pane -->
                <div class="tab-pane" id="destroy">

                </div>

                <!-- history tab pane -->
                <div class="tab-pane" id="history">

                </div>

                <!-- writting tab pane -->
                <div class="tab-pane" id="writting">

                </div>
            </div>
            <!-- /.tab-content -->
        </div><!-- /.card-body -->
    </div>
</section>
<!-- /.content -->
@endsection
