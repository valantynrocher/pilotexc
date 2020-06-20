<?php

namespace App\Http\Controllers\Api;

use App\Models\Sector;
use App\Models\FiscalYear;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\FiscalYearsController;

class ReportsController extends Controller
{
    protected $divider = 1000;
    protected $fiscalYears;
    protected $sectors;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->fiscalYears = $this->getLastFive();
        $this->sectors = Sector::all();
    }

    /**
     * Build chart Analytical evolution
     * @param Integer : id of selected sector
     */
    public function analyticalEvolutionChart($sectorId)
    {
        // init charts datas arrays
        $charges = [];
        $produits = [];
        $results = [];

        // get the selected sector
        if ($sectorId > 0) {
            $sector = $this->sectors->find($sectorId);

            // datas querying
            foreach($this->fiscalYears as $exercise) {
                $sumCharges = 0;
                $sumProduits = 0;
                $sumResults = 0;

                foreach($sector->services as $service) {
                    $scriptures =  $service->scriptures->where('fiscal_year_id', $exercise->id);

                    $sumCharges += ($scriptures->whereBetween('general_account_id', [600000, 699999])->sum('result_amount')) / $this->divider;
                    $sumProduits += ($scriptures->whereBetween('general_account_id', [700000, 799999])->sum('result_amount')) / $this->divider;
                    $sumResults += ($scriptures->sum('result_amount')) / 1000;
                }
                array_push($charges, round($sumCharges, 0));
                array_push($produits, round($sumProduits, 0));
                array_push($results, round($sumResults, 0));
            }
        } else {
            $sectors = Sector::all();
            foreach($this->fiscalYears as $exercise) {
                $chargesYear = 0;
                $produitsYear = 0;
                $resultYear = 0;

                foreach($sectors as $sector) {
                    $sumCharges = 0;
                    $sumProduits = 0;
                    $sumResults = 0;
                    foreach($sector->services as $service) {
                        $scriptures =  $service->scriptures->where('fiscal_year_id', $exercise->id);

                        $sumCharges += ($scriptures->whereBetween('general_account_id', [600000, 699999])->sum('result_amount')) / $this->divider;
                        $sumProduits += ($scriptures->whereBetween('general_account_id', [700000, 799999])->sum('result_amount')) / $this->divider;
                        $sumResults += ($scriptures->sum('result_amount')) / 1000;
                    }
                    $chargesYear += $sumCharges;
                    $produitsYear += $sumProduits;
                    $resultYear += $sumResults;
                }
                array_push($charges, round($chargesYear, 0));
                array_push($produits, round($produitsYear, 0));
                array_push($results, round($resultYear, 0));
            }
        }
        return response()->json([
            'labels' => $this->fiscalYears->pluck('year_start')->all(),
            'datasets' => [
                [
                    'type' => 'bar',
                    'label' => 'Charges',
                    'data' => $charges,
                    'backgroundColor' => '#00c300'
                ],
                [
                    'type' => 'bar',
                    'label' => 'Produits',
                    'data' => $produits,
                    'backgroundColor' => '#df2029'
                ],
                [
                    'type' => 'line',
                    'label' => 'Résultats',
                    'data' => $results,
                    'borderColor' => '#00AFF0',
                    'fill' => false,
                    'borderWidth' => 2
                ]
            ]
        ]);
    }


    /**
     * Build chart Products sectors division
     * @param int : id of selected fiscal year
     */
    public function productsDivisionChart($fiscalYearId)
    {
        // get the selected exercise
        $exercise = $this->fiscalYears->find($fiscalYearId);

        // init charts datas arrays
        $results = [];

        // datas querying
        foreach($this->sectors as $sector) {
            $sumResults = 0;
            foreach($sector->services as $service) {
                $scriptures =  $service->scriptures->where('fiscal_year_id', $exercise->id);
                $sumResults += ($scriptures->whereBetween('general_account_id', [700000, 799999])->sum('result_amount'))/ $this->divider;
            }
            array_push($results, round($sumResults, 0));
        }
        return response()->json([
            'labels' => $this->sectors->pluck('name')->all(),
            'datasets' => [
                'data' => $results,
                'backgroundColor' => [
                    '#00AFF0',
                    '#00c300',
                    '#df2029',
                    '#FFFC00',
                    '#410093',
                    '#0077b5',
                    '#ea4c89',
                    '#f57d00',
                    '#34465d'
                ]
            ]
        ]);
    }

    /**
    * Get last 5 exercises
    */
    protected function getLastFive()
    {
        return $data = FiscalYear::orderBy('year_start', 'asc')
        ->take(5)
        ->get();
    }
}
