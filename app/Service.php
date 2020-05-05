<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';

    public $timestamps = false;

    public $fillable = ['name','sector_id'];

    // RELATIONS
    public function analyticAccounts()
    {
        return $this->hasMany(AnalyticAccount::class);
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }
}
