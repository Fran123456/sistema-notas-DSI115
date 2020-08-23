<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolYear extends Model
{
    protected $table = 'school_years';
  	protected $fillable = [
  	  'id','start_date','end_date','year','active','created_at','updated_at'
  	];

    public function degrees()
    {
        return $this->belongsToMany('App\Degree')
                        ->using('App\DegreeSchoolYear')
                        ->withPivot([
                            'created_by',
                            'updated_by',
                        ]);
    }

}
