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
    * Get resources for the scriptures page check
    *
    * @return \Illuminate\Contracts\Support\Renderable
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
    * This function is used to calculate global result by exercise and
    * by structure
    *
    * @param $exercise : Array, Collection of all Fiscal Years with "Clôturé" status
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


    public function import(Request $request)
    {
        if($request->hasFile('scriptures')) {
            try {
                // set Start and End Date for selected exercise
                $fiscalYear = FiscalYear::find($request->input('fiscal_year_id'));
                $startExercise = "$fiscalYear->year_start-$fiscalYear->month_start-01";
                $endExercise = "$fiscalYear->year_end-$fiscalYear->month_end-31";

                // Check if scriptures already exist for this exercise
                $check = Scripture::all()->whereBetween('date_entry', [Carbon::parse($startExercise), Carbon::parse($endExercise)]);

                // get, rename and store importation file
                $path = $this->storeImportedFile($request);

                // launch Excel import in temporary table
                Excel::import(new ScripturesImport, $path);

                // filtered scriptures to get only the selected exercise
                $filtered = ImportScriptures::all()->whereBetween('date_entry', [Carbon::parse($startExercise), Carbon::parse($endExercise)]);

                // save each filtered scriptures in the final 'scriptures' table
                $this->saveFinalScriptures($filtered, $fiscalYear);

                // truncate temporary 'import_scriptures' table
                DB::table('import_scriptures')->truncate();

                // return redirect()->route('scriptures.index')->with('success', 'Votre import \'est bien passé.');
                return response()->json([
                    'message' => 'Votre import s\'est bien passé.',
                    'code' => 204
                ]);
            } catch (\Throwable $th) {
                throw $th;
                // return response()->json([
                //     'message' => 'Une erreur est survenue pendant l\'import.',
                //     'error' => $th
                // ]);
            }
        } else {
            return response()->json([
                'message' => 'Aucun fichier à importer.',
                'code' => 419
            ]);
        }
    }

    protected function storeImportedFile($request)
    {
        $file = $request->file('scriptures');
        $file = $request->scriptures;
        $extension = $file->getClientOriginalExtension();
        $currentTime = Carbon::parse(Carbon::now())->format('d-m-Y_H-i');
        $fileNameToStore = 'import_'. $currentTime .'_scriptures_' . time() . '.' . $extension;
        $path = $file->storeAs('public/scriptures', $fileNameToStore);

        return $path;
    }

    protected function saveFinalScriptures($filtered, $fiscalYear)
    {
        foreach($filtered as $item) {
            $scripture = new Scripture();
            $scripture->fiscal_year_id = $fiscalYear->id;
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
    }
}
