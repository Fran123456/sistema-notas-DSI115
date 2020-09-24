<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Help\Help;

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

  public static function scoreByStudent($student, $period, $year, $degree){
    $scores = ScoreStudent::where('student_id', $student)
    ->where('school_period_id', $period)
    ->where('school_year_id', $year)
    ->where('degree_id', $degree)->get();
   // ->where('subject_id', $subject)->get();
    return $scores;
  }

  public static function scoreByStudentBySubject($student, $period, $year, $degree, $subject){
    $scores = ScoreStudent::where('student_id', $student)
    ->where('school_period_id', $period)
    ->where('school_year_id', $year)
    ->where('degree_id', $degree)
    ->where('subject_id', $subject)->get();
    return $scores;
  }


}
