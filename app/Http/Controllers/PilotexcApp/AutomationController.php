<?php

namespace App\Http\Controllers\PilotexcApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AutomationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
}
