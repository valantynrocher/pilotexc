<div class="col-md-6">
    <!-- AREA CHART 1 -->
    <div class="card card-info card-outline">
        <div class="card-header">
            <h3 class="card-title">Évolution analytique des charges et produits en k€</h3>
        </div>
        <div class="card-body" style="display: block;">
            <form method="POST" class="mb-2">
                @csrf
                <div class="form-group row">
                    <label for="analyticalEvolutionChartFilter" class="col-sm-3 col-form-label">Secteur :</label>
                    <div class="col-sm-9">
                        <select name="sector" class="form-control sector-select" id="analyticalEvolutionChartFilter">
                            <option value="0" selected>TOUS</option>
                            {{-- @foreach ($sectorOp as $op)
                                <option value="{{$op->id}}">{{$op->name}}</option>
                                @endforeach --}}
                            </select>
                        </div>
                    </div>
                </div>
            </form>
            <div class="text-center" id="chartDiv">
                <div class="spinner-grow text-info" id="spinner1" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <canvas id="analyticalEvolutionChart"></canvas>
            </div>
        </div>
    </div>
</div>
