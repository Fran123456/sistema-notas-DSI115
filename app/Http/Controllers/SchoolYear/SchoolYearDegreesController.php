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
      
      $year = DegreeSchoolYear::find($id);

      $degree = Degree::find($year->degree_id);
      $schoolYear = SchoolYear::find($year->school_year_id);

      $subjects = Subject::all();
      $teachers = User::where('role_id', 2)->get();
      $subjectsGrade = Degree::find($degree->id)->subjects;
      //DegreeSchoolYear::destroy($id);
      return view('schoolYear.deleteGrade', compact('year','degree','schoolYear','subjects','teachers','subjectsGrade'));
    }
}
