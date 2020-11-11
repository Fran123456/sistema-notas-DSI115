<?php

use App\BehaviorIndicator;
use App\BehaviorIndicatorsStudent;
use App\Degree;
use App\SchoolPeriod;
use App\SchoolYear;
use App\StudentHistory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BehaviorStudentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        
        $behaviorIndicatorOne = new BehaviorIndicator();
        $behaviorIndicatorOne->name = 'Excelente';
        $behaviorIndicatorOne->code = 'E';
        $behaviorIndicatorOne->description = 'Excelente';
        $behaviorIndicatorOne->save();

        $behaviorIndicatorDos = new BehaviorIndicator();
        $behaviorIndicatorDos->name = 'Muy Bueno';
        $behaviorIndicatorDos->code = 'MB';
        $behaviorIndicatorDos->description = 'Muy Bueno';
        $behaviorIndicatorDos->save();

        $behaviorIndicatorTres = new BehaviorIndicator();
        $behaviorIndicatorTres->name = 'Bueno';
        $behaviorIndicatorTres->code = 'B';
        $behaviorIndicatorTres->description = 'Bueno';
        $behaviorIndicatorTres->save();

        $behaviorIndicatorCuatro = new BehaviorIndicator();
        $behaviorIndicatorCuatro->name = 'Necesita Mejorar';
        $behaviorIndicatorCuatro->code = 'NM';
        $behaviorIndicatorCuatro->description = 'Necesita Mejorar';
        $behaviorIndicatorCuatro->save();

        $behaviorIndicators= DB::select("SELECT id FROM behavior_indicators");        

        $years= SchoolYear::all();        
        foreach ($years as $year){
            $schoolPeriods = DB::select("SELECT * FROM school_period WHERE school_year_id = ?",[$year->id]);
            $studentsHistory = DB::select("SELECT * FROM students_history WHERE school_year_id = ?",[$year->id]);
            foreach($schoolPeriods as $period){                
                foreach($studentsHistory as $student ){
                    $behaviorStudent= new BehaviorIndicatorsStudent();
                    $behaviorStudent->behavior_indicator_id = array_rand($behaviorIndicators)+1;
                    $behaviorStudent->student_id = $student->student_id;
                    $behaviorStudent->school_period_id= $period->id;
                    $behaviorStudent->school_year_id=$year->id;
                    $behaviorStudent->degree_id=$student->degree_id;
                    $behaviorStudent->save();
                }                
            }        
        }
    }
}