<?php

namespace App\Imports;

use App\AccountSubclass;
use Maatwebsite\Excel\Concerns\ToModel;

class AccountSubClassImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new AccountSubclass([
            'id' => $row[0],
            'name' => $row[1],
            'account_class_id' => $row[2],
            'detailed_result_level' => $row[3],
            'compact_result_level' => $row[4]
        ]);
    }
}
