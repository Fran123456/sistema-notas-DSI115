<?php

use Illuminate\Database\Seeder;
use App\AttendanceStudent;
use App\SchoolPeriod;
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
        /*
        periodo 1 01-03-20 -> 30-04-20
        periodo 2 01-05-20 -> 30-06-20
        periodo 1 01-07-20 -> 30-08-20
        */
        $periods=SchoolPeriod::where('school_year_id',1)->get();
        foreach($periods as $period){            
            $start = Carbon::createFromFormat('Y-m-d', $period->start_date);
            $end = Carbon::createFromFormat('Y-m-d', $period->end_date);

            $dates = [];

            while ($start->lte($end)) {
 
                $dates[] = $start->copy()->format('Y-m-d');
 
                $start->addDay();
            }   
            $studentHistory= StudentHistory::all();         
            foreach($dates as $date){
                foreach($studentHistory as $student){
                    $attendanceStudent= new AttendanceStudent();
                    $random=random_int(0,2);
                    $attendanceStudent->attendance_date=$date;
                    $attendanceStudent->student_history_id=$student->id;
                    $attendanceStudent->active=$random;
                    $attendanceStudent->period_id=$period->id;
                    $attendanceStudent->save();
                }
            }
        }
        /*
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
        }*/
    }
}
