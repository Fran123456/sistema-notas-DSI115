<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class ScoreType extends Model
{
    protected $table = 'score_type';
    public $timestamps = false;
    protected $fillable = [
        'id','school_period_id','school_year_id','degree_id','subject_id','percentage','activity',
        'description','date','state','type'
    ];

    public static function scoreTypeByDegree($periodx,$yearx, $gradex, $subjectx)
    {
      $query=DB::SELECT("SELECT * FROM score_type WHERE (school_period_id = ?
      AND school_year_id = ? AND degree_id = ? AND subject_id = ?)",
      [$periodx,$yearx,$gradex,$subjectx]);
      return $query;
    }
}
