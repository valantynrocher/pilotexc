<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountSubclass extends Model
{
    protected $table = 'account_subclasses';

    public $incrementing = false;

    protected $primaryKey = 'id';

    public $timestamps = false;

    public $fillable = ['id', 'name', 'account_class_id', 'detailed_result_level', 'compact_result_level'];

    // RELATIONS
    public function generalAccounts()
    {
        return $this->hasMany('App\GeneralAccount');
    }

    public function accountClass()
    {
        return $this->belongsTo(AccountClass::class);
    }
}
