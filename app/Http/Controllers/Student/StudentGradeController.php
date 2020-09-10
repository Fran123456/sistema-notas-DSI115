<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Student;

class StudentGradeController extends Controller
{
   public function addStudent(){
     return view('students.studentCreate');
   }
}
