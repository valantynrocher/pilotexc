<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountClass extends Model
{
    protected $table = 'account_classes';

    public $incrementing = false;

    protected $primaryKey = 'id';

    public $timestamps = false;

    public $fillable = ['name', 'summary_report'];

    // RELATIONS
    public function accountSubclasses()
    {
        return $this->hasMany('App\AccountSubclass');
    }
}
