<?php

namespace App\Http\Controllers\Api;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServicesController extends Controller
{

    /**
     * Ajax request to get options for service select element
     */
    public function servicesBySector($sectorId)
    {
        $data = Service::where('sector_id', $sectorId)->get();

        return response()->json($data);
    }
}
