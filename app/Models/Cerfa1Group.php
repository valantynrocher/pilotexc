<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cerfa1Group extends Model
{
    protected $table = 'cerfa1_groups';

    public $timestamps = false;

    public $fillable = ['name', 'direct_indirect', 'charges_produits'];

    //RELATIONS
    public function cerfa1_lines()
    {
        return $this->hasMany(Cerfa1Line::class);
    }
}
