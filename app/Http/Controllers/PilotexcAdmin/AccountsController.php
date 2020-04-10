<?php

namespace App\Http\Controllers\PilotexcAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountsController extends Controller
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
