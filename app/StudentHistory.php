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
  public function students(){
    return $this->belongsTo(Student::class);
  }

  public function degree(){
    return $this->belongsTo('App\Degree');
  }

  public function year(){
    return $this->belongsTo('App\SchoolYear', 'school_year_id');
  }

  public function degreesy(){
    return $this->belongsTo('App\DegreeSchoolYear', 'degree_id', 'degree_id');
  }

  public function attendancebyperiod(){
    return $this->belongsTo('App\AttendanceStudent', 'id', 'student_history_id');
  }

}
