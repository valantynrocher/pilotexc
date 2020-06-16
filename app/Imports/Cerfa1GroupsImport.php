<?php

namespace App\Imports;

use App\Models\Cerfa1Group;
use Maatwebsite\Excel\Concerns\ToModel;

class Cerfa1GroupsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Cerfa1Group([
            'name' => $row[0],
            'direct_indirect' => $row[1],
            'charges_produits' => $row[2]
        ]);
    }
}
