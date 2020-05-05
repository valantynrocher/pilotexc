<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnalyticAccount extends Model
{
    protected $table = 'analytic_accounts';

    public $incrementing = false;

    public $timestamps = false;

    public $fillable = ['id','name', 'active', 'service_id', 'structure_id', 'in_charge_id', 'client_id'];

    // RELATIONS
    public function scriptures()
    {
        return $this->hasMany(Scripture::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function structure()
    {
        return $this->belongsTo(Structure::class);
    }
}
