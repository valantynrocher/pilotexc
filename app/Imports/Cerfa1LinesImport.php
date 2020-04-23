<?php

namespace App\Imports;

use App\Cerfa1Line;
use Maatwebsite\Excel\Concerns\ToModel;

class Cerfa1LinesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Cerfa1Line([
            'name' => $row[0],
            'cerfa1_group_id' => $row[1]
        ]);
    }
}
