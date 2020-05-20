<?php

namespace App\Http\Controllers;

use App\FiscalYear;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsersController extends Controller
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
     *
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('users.index');
    }

    public function vueJs()
    {
        return view('users.vuejs');
    }

    /**
     * @return \Illuminate\Http|Response
     */
    public function axios()
    {
        $fiscalYears = FiscalYear::all();

        return response()->json($fiscalYears);
    }
}
