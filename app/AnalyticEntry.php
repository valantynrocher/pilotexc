<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class AnalyticEntry extends Model
{
    protected $table = 'analytic_entries';

    public $timestamps = false;

    public $fillable = ['analytic_account_id', 'general_account_id', 'date_entry', 'journal', 'piece_nb', 'name', 'debit_amount', 'credit_amount', 'entry_type', 'client_id'];

    protected $dateFormat = 'dd/mm/yyyy';

    // RELATIONS
    public function analyticAccount()
    {
        return $this->belongsTo('App\AnalyticAccount');
    }

    public function generalAccount()
    {
        return $this->belongsTo('App\GeneralAccount');
    }

}
