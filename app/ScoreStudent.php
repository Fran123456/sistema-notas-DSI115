<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScoreStudent extends Model
{
  protected $table = 'score_students';
  protected $fillable = [
    'id','score_type_id','student_id','school_period_id','school_year_id','degree_id','score',
    'created_at','updated_at'
  ];
}
