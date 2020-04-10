<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnalyticAccount extends Model
{
    protected $connection = 'mysql2';

    protected $table = 'analytic_accounts';

    public $incrementing = false;

    protected $primaryKey = 'id';

    public $timestamps = false;

    public $fillable = ['analytic_section','name', 'service', 'sector', 'folder', 'structure'];

    // RELATIONS
    public function analyticEntries()
    {
        return $this->hasMany('App\AnalyticEntry');
    }
}
