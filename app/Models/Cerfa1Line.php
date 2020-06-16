<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cerfa1Line extends Model
{
    protected $table = 'cerfa1_lines';

    public $timestamps = false;

    public $fillable = ['name', 'cerfa1_group_id'];

    //RELATIONS
    public function cerfa1Group()
    {
        return $this->belongsTo(Cerfa1Group::class);
    }

    public function general_accounts()
    {
        return $this->hasMany(GeneralAccount::class);
    }
}
