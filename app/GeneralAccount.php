<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeneralAccount extends Model
{
    protected $table = 'general_accounts';

    public $incrementing = false;

    protected $primaryKey = 'id';

    public $timestamps = false;

    public $fillable = ['id', 'account_subclass_id', 'name',
    'cerfa1_line_id', 'active', 'client_id'];

    // RELATIONS
    public function analyticEntries()
    {
        return $this->hasMany('App\AnalyticEntry');
    }

    public function accountSubclass()
    {
        return $this->belongsTo('App\AccountSubclass');
    }

    public function cerfa1Line()
    {
        return $this->belongsTo('App\Cerfa1Line');
    }
}
