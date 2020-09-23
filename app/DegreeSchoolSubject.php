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

  public function subject()
  {
        return $this->belongsTo('App\Subject','subject_id');
  }

  public function docente()
  {
        return $this->belongsTo('App\User','user_id');
  }

  public function school_year()
  {
        return $this->belongsTo('App\SchoolYear','school_year_id');
  }

  public function degree()
  {
        return $this->belongsTo('App\Degree','degree_id');
  }

}
