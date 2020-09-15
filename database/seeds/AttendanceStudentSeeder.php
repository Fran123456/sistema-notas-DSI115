<?php

use Illuminate\Database\Seeder;
use App\AttendanceStudent;
use App\StudentHistory;

class AttendanceStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $studentHistory= StudentHistory::all();
        $dates= array();
        array_push($dates,'2020-09-13','2020-09-14','2020-09-15');
        foreach($dates as $date){
            foreach($studentHistory as $student){
            $attendanceStudent= new AttendanceStudent();
            //$attendanceStudent->attendance_date=date('y-m-d');
            $attendanceStudent->attendance_date=$date;
            $attendanceStudent->student_history_id=$student->id;
            $attendanceStudent->active=true;
            $attendanceStudent->save();
        }                
        }        
    }
}
