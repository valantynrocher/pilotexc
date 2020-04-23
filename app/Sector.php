<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    protected $table = 'sectors';

    public $timestamps = false;

    public $fillable = ['name','folder_id'];

    // RELATIONS
    public function services()
    {
        return $this->hasMany('App\Service');
    }

    public function folder()
    {
        return $this->belongsTo('App\Folder');
    }
}
