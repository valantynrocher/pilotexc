<?php

namespace App\Imports;

use App\GeneralAccount;
use Maatwebsite\Excel\Concerns\ToModel;

class GeneralAccountsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new GeneralAccount([
            'id' => $row[0],
            'account_subclass_id' => $row[1],
            'name' => $row[2]
        ]);
    }
}
