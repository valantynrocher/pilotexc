<?php

namespace App\Http\Controllers\Api;

use App\Models\Sector;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SectorsController extends Controller
{
    public function index()
    {
        $data = Sector::all();
        return response()->json($data);
    }


    /**
     * Ajax request to get options for sector select element
     */
    public function sectorsByFolder($folderId)
    {
        $data = Sector::where('folder_id', $folderId)
            ->get();
        return response()->json($data);
    }
}
