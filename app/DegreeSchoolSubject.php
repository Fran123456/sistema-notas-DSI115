<?php

namespace App;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Model;

class DegreeSchoolSubject extends Pivot
{
  protected $table = 'degree_subject_year';
  protected $fillable = [
    'id','subject_id','user_id','school_year_id','degree_id','created_at','updated_at'
  ];

}
