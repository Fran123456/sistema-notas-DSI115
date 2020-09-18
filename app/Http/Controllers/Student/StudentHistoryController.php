<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\StudentHistory;
use App\Degree;
use App\SchoolYear;
use App\Student;

class StudentHistoryController extends Controller
{
    public function destroy(Request $request,$id){
        $studentHistory=StudentHistory::find($id);
        $degree=Degree::find($studentHistory->degree_id);
        $schoolYear=SchoolYear::find($studentHistory->school_year_id);
        $student=Student::find($studentHistory->student_id);
        StudentHistory::destroy($id);
        return back()->with('success', 'El alumno ' .$student->name. ' '.$student->lastname. ' ha sido removido del grado '.$degree->degree.' '.$degree->section.' - '.$schoolYear->year);
    }
}
