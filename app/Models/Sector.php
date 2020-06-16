<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    protected $table = 'sectors';

    public $timestamps = false;

    public $fillable = ['name','folder_id'];

    // RELATIONS
    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function folder()
    {
        return $this->belongsTo(Folder::class);
    }
}
