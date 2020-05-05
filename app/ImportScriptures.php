<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImportScriptures extends Model
{
    protected $table = 'import_scriptures';

    public $fillable = [
        'analytic_account',
        'general_account',
        'date_entry',
        'journal',
        'piece_nb',
        'name',
        'debit_amount',
        'credit_amount'
    ];

    protected $dates = ['date_entry'];

    protected $casts = [
        'analytic_account' => 'bigInteger',
        'general_account' => 'bigInteger',
        'debit_amount' => 'float',
        'credit_amount' => 'float'
    ];
}
