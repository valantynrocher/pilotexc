<?php

namespace App\Http\Controllers;

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
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     *
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('pages.scriptures');

        // $closedFiscalYears = FiscalYear::all();
        // $exercises = [];
        // foreach($closedFiscalYears as $exercise) {
        //     $exerciseArray = $this->getResultsByExercise($exercise);
        //     $exercises += [$exercise->name => $exerciseArray];
        // }

        // $structures = Structure::all();
        // $inProgressFiscalYears = FiscalYear::where('status', 'En cours')->get();

    }


    /**
     * This function is used to calculate global result by exercise and
     * by structure
     *
     * @param $exercise : Array, Collection of all Fiscal Years with "Clôturé" status
     * @return array $exerciseArray
     */
    // protected function getResultsByExercise($exercise)
    // {
    //     $exerciseArray = [
    //         'Structures' => [],
    //         'Total' => 0
    //     ];
    //     $total = 0;

    //     // loop in each structure to get result and push into into the exercise array
    //     $structures = Structure::all();
    //     foreach($structures as $structure) {
    //         $scripturesByStructure = $structure->scriptures->where('fiscal_year_id', $exercise->id);
    //         $result = collect($scripturesByStructure)->sum('result_amount');
    //         // Push structure => result in the Exercise array
    //         $exerciseArray['Structures'] += [$structure->name => $result];
    //         // calculate total result on exercise
    //         $total += $result;
    //     }
    //     // Push total => total result in Exercise array
    //     $exerciseArray['Total'] += $total;

    //     return $exerciseArray;
    // }


    // public function import(Request $request)
    // {
    //     if($request->hasFile('scriptures')) {
    //         try {
    //             // set Start and End Date for selected exercise
    //             $fiscalYear = FiscalYear::find($request->input('fiscal_year_id'));
    //             $startExercise = $fiscalYear->year_start . '-' . $fiscalYear->month_start . '-01';
    //             $endExercise = $fiscalYear->year_end . '-' . $fiscalYear->month_end . '-31';

    //             // first of all, check if scriptures already exist for this exercise
    //             $check = Scripture::all()->whereBetween('date_entry', [Carbon::parse($startExercise), Carbon::parse($endExercise)]);

    //             // get, rename and store importation file
    //             $path = $this->storeImportedFile($request);

    //             // launch Excel import in temporary table
    //             Excel::import(new ScripturesImport, $path);

    //             // filtered scriptures to get only the selected exercise
    //             $filtered = ImportScriptures::all()->whereBetween('date_entry', [Carbon::parse($startExercise), Carbon::parse($endExercise)]);

    //             // save each filtered scriptures in the final 'scriptures' table
    //             $this->saveFinalScriptures($filtered, $fiscalYear);

    //             // truncate temporary 'import_scriptures' table
    //             DB::table('import_scriptures')->truncate();

    //             return redirect()->route('scriptures.index')->with('success', 'Votre import \'est bien passé.');
    //         } catch (\Throwable $th) {
    //             //throw $th;
    //         }
    //     }
    // }

    // protected function storeImportedFile($request)
    // {
    //     $file = $request->file('scriptures');
    //     $file = $request->scriptures;
    //     $extension = $file->getClientOriginalExtension();
    //     $currentTime = Carbon::parse(Carbon::now())->format('d-m-Y_H-i');
    //     $fileNameToStore = 'import_'. $currentTime .'_scriptures_' . time() . '.' . $extension;
    //     $path = $file->storeAs('public/files/scriptures', $fileNameToStore);

    //     return $path;
    // }

    // protected function saveFinalScriptures($filtered, $fiscalYear)
    // {
    //     foreach($filtered as $item) {
    //         $scripture = new Scripture();
    //         $scripture->fiscal_year_id = $fiscalYear->id;
    //         $scripture->analytic_account_id = $item->analytic_account;
    //         $scripture->general_account_id = $item->general_account;
    //         $scripture->date_entry = $item->date_entry;
    //         $scripture->journal = $item->journal;
    //         $scripture->piece_nb = $item->piece_nb;
    //         $scripture->name = $item->name;
    //         $scripture->debit_amount = $item->debit_amount;
    //         $scripture->credit_amount = $item->credit_amount;
    //         $scripture->result_amount = $item->credit_amount - $item->debit_amount;
    //         $scripture->entry_type = 'Réalisé';

    //         $scripture->save();
    //     }
    // }

}
