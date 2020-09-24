<?php

namespace App\Http\Controllers\Score;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ScoreStudent;
use App\SchoolYear;
use App\Degree;
use App\Student;
use App\SchoolPeriod;
use App\DegreeSchoolSubject;
class ScoreController extends Controller
{
    public function  getScoresTypeByStudent(Request $request){
      //request => year , degree
      //showStudentsDegreeTeacher
      $year = SchoolYear::find($request->year);
      $degree = Degree::find($request->degree);
      $look = $request->look;
      $teacher = $request->teacher;
      $student = null;
      $degrees  = DegreeSchoolSubject::where('school_year_id',$year->id)
       ->where('degree_id', $degree->id)->get();

      $period = SchoolPeriod::where('nperiodo',$request->period)
      ->where('school_year_id', $request->year)->first();

      $types = array();
      if($look == 0){ //no hay busqueda de alumno
        $student = Student::find($request->student);
        $types = ScoreStudent::scoreByStudent($student->id, $period->id, $year->id, $degree->id);
        //return $types;
      }else{

      }
      
      return view('score.score.scoreStudent', 
        compact('types','look','student','degree','year','period','teacher','degrees'));
    }

    public function updateScores(Request $request){
      
    }

}
