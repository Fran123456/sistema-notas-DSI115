<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\DegreeSchoolSubject;
use App\Help\Help;
use App\Degree;
use App\DegreeSchoolYear;

class TeacherController extends Controller
{
    public function grades($id){//id del teacher
		$data =  User::teacher();
		//dd($data);
    	//return $data;
    	return view('score.teacher.teacherMenu',compact('data'));
    }

   /*tipos de evaluacion que va tener una materia*/
    public function types($grade, $teacher){
       $grades  = DegreeSchoolSubject::where('school_year_id',Help::getSchoolYear()->id)
       ->where('degree_id', $grade)->get();
       $grade = Degree::find($grade);
       $te = User::find($teacher);
       return view('score.type.subjects',compact('grades','te','grade'));
    }
    /*tipos de evaluacion que va tener una materia*/

    public function scorePercentage($grade,$teacher){
    	$grade = Degree::find($grade);
        $teacher = User::find($teacher);
    	return view('score.type.scoreTypesCreate', compact('grade','teacher'));
    }
}
