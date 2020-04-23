<?php

namespace App\Http\Controllers;

use App\AnalyticEntry;
use App\Http\Controllers\Controller;

class ScripturesController extends Controller
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
        $datas = AnalyticEntry::all();
        return view('scriptures.index', [
            'datas' => $datas
        ]);
    }
}
