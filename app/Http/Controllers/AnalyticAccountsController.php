<?php

namespace App\Http\Controllers;

use App\Structure;
use App\AnalyticAccount;
use App\Folder;
use App\Sector;
use App\Service;
use Illuminate\Http\Request;

class AnalyticAccountsController extends Controller
{
    /**
     * Display a listing of analytic accounts.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts = AnalyticAccount::all();
        $folders = Folder::all();
        $structures = Structure::all();
        return view('analyticAccounts.index', [
            'accounts' => $accounts,
            'folders' => $folders,
            'structures' => $structures
        ]);
    }

    /**
     * Ajax request to get options for sector select element
     */
    public function getSectors(Request $request)
    {
        $sectors = Sector::where('folder_id', $request->id)->get();

        return response()->json($sectors);
    }

    /**
     * Ajax request to get options for service select element
     */
    public function getServices(Request $request)
    {
        $services = Service::where('sector_id', $request->id)->get();

        return response()->json($services);
    }

    /**
     * Store a newly created analytic account in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $analyticAccount = new AnalyticAccount();

        $analyticAccount->id = $request->input('id');
        $analyticAccount->name = $request->input('name');
        $analyticAccount->active = $request->input('active');
        $analyticAccount->structure_id = $request->input('structure_id');
        $analyticAccount->service_id = $request->input('service_id');

        $analyticAccount->save();
    }

    /**
     * Update the specified analytic account in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $analyticAccount = AnalyticAccount::find($id);

        $analyticAccount->name = $request->input('name');
        $analyticAccount->active = $request->input('active');
        $analyticAccount->structure_id = $request->input('structure_id');
        $analyticAccount->service_id = $request->input('service_id');

        $analyticAccount->save();
    }

    /**
     * Update the selected analytic accounts and set to active. Call with ajax
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
     * Update the selected analytic accounts and set to inactive. Call with ajax
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

    /**
     * Update the selected analytic accounts and set service and structure. Call with ajax
     */
    public function affect(Request $request)
    {
        print_r($request);
        $inputs = $request->except(['_token']);
        foreach($inputs as $k => $v) {
            $analyticAccount = AnalyticAccount::find($v);
            $analyticAccount->service_id = $request->input('service_id');
            $analyticAccount->structure_id = $request->input('structure_id');
            $analyticAccount->save();
        }
    }

    /**
     * Delete the selected analytic account
     */
    public function destroy($id)
    {
        $account = AnalyticAccount::find($id);
        $account->delete();
    }
}
