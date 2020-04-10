<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountSubclass extends Model
{
    protected $connection = 'mysql2';

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
