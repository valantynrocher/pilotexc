<?php

namespace App\Http\Controllers\Api;

use App\Models\Scripture;
use App\Models\Structure;
use Carbon\Carbon;
use App\Models\FiscalYear;
use App\Models\ImportScriptures;
use Illuminate\Http\Request;
use App\Imports\ScripturesImport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ScripturesController extends Controller
{
    /**
    * Get enriched data with scriptures and results by fiscal year and by structure in real time
    *
    * @return JSON
    */
    public function index()
    {
        $fiscalYears = FiscalYear::all();
        $exercises = [];
        for($i=0; $i < count($fiscalYears); $i++) {
            $exerciseArray = $this->getResultsByExercise($fiscalYears[$i]);
            array_push($exercises, $exerciseArray);
            $i;
        }
        return collect($exercises)->toJson();
    }


    /**
    * This function count number of scriptures for a given fiscal year
    *
    * @param Integer $fiscalYearId
    * @return JSON
    */
    public function countExistingScriptures($fiscalYearId)
    {
        $check = Scripture::all()->where('fiscal_year_id', $fiscalYearId);
        return response()->json([
            'count' => count($check)
        ]);
    }


    /**
    * This function is used to check the result amount of current import with the user input
    *
    * @param Request
    * @return JSON
    */
    public function checkImportAmount(Request $request)
    {
        if($request->hasFile('scriptures')) {
            try {
                // First truncate import table
                $this->truncateTempScriptures();

                // Launch Excel import in import scriptures table
                Excel::import(new ScripturesImport, $this->storeImportedFile($request));

                // filtered scriptures to get only those for this exercise
                $filtered = $this->filterTempScripturesByExercise($request->input('fiscal_year_id'));
                // Calculate $result
                $result = ($filtered->sum('credit_amount')) - ($filtered->sum('debit_amount'));
                // Parse result format
                $result = number_format($result, 0, ',', '');

                if ($request->input('amount_check') == $result) {
                    return response()->json([
                        'validate' => true,
                        'message' => 'La validation est correcte. Vous pouvez finaliser votre import.'
                    ]);
                } else {
                    $this->truncateTempScriptures();
                    return response()->json([
                        'validate' => false,
                        'message' => 'La validation a échouée. Saisissez un autre montant.'
                    ]);
                }

            } catch (\Throwable $th) {
                throw $th;
            }
        } else {
            return response()->json([
                'message' => 'Aucun fichier à importer.',
                'code' => 419
            ]);
        }
    }


    /**
    * This function is used to finalize the scriptures import
    *
    * @param Request
    * @return JSON
    */
    public function import(Request $request)
    {
        try {
            // Truncate existing scripture for current exercise on final scriptures table
            $this->deleteScripturesForExercise($request->input('fiscal_year_id'));

            // Filtered scriptures to get only those for selected exercise
            $filtered = $this->filterTempScripturesByExercise($request->input('fiscal_year_id'));

            // Save each filtered scriptures in the final scriptures table
            $this->saveFinalScriptures($filtered, $request->input('fiscal_year_id'));

            // truncate temporary import_scriptures table
            $this->truncateTempScriptures();

            return response()->json([
                'message' => 'Vots écritures ont bien été importées.'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Une erreur est survenue pendant l\'import. Veuillez essayer à nouvea. Si l\'erreur persiste, contactez le support Pilotexc.',
                'error' => $th
            ]);
        }
    }

    /**
    * This function is used to truncate the impor scriptures table, wich is a temporary table
    *
    * @return void
    */
    public function truncateTempScriptures() {
        DB::table('import_scriptures')->truncate();
    }

    /**
    * This function is used to calculate global result by exercise and
    * by structure
    *
    * @param Model $fiscalYear
    * @return array $exercise
    */
    protected function getResultsByExercise($fiscalYear)
    {
        $globalCount = 0;
        $globalResult = 0;

        // init array for current fiscal year
        $exercise = [
            'id' => $fiscalYear->id,
            'title' => $fiscalYear->name,
            'status' => $fiscalYear->status,
            'structures' => [],
            'count' => $globalCount,
            'result' => $globalResult
        ];

        // loop in each structure to get result and push into into the exercise array
        $structures = Structure::all();
        foreach($structures as $structure) {
            $scripturesByStructure = $structure->scriptures->where('fiscal_year_id', $fiscalYear->id);
            $result = collect($scripturesByStructure)->sum('result_amount');
            $count = count($scripturesByStructure);
            // Push infos by structure
            array_push($exercise['structures'], [
                'name' => $structure->name,
                'result' => $result,
                'count' => $count
            ]);
            // calculate total count on exercise
            $globalCount += $count;
            // calculate total result on exercise
            $globalResult += $result;
        }
        // Push totals
        $exercise['count'] += $globalCount;
        $exercise['result'] += $globalResult;

        return $exercise;
    }


    /**
    * This function is used to filter the import scriptures table
    * to get only scriptures for given fiscal year
    *
    * @param Integer $fiscalYear
    * @return Collection
    */
    protected function filterTempScripturesByExercise($fiscalYearId)
    {
        // Set Start and End Date for current exercise
        $fiscalYear = FiscalYear::find($fiscalYearId);
        $startExercise = "$fiscalYear->year_start-$fiscalYear->month_start-01";
        $endExercise = "$fiscalYear->year_end-$fiscalYear->month_end-31";

        return ImportScriptures::all()->whereBetween('date_entry', [Carbon::parse($startExercise), Carbon::parse($endExercise)]);
    }


    /**
    * This function is used to store the upload file when user
    * is importing scriptures
    *
    * @param Request $request
    * @return String $path
    */
    protected function storeImportedFile(Request $request)
    {
        $file = $request->file('scriptures');
        $extension = $file->getClientOriginalExtension();
        $currentTime = Carbon::parse(Carbon::now())->format('d-m-Y_H-i');
        $fileNameToStore = 'import_'. $currentTime .'_scriptures' . '.' . $extension;
        $path = $file->storeAs('public/scriptures', $fileNameToStore);

        return $path;
    }


    /**
    * This function is used to save scriptures from import table to
    * final table, with some enriched data
    *
    * @param Collection $filtered
    * @param Integer $fiscalYearId
    * @return JSON
    */
    protected function saveFinalScriptures($filtered, $fiscalYearId)
    {
        foreach($filtered as $item) {
            $scripture = new Scripture();
            $scripture->fiscal_year_id = $fiscalYearId;
            $scripture->analytic_account_id = $item->analytic_account;
            $scripture->general_account_id = $item->general_account;
            $scripture->date_entry = $item->date_entry;
            $scripture->journal = $item->journal;
            $scripture->piece_nb = $item->piece_nb;
            $scripture->name = $item->name;
            $scripture->debit_amount = $item->debit_amount;
            $scripture->credit_amount = $item->credit_amount;
            $scripture->result_amount = $item->credit_amount - $item->debit_amount;
            $scripture->entry_type = 'Réalisé';

            $scripture->save();
        }
        return 204;
    }


    /**
    * This function is used to delete scriptures from table
    * before importing new ones for a given fiscal year
    *
    * @param Collection $filtered
    * @param Integer $fiscalYearId
    * @return JSON
    */
    protected function deleteScripturesForExercise($fiscalYearId)
    {
        DB::table('scriptures')->where('fiscal_year_id', $fiscalYearId)->delete();
    }
}
