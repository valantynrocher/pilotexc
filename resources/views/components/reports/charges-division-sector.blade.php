<div class="col-md-6">
    <!-- AREA CHART 2 -->
    <div class="card card-info card-outline">
        <div class="card-header">
            <h3 class="card-title">Répartition des charges par secteur en k€</h3>
        </div>
        <div class="card-body" style="display: block;">
            <form method="POST" class="mb-5">
                @csrf
                <div class="form-group row">
                    <label for="chargesDivisionChartFilter" class="col-sm-3 col-form-label">Exercice :</label>
                    <div class="col-sm-9">
                        <select name="exercise" class="form-control exercise-select" id="chargesDivisionChartFilter">
                        </select>
                    </div>
                </div>
            </form>
            <div class="chart-container">
                <div class="spinner-grow text-info" id="spinner4" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <canvas id="chargesDivisionChart" width="520px" height="400px" style="padding: 15px"></canvas>
            </div>
        </div>
    </div>
</div>
