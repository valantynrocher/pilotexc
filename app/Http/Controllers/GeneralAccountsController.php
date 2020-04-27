<?php

namespace App\Http\Controllers;

use App\Cerfa1Line;
use App\Cerfa1Group;
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
        $accounts = GeneralAccount::all();
        $cerfa1Groups = Cerfa1Group::all();

        return view('generalAccounts.index', [
            'accounts' => $accounts,
            'cerfa1Groups' => $cerfa1Groups
        ]);
    }


    /**
     * Ajax request to get options for lines select element
     */
    public function getCerfa1Lines(Request $request)
    {
        $lines = Cerfa1Line::where('cerfa1_group_id', $request->id)->get();

        return response()->json($lines);
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
        $generalAccount->cerfa1_line_id = $request->input('cerfa1_line_id');
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
        $generalAccount->cerfa1_line_id = $request->input('cerfa1_line_id');
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

    /**
     * Update the selected analytic accounts and set service and structure. Call with ajax
     */
    public function affect(Request $request)
    {
        print_r($request);
        $inputs = $request->except(['_token']);
        foreach($inputs as $k => $v) {
            $generalAccount = GeneralAccount::find($v);
            $generalAccount->cerfa1_line_id = $request->input('cerfa1_line_id');
            $generalAccount->save();
        }
    }


    /**
     * Delete the selected general account. Call with ajax
     */
    public function destroy($id)
    {
        $account = GeneralAccount::find($id);
        $account->delete();
    }
}
