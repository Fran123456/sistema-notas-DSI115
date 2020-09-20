<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttendanceStudent extends Model
{
    protected $table = 'attendance_students';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'student_history_id',
        'attendance_date',
        'active'
    ];

    public function studentHistory()
    {
        return $this->hasMany('App\StudentHistory');
    }
}
