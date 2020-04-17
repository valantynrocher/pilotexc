<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnalyticAccount extends Model
{
    protected $table = 'analytic_accounts';

    public $incrementing = false;

    protected $primaryKey = 'id';

    public $timestamps = false;

    public $fillable = ['id','name', 'service', 'sector', 'folder', 'structure', 'in_charge_id'];

    // RELATIONS
    public function analyticEntries()
    {
        return $this->hasMany('App\AnalyticEntry');
    }
}
