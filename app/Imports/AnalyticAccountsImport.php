<?php

namespace App\Imports;

use App\Models\AnalyticAccount;
use Maatwebsite\Excel\Concerns\ToModel;

class AnalyticAccountsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new AnalyticAccount([
            'id' => $row[0],
            'name' => $row[1],
            'service_id' => $row[2],
            'structure_id' => $row[3]
        ]);
    }
}
