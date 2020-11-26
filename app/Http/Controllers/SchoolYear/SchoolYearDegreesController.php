<?php

namespace App\Http\Controllers\SchoolYear;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SchoolYear;
use App\Degree;
use App\User;
use App\DegreeSchoolYear;
use App\DegreeSchoolSubject;
use App\Help\Help;
use App\SchoolPeriod;
use App\Subject;
use DB;

class SchoolYearDegreesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        auth()->user()->authorizeRoles(['Administrador','Secretaria']);
      $year = DegreeSchoolYear::find($id);

      $degree = Degree::find($year->degree_id);
      $schoolYear = SchoolYear::find($year->school_year_id);

      $subjects = Subject::all();
      $teachers = User::where('role_id', 2)->get();
      $subjectsGrade = Degree::find($degree->id)->subjects()
      ->where('school_year_id', $year->school_year_id)->get();




      //DegreeSchoolYear::destroy($id);
      return view('schoolYear.deleteGrade', compact('year','degree','schoolYear','subjects','teachers','subjectsGrade'));
    }
    public function delete(Request $request, $id)
    {
        auth()->user()->authorizeRoles(['Administrador','Secretaria']);
       $year_degree= DegreeSchoolYear::find($id);
       $degree = Degree::find($year_degree->degree_id);
       DegreeSchoolYear::destroy($year_degree->id);
       DegreeSchoolSubject::where('degree_id',$year_degree->degree_id)->delete();
       return redirect()->route('teacher-grade',$year_degree->school_year_id)->with('delete',' <strong> '.Help::ordinal($degree->degree). $degree->section.'-'.  Help::turn($degree->turn).' Eliminado Correctamente </strong>');
    }
    public function showStudentsDegreeYear($id)
    {
        auth()->user()->authorizeRoles(['Administrador','Secretaria']);
        $degree_school_year = DegreeSchoolYear::find($id);
        $degree = Degree::find($degree_school_year->degree_id);
        $schoolYear = SchoolYear::find($degree_school_year->school_year_id);
        $students = DB::table('students as stu')
        ->join('students_history as sh','stu.id','=','sh.student_id')
        ->select('sh.id','stu.name','stu.lastname','stu.gender','stu.age','stu.address','stu.phone','stu.parent_name','stu.status')
        ->where('sh.degree_id','=',$degree->id)
        ->where('sh.school_year_id','=',$schoolYear->id)
        ->get();
        $periodos= SchoolPeriod::all();
        return view('students.studentsDegreeYear',["students"=>$students,"schoolYear"=>$schoolYear,"degree"=>$degree,'periodos'=>$periodos ]);
    }

}
