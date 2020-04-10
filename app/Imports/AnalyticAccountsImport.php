<?php

namespace App\Imports;

use App\AnalyticAccount;
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
            'analytic_section' => $row[0],
            'name' => $row[1],
            'service' => $row[2],
            'sector' => $row[3],
            'folder' => $row[4],
            'structure' => $row[5]
        ]);
    }
}
