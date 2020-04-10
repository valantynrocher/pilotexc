@extends('layouts.app')

@section('title')Paramètres
@endsection

@section('subTitle')
@endsection

@section('content')
<!-- Main content -->
<section class="content">
    <div class="card">
        <div class="card-header p-2">
            <ul class="nav nav-pills">
                <!-- Analytic account tab -->
                <li class="nav-item"><a class="nav-link active" href="#analytic-accounts" data-toggle="tab">Ma comptabilité analytique</a></li>
                <!-- General account tab -->
                <li class="nav-item"><a class="nav-link" href="#" data-toggle="tab">Ma comptabilité générale</a></li>
            </ul>
        </div><!-- /.card-header -->

        <div class="card-body">
            <div class="tab-content">
                <!-- Analytic account tab pane -->
                <div class="tab-pane active" id="analytic-accounts">
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-exclamation-triangle"></i> ATTENTION !</h5>
                        Chaque nouvel import écrase vos données précédemment enregistrées.
                    </div>

                    <!-- success/errors messages -->
                    @isset ($errors)
                        @if (count($errors) >0)
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </div>
                        @endif
                    @endisset
                    @isset ($success)
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            {{ $success ?? '' }}
                        </div>
                    @endisset

                    <!-- Uploading form -->
                    <form action="{{ route('app.parameters.analytic.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Sélectionnez un fichier à importer</label>
                            <small>(Taille maximum : 5 Mo, Formats acceptés : *.xlsx, *.xls, *.csv)</small>
                        </div>
                        <div class="form-group">
                            <input type="file" class="mr-5" name="select_file">
                            <input type="submit" value="Importer" class="btn btn-danger">
                        </div>
                    </form>

                    <!-- Analytic accounts table -->
                    <table id="analytic-accounts" class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>Section</th>
                                <th>Libellé</th>
                                <th>Service</th>
                                <th>Secteur</th>
                                <th>Dossier</th>
                                <th>Structure</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $row)
                                <tr>
                                    <td>{{ $row->analytic_section }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->service }}</td>
                                    <td>{{ $row->sector }}</td>
                                    <td>{{ $row->folder }}</td>
                                    <td>{{ $row->structure }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        @empty($datas)
                        <tfoot>
                            <tr>
                                <th>Section</th>
                                <th>Libellé</th>
                                <th>Service</th>
                                <th>Secteur</th>
                                <th>Dossier</th>
                                <th>Structure</th>
                            </tr>
                        </tfoot>
                        @endempty
                    </table>
                </div>

            </div>
            <!-- /.tab-content -->
        </div><!-- /.card-body -->
    </div>
</section>
<!-- /.content -->
@endsection

@section('script')
    <!-- DataTables -->
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script>
        $(function () {
        $('#analytic-accounts').DataTable({
            "responsive": true,
            "autoWidth": false,
            "searching": false,
            "language": {
                "lengthMenu": "Afficher _MENU_ lignes par page",
                "zeroRecords": "Aucun résultat",
                "info": "Page _PAGE_ sur _PAGES_",
                "infoEmpty": "",
                "emptyTable": "Aucune donnée à afficher. Importez d'abord votre plan de compte",
                "infoFiltered": "(Filtrer par _MAX_ total entrées)",
                "decimal": ",",
                "thousands": " ",
                "paginate": {
                    "first":      "Premier",
                    "last":       "Dernier",
                    "next":       "Suivant",
                    "previous":   "Précédent"
                }
            },
            "pagingType": "full_numbers"
        });
        });
    </script>
@endsection
