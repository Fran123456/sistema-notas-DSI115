<?php

namespace App;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Model;

class DegreeShoolYear extends Pivot
{
    protected $table = 'degree_school_year';
    public $incrementing = true;
    protected $fillable = [
      'id','teacher_id','degree_id','school_year_id','capacity','active','created_at','updated_at'
    ];
}
