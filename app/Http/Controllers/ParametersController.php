<?php

namespace App\Http\Controllers;

use App\FiscalYear;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ParametersController extends Controller
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
     * Show the first tab pane : Analytic account
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $fiscalYears = FiscalYear::orderBy('year_start', 'asc')->get();

        return view('parameters.index', [
            'fiscalYears' => $fiscalYears
        ]);
    }

    public function storeFiscalYear(Request $request)
    {
        $fiscalYear = new FiscalYear();

        $fiscalYear->name = $request->input('name');
        $fiscalYear->month_start = $request->input('month_start');
        $fiscalYear->year_start = $request->input('year_start');
        $fiscalYear->month_end = $request->input('month_end');
        $fiscalYear->year_end = $request->input('year_end');
        $fiscalYear->status = $request->input('status');

        $fiscalYear->save();
    }
}
