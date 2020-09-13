<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
    protected $table = 'degrees';
  	protected $fillable = [
  	  'id','degree','section','turn','active'
  	];


    public function shoolYear()
    {
        return $this->belongsToMany('App\SchoolYear')
                    ->using('App\DegreeSchoolYear','school_year_id');
    }

    public function teacher()
    {
        return $this->belongsToMany('App\User','degree_school_year','degree_id','user_id')
                    ->using('App\DegreeSchoolYear')->withPivot([
                      'capacity',
                      'id'
                    ]);
    }

    public function subjects()
    {
        return $this->belongsToMany('App\Subject','degree_subject_year','degree_id','subject_id')
                    ->using('App\DegreeSchoolSubject')->withPivot([
                      'user_id',
                      'id',
                      'school_year_id'
                    ]);
    }


}
