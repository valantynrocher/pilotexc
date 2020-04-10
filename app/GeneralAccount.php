<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeneralAccount extends Model
{
    protected $connection = 'mysql2';

    protected $table = 'general_accounts';

    public $incrementing = false;

    protected $primaryKey = 'id';

    public $timestamps = false;

    public $fillable = ['account_subclass_id','name', 'cerfa_group1',
    'cerfa_line1', 'cerfa_group2', 'cerfa_line2', 'cerfa_group3',
    'cerfa_line3', 'active'];

    public function analyticEntries()
    {
        return $this->hasMany('App\AnalyticEntry');
    }
}
