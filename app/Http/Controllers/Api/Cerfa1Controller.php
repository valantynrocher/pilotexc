<?php

namespace App\Http\Controllers\Api;

use App\Models\Cerfa1Line;
use App\Models\Cerfa1Group;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Cerfa1Controller extends Controller
{
    /**
     * Get a list of Cerfa1 Groups
     */
    public function groups()
    {
        $data = Cerfa1Group::all();
        return response()->json($data);
    }


    /**
     * Get a list of Cerfa1 Lines according it parent group
     * @param  int  $groupId
     */
    public function linesByGroup($groupId)
    {
        $data = Cerfa1Line::where('cerfa1_group_id', $groupId)->get();
        return response()->json($data);
    }
}
