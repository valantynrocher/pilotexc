@section('plugins.Datatables', true)

<div class="card">
    <div class="card-header bg-maroon">
        <h4 class="card-title bg-maroon">
            Liste des comptes <a href="#" id="reloadAccounts"><i class="fas fa-sync-alt ml-2"></i></a>
        </h4>
    </div>

    <div id="accountsTable" class="panel-collapse in collapse show" style="">
        <div class="card-body">
            <!-- Analytic accounts table -->
            <table id="analytic-accounts" class="table table-bordered table-hover" style="width:100%">
                <thead class="thead-light">
                    <tr>
                        <th><input type="checkbox" id="checkAll"></th>
                        <th>Code</th>
                        <th>Libellé</th>
                        <th>Structure</th>
                        <th>Service</th>
                        <th>Actif</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
