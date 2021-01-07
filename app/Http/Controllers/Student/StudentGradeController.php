<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Student;
use App\Degree;
use App\SchoolYear;
use App\DegreeSchoolYear;
use App\StudentHistory;
use App\ScoreType;
use App\ScoreStudent;
use Illuminate\Support\Facades\DB;

class StudentGradeController extends Controller
{
   public function addStudent(){
      auth()->user()->authorizeRoles(['Administrador','Secretaria']);
      $actually = SchoolYear::where('active', true)->first();
      //$degrees = DegreeSchoolYear::where('school_year_id', $actually->id)->get();
      $degrees=DB::table('degree_school_year')
                    ->join('degrees','degrees.id','=','degree_school_year.degree_id')
                    ->where('degree_school_year.school_year_id','=',$actually->id)
                    ->get();
      return view('students.studentCreate',compact('degrees','actually'));
   }

   public function registerStudent(Request $request){
    auth()->user()->authorizeRoles(['Administrador','Secretaria']);


    $ds = DegreeSchoolYear::where('school_year_id', $request->school_year_id)
     ->where('degree_id',$request->degree_id)->first();
    
     if($ds->full == $ds->capacity){

      return back()->with('delete','Error , no hay capacidad para el grado que ha seleccionado, habilitar mas cupos para poder matricular el alumno.');
     }

     $student = Student::create($request->all());
     $history = StudentHistory::create([
       'student_id' => $student->id,
       'degree_id' => $request->degree_id,
       'school_year_id'=>$request->school_year_id,
       'status' => true
     ]);



     DegreeSchoolYear::where('school_year_id', $request->school_year_id)
     ->where('degree_id',$request->degree_id)->update([
       'full' =>  $ds->full+1
     ]);

     $scores = ScoreType::where('degree_id',$request->degree_id)->where('school_year_id',$request->school_year_id)->
     where('send', true)->get();
     foreach ($scores as $key => $score) {
       ScoreStudent::create([
        'score_type_id'=>$score->id,
        'student_id'=>$student->id,
        'school_period_id'=> $score->school_period_id,
        'school_year_id'=>$score->school_year_id,
        'degree_id'=>$score->degree_id,
        'subject_id'=>$score->subject_id,
       ]);
     }




     return back()->with('success','El alumno: ' . $student->name . ' ' . $student->lastname . ' ha sido registrado correctamente');
   }
}
