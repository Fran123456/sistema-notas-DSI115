<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScoreType extends Model
{
    protected $table = 'score_type';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'school_period_id',
        'school_year_id',
        'percentage',
        'activity',
        'description',
        'date',
        'state'
    ];
}
	