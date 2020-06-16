<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FiscalYear extends Model
{
    protected $table = 'fiscal_years';

    public $timestamps = false;

    public $fillable = [
        'name',
        'month_start',
        'year_start',
        'month_end',
        'year_end',
        'status'
    ];

    protected $casts = [
        'month_start' => 'integer',
        'year_start' => 'integer',
        'month_end' => 'integer',
        'year_end' => 'integer'
    ];

    public function scriptures()
    {
        return $this->hasMany(Scripture::class);
    }
}
