<?php

use Illuminate\Database\Seeder;
use App\AttendanceStudent;
use App\StudentHistory;
use Carbon\Carbon;

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
            $randomDate = Carbon::today()->subDays(rand(0, 365));
            $attendanceStudent->attendance_date=$randomDate;
            $attendanceStudent->student_history_id=$student->id;
            $random=random_int(0,2); $random2=random_int(1,3);
            $attendanceStudent->active=$random;
            $attendanceStudent->period_id=$random2;
            //$attendanceStudent->period_id=1;
            $attendanceStudent->save();
        }
        }
    }
}
