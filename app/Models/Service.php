<?php

namespace App\Models;

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

    public function scriptures()
    {
        return $this->hasManyThrough(
            Scripture::class,
            AnalyticAccount::class,
            'service_id',
            'analytic_account_id',
            'id',
            'id'
        );
    }
}
