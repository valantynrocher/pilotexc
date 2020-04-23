<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnalyticAccount extends Model
{
    protected $table = 'analytic_accounts';

    public $incrementing = false;

    public $timestamps = false;

    public $fillable = ['id','name', 'active', 'service_id', 'structure_id', 'in_charge_id', 'client_id'];

    // RELATIONS
    public function analyticEntries()
    {
        return $this->hasMany('App\AnalyticEntry');
    }

    public function service()
    {
        return $this->belongsTo('App\Service');
    }

    public function structure()
    {
        return $this->belongsTo('App\Structure');
    }
}
