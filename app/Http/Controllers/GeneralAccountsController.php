<?php

namespace App\Http\Controllers;

use App\GeneralAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class GeneralAccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = GeneralAccount::all();
        return view('generalAccounts.index', [
            'datas' => $datas
        ]);
    }


    /**
     * Store a newly created resource in storage. Call with ajax
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $generalAccount = new GeneralAccount();

        $generalAccount->id = $request->input('id');
        $generalAccount->name = $request->input('name');
        $generalAccount->account_subclass_id = substr($request->input('id'), 0, 2);
        $generalAccount->cerfa_line1 = $request->input('cerfa_line1');
        $generalAccount->cerfa_group1 = $request->input('cerfa_group1');
        $generalAccount->cerfa_line2 = $request->input('cerfa_line2');
        $generalAccount->cerfa_group2 = $request->input('cerfa_group2');
        $generalAccount->cerfa_line3 = $request->input('cerfa_line3');
        $generalAccount->cerfa_group3 = $request->input('cerfa_group3');
        $generalAccount->active = $request->input('active');

        $generalAccount->save();
    }


    /**
     * Update the specified resource in storage. Call with ajax
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {

        $generalAccount = GeneralAccount::find($id);

        $generalAccount->name = $request->input('name');
        $generalAccount->cerfa_line1 = $request->input('cerfa_line1');
        $generalAccount->cerfa_group1 = $request->input('cerfa_group1');
        $generalAccount->cerfa_line2 = $request->input('cerfa_line2');
        $generalAccount->cerfa_group2 = $request->input('cerfa_group2');
        $generalAccount->cerfa_line3 = $request->input('cerfa_line3');
        $generalAccount->cerfa_group3 = $request->input('cerfa_group3');
        $generalAccount->active = $request->input('active');

        $generalAccount->save();
    }

    /**
     * Update the selected resources to active. Call with ajax
     */
    public function activate(Request $request)
    {
        $inputs = $request->except(['_token']);
        foreach($inputs as $k => $v) {
            $generalAccount = GeneralAccount::find($v);
            $generalAccount->active = 1;
            $generalAccount->save();
        }
    }

    /**
     * Update the selected resources to active. Call with ajax
     */
    public function desactivate(Request $request)
    {
        $inputs = $request->except(['_token']);
        foreach($inputs as $k => $v) {
            $generalAccount = GeneralAccount::find($v);
            $generalAccount->active = 0;
            $generalAccount->save();
        }
    }
}
