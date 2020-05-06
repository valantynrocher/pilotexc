<?php

namespace App\Http\Controllers;

use App\Sector;
use App\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Charts\AnalyticalEvolutionChart;
use App\FiscalYear;
use App\Scripture;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard (Home page).
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sectorOp = Sector::all();

        return view('dashboard.index', [
            'chart' => $this->renderChart(),
            'sectorOp' => $sectorOp
        ]);
    }

    protected function getLastFiveExercises()
    {
        // select last 5 closed fiscal years
        $fiscalYears = FiscalYear::where('status', 'Clôturé')->orderBy('year_start', 'asc')
        ->take(5)
        ->get();
        return $fiscalYears;
    }

    public function renderChart($sectorId = null)
    {
        if($sectorId !== null) {
            $id = $sectorId;
        } else {
            $id = 1;
        }
        $url = 'chart-data/' . $id;
        $chart = new AnalyticalEvolutionChart;
        $api = url($url);

        $labels = $this->getLastFiveExercises()->pluck('year_start')->all();
        $chart->labels($labels)->load($api);

        return $chart;
    }

    public function chartApi($sectorId)
    {
        $fiscalYears = $this->getLastFiveExercises();

        // select the sector
        $sector = Sector::find($sectorId);

        // init charts variables
        $labels = [];
        $charges = [];
        $produits = [];
        $results = [];

        // get datas
        foreach($fiscalYears as $exercise) {
            // set labels
            array_push($labels, $exercise->year_start);
            $sumCharges = 0;
            $sumProduits = 0;
            $sumResults = 0;
            // set datas
            foreach($sector->services as $service) {
                $scriptures =  $service->scriptures->where('fiscal_year_id', $exercise->id);

                $sumCharges += $scriptures->sum('debit_amount');
                $sumProduits += $scriptures->sum('credit_amount');
                $sumResults += $scriptures->sum('result_amount');
            }
            array_push($charges, $sumCharges);
            array_push($produits, $sumProduits);
            array_push($results, $sumResults);
        }

        $chart = new AnalyticalEvolutionChart;
        $chart->labels($labels);
        $chart->dataset('Charges', 'bar', $charges)->backgroundColor('#0084ff');
        $chart->dataset('Produits', 'bar', $produits)->backgroundColor('#df2029');
        $chart->dataset('Résultat', 'line', $results)->lineTension(0)->fill(false)->color('#09b83e');

        return $chart->api();
    }
}
