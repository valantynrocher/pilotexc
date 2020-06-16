<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use App\Models\Service;
use App\Models\Scripture;
use App\Models\FiscalYear;
use Illuminate\Http\Request;
use App\Charts\SalaryChargesChart;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    protected $fiscalYears;
    protected $sectors;

    protected $divider = 1000;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->fiscalYears = $this->getLastFiveExercises();
        $this->sectors = Sector::all();
    }

    /**
     * Show the application dashboard (Home page).
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('pages.dashboard');

        // // Analytical evolution chart
        // $analyticalEvolutionChart = new AnalyticalEvolutionChart;
        // $analyticalEvolutionChartApi = url('rapport/evolution-analytique-secteur/0');
        // $analyticalEvolutionChart->labels($this->fiscalYears->pluck('year_start')->all())->load($analyticalEvolutionChartApi);


        // // Products sectors division chart
        // $productsDivisionChart = new ProductsDivisionBySectorChart;
        // $productsDivisionChartApi = url('rapport/repartition-produits-annee/1');
        // $productsDivisionChart->labels($this->sectors->pluck('name')->all())->load($productsDivisionChartApi);
        // $productsDivisionChart->displayAxes(false, false);
        // $productsDivisionChart;

        // // Salary charges chart
        // // $salaryChargesChart = new SalaryChargesChart;


        // // return the view
        // return view('dashboard.index', [
        //     'sectorOp' => $this->sectors,
        //     'analyticalEvolutionChart' => $analyticalEvolutionChart,
        //     'yearsOp' => $this->fiscalYears,
        //     'productsDivisionChart' => $productsDivisionChart
        // ]);
    }

    /**
     * get collection of 5 exercises
     */
    protected function getLastFiveExercises()
    {
        return FiscalYear::orderBy('year_start', 'asc')
        ->take(5)
        ->get();
    }

    /**
     * Build chart Analytical evolution
     * @param int : id of selected sector
     */
    // public function analyticalEvolutionChart($sectorId)
    // {
    //     // init charts datas arrays
    //     $charges = [];
    //     $produits = [];
    //     $results = [];

    //     // get the selected sector
    //     if ($sectorId > 0) {
    //         $sector = $this->sectors->find($sectorId);

    //         // datas querying
    //         foreach($this->fiscalYears as $exercise) {
    //             $sumCharges = 0;
    //             $sumProduits = 0;
    //             $sumResults = 0;

    //             foreach($sector->services as $service) {
    //                 $scriptures =  $service->scriptures->where('fiscal_year_id', $exercise->id);

    //                 $sumCharges += ($scriptures->whereBetween('general_account_id', [600000, 699999])->sum('result_amount')) / $this->divider;
    //                 $sumProduits += ($scriptures->whereBetween('general_account_id', [700000, 799999])->sum('result_amount')) / $this->divider;
    //                 $sumResults += ($scriptures->sum('result_amount')) / 1000;
    //             }
    //             array_push($charges, round($sumCharges, 0));
    //             array_push($produits, round($sumProduits, 0));
    //             array_push($results, round($sumResults, 0));
    //         }
    //     } else {
    //         $sectors = Sector::all();
    //         foreach($this->fiscalYears as $exercise) {
    //             $chargesYear = 0;
    //             $produitsYear = 0;
    //             $resultYear = 0;

    //             foreach($sectors as $sector) {
    //                 $sumCharges = 0;
    //                 $sumProduits = 0;
    //                 $sumResults = 0;
    //                 foreach($sector->services as $service) {
    //                     $scriptures =  $service->scriptures->where('fiscal_year_id', $exercise->id);

    //                     $sumCharges += ($scriptures->whereBetween('general_account_id', [600000, 699999])->sum('result_amount')) / $this->divider;
    //                     $sumProduits += ($scriptures->whereBetween('general_account_id', [700000, 799999])->sum('result_amount')) / $this->divider;
    //                     $sumResults += ($scriptures->sum('result_amount')) / 1000;
    //                 }
    //                 $chargesYear += $sumCharges;
    //                 $produitsYear += $sumProduits;
    //                 $resultYear += $sumResults;
    //             }
    //             array_push($charges, round($chargesYear, 0));
    //             array_push($produits, round($produitsYear, 0));
    //             array_push($results, round($resultYear, 0));
    //         }
    //     }

    //     $chart = new AnalyticalEvolutionChart;
    //     $chart->dataset('Charges', 'bar', $charges)->backgroundColor('#df2029');
    //     $chart->dataset('Produits', 'bar', $produits)->backgroundColor('#09b83e');
    //     $chart->dataset('Résultat', 'line', $results)->lineTension(0)->fill(false)->color('#0084ff');
    //     return $chart->api();
    // }


    /**
     * Build chart Products sectors division
     * @param int : id of selected fiscal year
     */
    // public function productsDivisionChart($yearId)
    // {
    //     // get the selected exercise
    //     $exercise = $this->fiscalYears->find($yearId);

    //     // init charts datas arrays
    //     $results = [];

    //     // datas querying
    //     foreach($this->sectors as $sector) {
    //         $sumResults = 0;
    //         foreach($sector->services as $service) {
    //             $scriptures =  $service->scriptures->where('fiscal_year_id', $exercise->id);
    //             $sumResults += ($scriptures->whereBetween('general_account_id', [700000, 799999])->sum('result_amount'))/ $this->divider;
    //         }
    //         array_push($results, round($sumResults, 0));
    //     }

    //     $chart = new ProductsDivisionBySectorChart;
    //     $chart->dataset('', 'pie', $results)->backgroundColor([
    //         '#00AFF0',
    //         '#00c300',
    //         '#df2029',
    //         '#FFFC00',
    //         '#410093',
    //         '#0077b5',
    //         '#ea4c89',
    //         '#f57d00',
    //         '#34465d'
    //     ]);
    //     return $chart->api();
    // }

    /**
     * Build chart Salary charges
     * @param int : id of selected fiscal year
     */
    // public function salaryChargesChart($yearId)
    // {
    //     // get the selected exercise
    //     $exercise = $this->fiscalYears->find($yearId);

    //     $chart = new SalaryChargesChart;
    //     $chart->dataset('', '', ['']);
    //     return $chart->api();
    // }
}
