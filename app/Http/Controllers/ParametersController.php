<?php

namespace App\Http\Controllers;

use App\Models\FiscalYear;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
     * Show the main parameters page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('pages.parameters.generals');
    }

    /**
     * return the view component for fiscal years
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function fiscalYears()
    {
        return view('pages.parameters.fiscal-years');
    }

    /**
     * return the view component for general accounts
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function generalAccounts()
    {
        return view('pages.parameters.accounts_general');
    }

    /**
     * return the view component for analytic accounts
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function analyticAccounts()
    {
        return view('pages.parameters.accounts_analytic');
    }

    // public function storeFiscalYear(Request $request)
    // {
    //     $fiscalYear = new FiscalYear();

    //     $fiscalYear->name = $request->input('name');
    //     $fiscalYear->month_start = $request->input('month_start');
    //     $fiscalYear->year_start = $request->input('year_start');
    //     $fiscalYear->month_end = $request->input('month_end');
    //     $fiscalYear->year_end = $request->input('year_end');
    //     $fiscalYear->status = $request->input('status');

    //     $fiscalYear->save();
    // }
}
