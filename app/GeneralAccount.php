<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeneralAccount extends Model
{
    protected $table = 'general_accounts';

    public $incrementing = false;

    public $timestamps = false;

    public $fillable = ['id', 'account_subclass_id', 'name', 'cerfa1_line_id', 'active', 'client_id'];

    // RELATIONS
    public function account_subclass()
    {
        return $this->belongsTo('App\AccountSubclass', 'account_subclass_id');
    }

    public function cerfa1Line()
    {
        return $this->belongsTo('App\Cerfa1Line');
    }

    public function analytic_entries()
    {
        return $this->hasMany('App\AnalyticEntry');
    }
}
