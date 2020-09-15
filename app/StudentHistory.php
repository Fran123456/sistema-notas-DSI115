<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentHistory extends Model
{
  protected $table = 'students_history';
  protected $fillable = [
      'id',
      'student_id',
      'degree_id',
      'school_year_id',
      'status',
      'upgrade'
  ];

  public function attendance(){
    return $this->belongsTo('App\AttendanceStudent');
  }
}
