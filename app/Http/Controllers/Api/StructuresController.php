<?php

namespace App\Http\Controllers\Api;

use App\Models\Structure;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StructuresController extends Controller
{
    /**
     * Display a listing of analytic accounts.
     *
     * @return JSON
     */
    public function index()
    {
        $data = Structure::all();

        return response()->json($data);
    }
}
