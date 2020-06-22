<div class="col-md-6">
    <!-- AREA CHART 1 -->
    <div class="card card-info card-outline">
        <div class="card-header">
            <h3 class="card-title">Évolution charges/produits/résultat par secteur en k€</h3>
        </div>
        <div class="card-body" style="display: block;">
            <form method="POST" class="mb-2">
                @csrf
                <div class="form-group row">
                    <label for="analyticalEvolutionChartFilter" class="col-sm-3 col-form-label">Secteur :</label>
                    <div class="col-sm-9">
                        <select name="sector" class="form-control sector-select" id="analyticalEvolutionChartFilter">
                            <option value="0" selected>TOUS</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>
        <div class="chart-container">
            <div class="spinner-grow text-info" id="spinner1" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <canvas id="analyticalEvolutionChart" width="520px" height="400px" style="padding: 15px"></canvas>
        </div>
    </div>
</div>
