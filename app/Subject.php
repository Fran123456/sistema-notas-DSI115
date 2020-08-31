<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
   protected $table = 'subjects';
  	protected $fillable = [
  	  'id','name','active','created_at','updated_at'
  	];

    public function shoolYear()
    {
        return $this->belongsToMany('App\SchoolYear')
                    ->using('App\DegreeSchoolYear','school_year_id');
    }


    public function degrees()
    {
        return $this->belongsToMany('App\Degree','degree_subject_year','subject_id','degree_id')
                    ->using('App\DegreeSchoolSubject','degree_id');
    }


}
