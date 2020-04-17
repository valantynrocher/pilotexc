<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class AnalyticEntry extends Model
{
    protected $table = 'analytic_entries';

    public $incrementing = true;

    protected $primaryKey = 'id';

    public $timestamps = false;

    public $fillable = ['analytic_account_id', 'general_account_id', 'date_entry', 'journal', 'piece_nb', 'name', 'debit_amount', 'credit_amount', 'type_id'];

    protected $dates = [
        'date_entry'
    ];

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

    public function entryType()
    {
        return $this->belongsTo('App\EntryType');
    }

}
