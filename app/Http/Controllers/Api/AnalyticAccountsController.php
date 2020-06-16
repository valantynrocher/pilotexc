<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\AnalyticAccount;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AnalyticAccountsController extends Controller
{
    /**
    * Display a listing of analytic accounts.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $data = AnalyticAccount::with(['structure', 'service.sector.folder'])->get();

        return $data->toJson();
    }

    /**
    * Store a newly created analytic account in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    */
    public function store(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'name' => 'required',
            'structure_id' => 'required',
            'service_id' => 'required'
        ]);

        $account = new AnalyticAccount();
        $account->id = $request->input('id');
        $account->name = $request->input('name');
        $account->active = $request->input('active');
        $account->structure_id = $request->input('structure_id');
        $account->service_id = $request->input('service_id');
        $account->save();

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
        $data = AnalyticAccount::where('id', $id)
        ->with(['structure', 'service.sector.folder'])
        ->first();

        return $data->toJson();
    }

    /**
    * Update the specified analytic account in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'structure_id' => 'required',
            'service_id' => 'required'
        ]);

        $account = AnalyticAccount::find($id);
        $account->name = $request->input('name');
        $account->active = $request->input('active');
        $account->structure_id = $request->input('structure_id');
        $account->service_id = $request->input('service_id');
        $account->save();

        return 204;
    }

    /**
    * Delete the selected general account
    * @param  int  $id
    */
    public function destroy($id)
    {
        AnalyticAccount::find($id)->delete();

        return 204;
    }

    /**
    * Update the selected analytic accounts and set to active. Call with ajax
    */
    public function activate(Request $request)
    {
        $inputs = $request->except(['_token']);
        foreach($inputs as $k => $v) {
            $account = AnalyticAccount::find($v);
            $account->active = 1;
            $account->save();
        }

        return 204;
    }

    /**
    * Update the selected analytic accounts and set to inactive. Call with ajax
    */
    public function desactivate(Request $request)
    {
        $inputs = $request->except(['_token']);
        foreach($inputs as $k => $v) {
            $account = AnalyticAccount::find($v);
            $account->active = 0;
            $account->save();
        }

        return 204;
    }

    /**
    * Update the selected analytic accounts and set service and structure. Call with ajax
    */
    public function affect(Request $request)
    {
        $inputs = $request->except(['_token', 'structure_id', 'folder', 'sector', 'service_id']);
        foreach($inputs as $k => $v) {
            $account = AnalyticAccount::find($v);
            $account->service_id = $request->input('service_id');
            $account->structure_id = $request->input('structure_id');
            $account->save();
        }

        return 204;
    }
}
