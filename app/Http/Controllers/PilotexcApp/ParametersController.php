<?php

namespace App\Http\Controllers\PilotexcApp;

use App\AnalyticAccount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AnalyticAccountsImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ParametersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the first tab pane : Analytic account
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $datas = AnalyticAccount::all();

        return view('pilotexcApp.parameters.index', [
            'datas' => $datas
        ]);
    }

    /**
     * Analytic Accounts Importation
     */
    public function analyticImport(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'select_file' => 'required|max:5000|mimes:xlsx,xls,csv'
        ]);

        if($validator->fails()) {
            return redirect(route('app.parameters.analytic'))->with([
                'errors' => $validator->errors()
            ]);
        } else {
            // truncate rows in database before import new file
            DB::connection('mysql2')->table('analytic_accounts')->truncate();

            // Modify file name with date time
            // store each file in upload/comptabilite-analytique/
            $dateTime = date('Ymd_His');
            $file = $request->file('select_file');
            $fileName = $dateTime . '_' . $file->getClientOriginalName();
            $savePath =public_path('upload/comptabilite-analytique/');
            $importFile = $file->move($savePath, $fileName);

            // read and import Excel sheet into database ('mysql2') in table 'analytic_accounts'
            Excel::import(new AnalyticAccountsImport, $importFile);

            // redirection with success
            return redirect(route('app.parameters.index'))->with('success', 'Votre fichier a été correctement importé !');
        }
    }
}
