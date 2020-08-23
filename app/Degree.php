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
        return $this->belongsToMany('App\ShoolYear')
                    ->using('App\DegreeSchoolYear')
                    ->withPivot([
                            'created_by',
                            'updated_by',
                    ]);
    }


    public function teachers()
    {
        return $this->belongsToMany('App\Usew')
                    ->using('App\DegreeSchoolYear')
                    ->withPivot([
                            'created_by',
                            'updated_by',
                    ]);
   }


}
