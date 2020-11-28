<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolYear extends Model
{
    protected $table = 'school_years';
  	protected $fillable = [
  	  'id','start_date','end_date','year','active','created_at','updated_at','finish'
  	];

    public function degrees()
    {
        return $this->belongsToMany('App\Degree')
                        ->using('App\DegreeSchoolYear','degree_id')
                        ->withPivot([
                            'capacity',
                            'id',
                            'user_id'
                        ]);
    }



}
