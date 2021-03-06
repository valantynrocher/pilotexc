<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Structure extends Model
{
    protected $table = 'structures';

    public $timestamps = false;

    public $fillable = ['name'];

    //RELATIONS
    public function analyticAccounts()
    {
        return $this->hasMany(AnalyticAccount::class);
    }

    public function scriptures()
    {
        return $this->hasManyThrough(
            Scripture::class,
            AnalyticAccount::class,
            'structure_id',
            'analytic_account_id',
            'id',
            'id'
        );
    }
}
