<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneralAccount extends Model
{
    protected $table = 'general_accounts';

    public $incrementing = false;

    public $timestamps = false;

    public $fillable = ['id', 'account_subclass_id', 'name', 'cerfa1_line_id', 'active', 'client_id'];

    // RELATIONS
    public function accountSubclass()
    {
        return $this->belongsTo(AccountSubclass::class, 'account_subclass_id');
    }

    public function accountClass()
    {
        return $this->hasOneThrough(AccountClass::class, AccountSubclass::class);
    }

    public function cerfa1Line()
    {
        return $this->belongsTo(Cerfa1Line::class);
    }

    public function scriptures()
    {
        return $this->hasMany(Scripture::class);
    }
}
