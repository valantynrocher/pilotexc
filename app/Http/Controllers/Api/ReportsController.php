<?php

namespace App\Http\Controllers\Api;

use App\Models\Sector;
use App\Models\FiscalYear;
use App\Http\Controllers\Controller;

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
        $this->sectors = Sector::all();
    }

    /**
     * Build chart Analytical evolution with sector filter
     * @param Integer $sectorId
     */
    public function analyticalEvolutionChart($sectorId)
    {
        // init charts datas arrays
        $charges = [];
        $produits = [];
        $results = [];

        $exercises = FiscalYear::orderBy('year_start', 'asc')->take(5)->get();

        // get the selected sector datas
        if ($sectorId > 0) {
            $sector = $this->sectors->find($sectorId);

            // datas querying
            foreach($exercises as $exercise) {
                $sumCharges = 0;
                $sumProduits = 0;
                $sumResults = 0;

                foreach($sector->services as $service) {
                    $scriptures =  $service->scriptures->where('fiscal_year_id', $exercise->id);
                    $sumCharges += ($scriptures->whereBetween('general_account_id', [600000, 699999])->sum('result_amount')) / $this->divider;
                    $sumProduits += ($scriptures->whereBetween('general_account_id', [700000, 799999])->sum('result_amount')) / $this->divider;
                    $sumResults += ($scriptures->sum('result_amount')) / $this->divider;
                }
                array_push($charges, round($sumCharges, 0));
                array_push($produits, round($sumProduits, 0));
                array_push($results, round($sumResults, 0));
            }
        } else {
            $sectors = Sector::all();
            foreach($exercises as $exercise) {
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
            'labels' => $exercises->pluck('year_start')->all(),
            'datasets' => [
                [
                    'label' => 'Charges',
                    'data' => $charges,
                    'backgroundColor' => '#df2029'
                ],
                [
                    'label' => 'Produits',
                    'data' => $produits,
                    'backgroundColor' => '#00c300'
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
     * Build chart Products sectors division with exercise filter
     * @param Integer $fiscalYearId
     */
    public function productsDivisionChart($fiscalYearId)
    {
        // get the selected exercise
        $exercise = FiscalYear::find($fiscalYearId);

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
                [
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
            ]
        ]);
    }

    /**
     * Build chart Products sectors division with exercise filter
     * @param Integer $fiscalYearId
     */
    public function chargesDivisionChart($fiscalYearId)
    {
        // get the selected exercise
        $exercise = FiscalYear::find($fiscalYearId);

        // init charts datas arrays
        $results = [];

        // datas querying
        foreach($this->sectors as $sector) {
            $sumResults = 0;
            foreach($sector->services as $service) {
                $scriptures =  $service->scriptures->where('fiscal_year_id', $exercise->id);
                $sumResults += ($scriptures->whereBetween('general_account_id', [600000, 699999])->sum('result_amount'))/ $this->divider;
            }
            array_push($results, round($sumResults, 0));
        }

        return response()->json([
            'labels' => $this->sectors->pluck('name')->all(),
            'datasets' => [
                [
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
            ]
        ]);
    }

    /**
     * Build chart Analytical sector evolution with exercise filter
     * @param Integer $fiscalYearId
     */
    public function analyticalSectorDivisionChart($fiscalYearId)
    {
        // init charts datas arrays
        $charges = [];
        $produits = [];
        $results = [];

        // get the selected exercise
        $exercise = FiscalYear::find($fiscalYearId);

        foreach($this->sectors as $sector) {
            foreach($sector->services as $service) {
                $sumCharges = 0;
                $sumProduits = 0;
                $sumResults = 0;

                foreach($sector->services as $service) {
                    $scriptures =  $service->scriptures->where('fiscal_year_id', $exercise->id);
                    $sumCharges += ($scriptures->whereBetween('general_account_id', [600000, 699999])->sum('result_amount')) / $this->divider;
                    $sumProduits += ($scriptures->whereBetween('general_account_id', [700000, 799999])->sum('result_amount')) / $this->divider;
                    $sumResults += ($scriptures->sum('result_amount')) / $this->divider;
                }

            }
            array_push($charges, round($sumCharges, 0));
            array_push($produits, round($sumProduits, 0));
            array_push($results, round($sumResults, 0));
        }


        return response()->json([
            'labels' => $this->sectors->pluck('name')->all(),
            'datasets' => [
                [
                    'label' => 'Charges',
                    'data' => $charges,
                    'backgroundColor' => '#df2029'
                ],
                [
                    'label' => 'Produits',
                    'data' => $produits,
                    'backgroundColor' => '#00c300'
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
}
