<?php

namespace App\Http\Controllers;

use App\AnalyticAccount;
use Illuminate\Http\Request;

class AnalyticAccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = AnalyticAccount::all();
        return view('analyticAccounts.index', [
            'datas' => $datas
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $analyticAccount = new AnalyticAccount();

        $analyticAccount->id = $request->input('id');
        $analyticAccount->name = $request->input('name');
        $analyticAccount->service = $request->input('service');
        $analyticAccount->sector = $request->input('sector');
        $analyticAccount->folder = $request->input('folder');
        $analyticAccount->structure = $request->input('structure');

        $analyticAccount->save();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $analyticAccount = AnalyticAccount::find($id);

        $analyticAccount->name = $request->input('name');
        $analyticAccount->service = $request->input('service');
        $analyticAccount->sector = $request->input('sector');
        $analyticAccount->folder = $request->input('folder');
        $analyticAccount->structure = $request->input('structure');
        $analyticAccount->active = $request->input('active');

        $analyticAccount->save();
    }

    /**
     * Update the selected resources to active. Call with ajax
     */
    public function activate(Request $request)
    {
        $inputs = $request->except(['_token']);
        foreach($inputs as $k => $v) {
            $analyticAccount = AnalyticAccount::find($v);
            $analyticAccount->active = 1;
            $analyticAccount->save();
        }
    }

    /**
     * Update the selected resources to active. Call with ajax
     */
    public function desactivate(Request $request)
    {
        $inputs = $request->except(['_token']);
        foreach($inputs as $k => $v) {
            $analyticAccount = AnalyticAccount::find($v);
            $analyticAccount->active = 0;
            $analyticAccount->save();
        }
    }
}
