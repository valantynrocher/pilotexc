<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FiscalYearsController extends Controller
{
    public function index()
    {
        $fiscalYears = FiscalYear::orderBy('year_start', 'asc')->get();

        return view('parameters.index', [
            'fiscalYears' => $fiscalYears
        ]);
    }
}
