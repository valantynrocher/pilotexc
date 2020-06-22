<?php

namespace App\Http\Controllers\Api;

use App\Models\FiscalYear;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FiscalYearsController extends Controller
{
    /**
    * Display a listing of fiscal years.
    *
    * @return JSON
    */
    public function index()
    {
        $data = FiscalYear::orderBy('year_start', 'asc')->get();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'month_start' => 'required',
            'year_start' => 'required'
        ]);

        $fiscalYear = new FiscalYear();
        $fiscalYear->name = $request->input('name');
        $fiscalYear->month_start = $request->input('month_start');
        $fiscalYear->year_start = $request->input('year_start');
        $fiscalYear->month_end = $request->input('month_end');
        $fiscalYear->year_end = $request->input('year_end');
        $fiscalYear->status = $request->input('status');
        $fiscalYear->save();

        return 204;
    }

    /**
    * Get a resource to edit
    *
    * @param  int  $id
    * @return JSON
    */
    public function edit($id)
    {
        $data = FiscalYear::find($id);
        return response()->json($data);
    }

    /**
    * Update the specified fiscal year in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'status' => 'required'
        ]);

        $account = FiscalYear::find($id);
        $account->status = $request->input('status');
        $account->save();

        return 204;
    }

    public function getInProgress()
    {
        $data = FiscalYear::where('status', 'En cours')->get();
        return response()->json($data);
    }

    /**
    * Get last 5 exercises
    */
    public function getLastFive()
    {
        $data = FiscalYear::orderBy('year_start', 'desc')
        ->take(5)
        ->get();

        return response()->json($data);
    }
}
