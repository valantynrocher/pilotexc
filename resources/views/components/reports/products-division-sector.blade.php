<div class="col-md-6">
    <!-- AREA CHART 2 -->
    <div class="card card-info card-outline">
        <div class="card-header">
            <h3 class="card-title">Répartition des produits par secteur en k€</h3>
        </div>
        <div class="card-body" style="display: block;">
            <form method="POST" class="mb-5">
                @csrf
                <div class="form-group row">
                    <label for="productsDivisionChartFilter" class="col-sm-3 col-form-label">Exercice :</label>
                    <div class="col-sm-9">
                        <select name="exercise" class="form-control exercise-select" id="productsDivisionChartFilter">
                            {{-- @foreach ($yearsOp as $op) --}}
                                {{-- <option value="{{$op->id}}">{{$op->name}}</option> --}}
                            {{-- @endforeach --}}
                        </select>
                    </div>
                </div>
            </form>
            <div>
                <canvas id="productsDivisionChart"></canvas>
            </div>
        </div>
    </div>
</div>
