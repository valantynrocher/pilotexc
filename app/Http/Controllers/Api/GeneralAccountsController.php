<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\GeneralAccount;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;

class GeneralAccountsController extends Controller
{
    /**
    * Display a listing of the resource : general accounts
    *
    * @return JSON
    */
    public function index()
    {
        $data = GeneralAccount::with(['accountSubclass.accountClass', 'cerfa1Line.cerfa1Group'])
            ->get();

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'name' => 'required',
            'cerfa1_line_id' => 'required'
        ]);

        $generalAccount = new GeneralAccount();
        $generalAccount->id = $request->input('id');
        $generalAccount->name = $request->input('name');
        $generalAccount->account_subclass_id = substr($request->input('id'), 0, 2);
        $generalAccount->cerfa1_line_id = $request->input('cerfa1_line_id');
        $generalAccount->active = $request->input('active');
        $generalAccount->save();

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
        $data = GeneralAccount::where('id', $id)
            ->with(['accountSubclass.accountClass', 'cerfa1Line.cerfa1Group'])
            ->first();

        return response()->json($data);
    }


    /**
     * Update the specified resource in storage
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'cerfa1_line_id' => 'required'
        ]);

        $generalAccount = GeneralAccount::find($id);
        $generalAccount->name = $request->input('name');
        $generalAccount->cerfa1_line_id = $request->input('cerfa1_line_id');
        $generalAccount->active = $request->input('active');
        $generalAccount->save();

        return 204;
    }


    /**
     * Delete the selected general account
     * @param  int  $id
     */
    public function destroy($id)
    {
        GeneralAccount::find($id)->delete();
        return 204;
    }


    /**
     * Update the selected resources to active
     */
    public function activate(Request $request)
    {
        $inputs = $request->except(['_token']);
        foreach($inputs as $k => $v) {
            $generalAccount = GeneralAccount::find($v);
            $generalAccount->active = 1;
            $generalAccount->save();
        }
        return 204;
    }


    /**
     * Update the selected resources to active
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function desactivate(Request $request)
    {
        $inputs = $request->except(['_token']);
        foreach($inputs as $k => $v) {
            $generalAccount = GeneralAccount::find($v);
            $generalAccount->active = 0;
            $generalAccount->save();
        }
        return 204;
    }

    /**
     * Update the selected analytic accounts and set service and structure
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function affect(Request $request)
    {
        $accounts = $request->except(['_token', 'cerfa1_group', 'cerfa1_line_id']);
        foreach($accounts as $k => $v) {
            $generalAccount = GeneralAccount::find($v);
            $generalAccount->cerfa1_line_id = $request->input('cerfa1_line_id');
            $generalAccount->save();
        }
        return 204;
    }
}
