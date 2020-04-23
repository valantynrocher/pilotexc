<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Structure extends Model
{
    protected $table = 'structures';

    public $timestamps = false;

    public $fillable = ['name'];

    //RELATIONS
    public function analyticAccounts()
    {
        return $this->hasMany('App\AnalyticAccount');
    }
}
