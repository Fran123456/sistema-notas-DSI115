<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Student;
use App\Degree;
use App\SchoolYear;
use App\DegreeSchoolYear;
use App\StudentHistory;

class StudentGradeController extends Controller
{
   public function addStudent(){
      $actually = SchoolYear::where('active', true)->first();
      $degrees = DegreeSchoolYear::where('school_year_id', $actually->id)->get();
      return view('students.studentCreate',compact('degrees','actually'));
   }

   public function registerStudent(Request $request){
     $student = Student::create($request->all());
     $history = StudentHistory::create([
       'student_id' => $student->id,
       'degree_id' => $request->degree_id,
       'school_year_id'=>$request->school_year_id,
       'status' => true
     ]);

     $ds = DegreeSchoolYear::where('school_year_id', $request->school_year_id)
     ->where('degree_id',$request->degree_id)->first();

     DegreeSchoolYear::where('school_year_id', $request->school_year_id)
     ->where('degree_id',$request->degree_id)->update([
       'full' =>  $ds->full+1
     ]);

     return back()->with('success','El alumno: ' . $student->name . ' ' . $student->lastname . ' ha sido registrado correctamente');
   }
}
