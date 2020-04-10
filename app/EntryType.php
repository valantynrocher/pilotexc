<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EntryType extends Model
{
    protected $connection = 'mysql2';

    protected $table = 'entry_types';

    public $incrementing = true;

    protected $primaryKey = 'id';

    public $timestamps = false;

    public $fillable = ['name'];

    public function analyticEntries()
    {
        return $this->hasMany('App\AnalyticEntry');
    }
}
