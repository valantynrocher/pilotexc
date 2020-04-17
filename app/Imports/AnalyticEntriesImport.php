<?php

namespace App\Imports;

use App\AnalyticEntry;
use Maatwebsite\Excel\Concerns\ToModel;

class AnalyticEntriesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new AnalyticEntry([
            'analytic_account_id' => $row[0],
            'general_account_id' => $row[1],
            'date_entry' => $row[2],
            'journal' => $row[3],
            'piece_nb' => $row[4],
            'name' => $row[5],
            'debit_amount' => $row[6],
            'credit_amount' => $row[7]
        ]);
    }
}
