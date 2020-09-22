<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolPeriod extends Model
{
    protected $table = 'school_period';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'start_date',
        'end_date',
        'nperiodo',

        'current',
        'school_year_id'
    ];

    public function year()
    {
        return $this->belongsTo('App\SchoolYear','school_year_id');
    }
}
