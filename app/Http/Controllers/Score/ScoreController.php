<?php

namespace App\Http\Controllers\Score;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ScoreStudent;
use App\SchoolYear;
use App\Degree;
use App\Student;
class ScoreController extends Controller
{
    public function  getScoresTypeByStudent(Request $request){
      //request => year , degree
      $year = SchoolYear::find($request->year);
      $degree = SchoolYear::find($request->degree);
      $look = $request->look;
      $types = array();
      if($look == 0){ //no hay busqueda de alumno
        $student = Student::find($request->student);
      }else{

      }
      return view('score.score.scoreStudent', compact('types','look','student'));
    }

}
