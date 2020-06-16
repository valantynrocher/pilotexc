<?php

namespace App\Http\Controllers\Api;

use App\Models\Folder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FoldersController extends Controller
{
    /**
     * Display a listing of analytic accounts.
     *
     * @return JSON
     */
    public function index()
    {
        $data = Folder::all();

        return response()->json($data);
    }
}
