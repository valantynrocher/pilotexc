<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cerfa1Line extends Model
{
    protected $table = 'cerfa1_lines';

    public $timestamps = false;

    public $fillable = ['name', 'cerfa1_group_id'];

    //RELATIONS
    public function cerfa1Group()
    {
        return $this->belongsTo(('App\Cerfa1Group'));
    }

    public function generalAccounts()
    {
        return $this->hasMany(('App\GeneralAccount'));
    }
}
