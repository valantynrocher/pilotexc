<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\ImportScriptures;
use Maatwebsite\Excel\Concerns\ToModel;

class ScripturesImport implements ToModel
// , WithValidation, SkipsOnFailure
{
    // use Importable, SkipsFailures;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if (is_int($row[2]) && strlen($row[2]) === 5) {
            $date = ($row[2] - 25569) * 86400;
            $date = Carbon::createFromTimestamp($date);
        } else {
            $date = Carbon::createFromFormat('d/m/Y', $row[2]);
        }
        return new ImportScriptures([
            'analytic_account' => $row[0],
            'general_account' => $row[1],
            'date_entry' => $date,
            'journal' => $row[3],
            'piece_nb' => $row[4],
            'name' => $row[5],
            'debit_amount' => $row[6],
            'credit_amount' => $row[7]
        ]);
    }

    // public function rules(): array
    // {
    //     return [
    //         '2' => 'date|date_format:/mm/YYYY'
    //     ];
    // }
}
