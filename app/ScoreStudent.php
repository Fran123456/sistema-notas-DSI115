<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScoreStudent extends Model
{
  protected $table = 'score_students';
  protected $fillable = [
    'id','score_type_id','student_id','school_period_id','school_year_id','degree_id','score',
    'created_at','updated_at','subject_id'
  ];

  public function score_types()
  {
      return $this->belongsTo('App\ScoreType','score_type_id');
  }

  public function student()
  {
      return $this->belongsTo('App\Student','student_id');
  }

  public function school_period()
  {
      return $this->belongsTo('App\SchoolPeriod','school_period_id');
  }

  public function school_year()
  {
      return $this->belongsTo('App\SchoolYear','school_year_id');
  }

  public function degree()
  {
      return $this->belongsTo('App\Degree','degree_id');
  }

  public function subject()
  {
      return $this->belongsTo('App\Subject','subject_id');
  }

}
