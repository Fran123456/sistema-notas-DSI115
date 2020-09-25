<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BehaviorIndicatorsStudent extends Model
{
    protected $table = 'behavior_indicators_student';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'behavior_indicator_id',
        'student_id',
        'school_period_id',
        'school_year_id',
        'degree_id'

    ];

    public function indicator(){
        return $this->belongsTo('App\BehaviorIndicator', 'behavior_indicator_id');
    }
}
