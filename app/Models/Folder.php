<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    protected $table = 'folders';

    public $timestamps = false;

    public $fillable = ['name'];

    // RELATIONS
    public function sectors()
    {
        return $this->hasMany(Sector::class);
    }
}
