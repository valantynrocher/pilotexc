<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnalyticEntry extends Model
{
    protected $connection = 'mysql2';

    protected $table = 'analytic_entries';

    public $incrementing = true;

    protected $primaryKey = 'id';

    public $timestamps = false;

    public $fillable = ['analytic_account_id', ];

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
