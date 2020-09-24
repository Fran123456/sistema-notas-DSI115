<?php

namespace App;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Model;

class DegreeSchoolYear extends Pivot
{
    protected $table = 'degree_school_year';
    public $timestamps = false;
    protected $fillable = [
      'id','user_id','degree_id','school_year_id','capacity','active','full','created_at','updated_at'
    ];

    public function degree(){
      return $this->hasOne('App\Degree','id');
    }

	public function teacher(){
	return $this->belongsTo('App\User', 'user_id');
	}



}
