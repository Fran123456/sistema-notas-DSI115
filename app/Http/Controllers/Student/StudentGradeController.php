<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Student;
use App\Degree;
use App\SchoolYear;
use App\DegreeSchoolYear;


class StudentGradeController extends Controller
{
   public function addStudent(){
      $actually = SchoolYear::where('active', true)->first();
      $degrees = DegreeSchoolYear::where('school_year_id', $actually->id)->get();


     return view('students.studentCreate',compact('degrees','actually'));
   }
}
