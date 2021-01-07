<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\StudentHistory;
use App\Degree;
use App\DegreeSchoolYear;
use App\SchoolYear;
use App\Student;

class StudentHistoryController extends Controller
{
    public function destroy(Request $request,$id){
        auth()->user()->authorizeRoles(['Administrador','Secretaria']);
        $studentHistory=StudentHistory::find($id);
        $degree=Degree::find($studentHistory->degree_id);
        $schoolYear=SchoolYear::find($studentHistory->school_year_id);
        $student=Student::find($studentHistory->student_id);
        StudentHistory::destroy($id);

        /*Eliminaremos su cupo del salón*/
        //Consultamos el degreeSchoolYear para tener el valor de full
        $degreeSchoolYear= DegreeSchoolYear::where('degree_id',$studentHistory->degree_id)
                        ->where('school_year_id',$studentHistory->school_year_id)
                        ->get()->first();        
        //Actualizamos el valor de full
        DegreeSchoolYear::where('degree_id',$studentHistory->degree_id)
                        ->where('school_year_id',$studentHistory->school_year_id)
                        ->update([
                            "full" => ($degreeSchoolYear->full - 1)
                        ]);    
        return back()->with('success', 'El alumno ' .$student->name. ' '.$student->lastname. ' ha sido removido del grado '.$degree->degree.' '.$degree->section.' - '.$schoolYear->year);
    }
}
