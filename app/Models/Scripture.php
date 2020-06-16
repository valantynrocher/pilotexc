<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

Carbon::setToStringFormat('dd-mm-YYYY');

class Scripture extends Model
{
    protected $table = 'scriptures';

    public $timestamps = false;

    public $fillable = [
        'fiscal_year_id',
        'analytic_account_id',
        'general_account_id',
        'date_entry',
        'journal',
        'piece_nb',
        'name',
        'debit_amount',
        'credit_amount',
        'entry_type',
        'client_id'
    ];

    protected $dates = ['date_entry'];

    protected $casts = [
        'analytic_account_id' => 'bigInteger',
        'general_account_id' => 'bigInteger',
        'debit_amount' => 'float',
        'credit_amount' => 'float',
        'result_amount' => 'float'
    ];

    // RELATIONS
    public function fiscalYear()
    {
        return $this->belongsTo(FiscalYear::class);
    }

    public function analyticAccount()
    {
        return $this->belongsTo(AnalyticAccount::class);
    }

    public function generalAccount()
    {
        return $this->belongsTo(GeneralAccount::class);
    }

    public function structure()
    {
        return $this->hasOneThrough(Structure::class, AnalyticAccount::class);
    }
}
