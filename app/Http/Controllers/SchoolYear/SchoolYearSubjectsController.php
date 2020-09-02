<?php

namespace App\Http\Controllers\SchoolYear;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SchoolYear;
use App\Degree;
use App\User;
use App\DegreeSchoolYear;
use App\DegreeSchoolSubject;
use App\Subject;
use Illuminate\Database\Eloquent\Builder;

class SchoolYearSubjectsController extends Controller
{
   /*MUESTRA EL FORMULARIO PARA AGREGAR UNA MATERIA A UN GRADO*/
    public function storeSubjects($id){
      $year = DegreeSchoolYear::find($id);
      $degree = Degree::find($year->degree_id);
      $schoolYear = SchoolYear::find($year->school_year_id);

      $subjects = Subject::all();
      $teachers = User::where('role_id', 2)->get();

      $subjectsGrade = Degree::find($degree->id)->subjects;
     //return $subjectsGrade[0]->pivot->id;
      /*$subjects = Subject::whereDoesntHave('degrees', function(Builder $query) use($schoolYear){
        $query->whereNotIn('school_year_id', [$schoolYear->id]);
      })->get();*/

      return view('schoolYear.schoolYearSubjectsCreate', compact('year','degree','schoolYear','subjects','teachers','subjectsGrade'));
    }/*MUESTRA EL FORMULARIO PARA AGREGAR UNA MATERIA A UN GRADO*/

    /*AGREGA UNA MATERIA A UN AÑO Y AUN GRADO ESCOLAR*/
    public function saveSubjectsDegree(Request $request){
       $year =DegreeSchoolSubject::create($request->all());
       return back()->with('success', 'La materia ha sido agregada correctamente');
    }/*AGREGA UNA MATERIA A UN AÑO Y AUN GRADO ESCOLAR*/


    public function deleteSubjectsDegree($id){
      DegreeSchoolSubject::destroy($id);
      return back()->with('delete', 'Materia eliminada correctamente');
    }
}
