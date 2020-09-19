<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Student;
use App\Degree;
use App\SchoolYear;
use App\DegreeSchoolYear;
use App\StudentHistory;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $students = Student::orderBy('status')->get();
        return view('students.students',["students"=>$students]);
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
        $student = Student::where("id", $id)->first();
        $history = StudentHistory::where("student_id", $id)->first();
        $year    = SchoolYear::where("id", $history->school_year_id)->first(); 
        $degree = Degree::where("id", $history->degree_id)->first();


        return view('students.history', compact('student', 'year', 'degree'));
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
        $actually = SchoolYear::where('active', true)->first();
        $degrees = DegreeSchoolYear::where('school_year_id', $actually->id)->get();
        $student = Student::where("id", $id)->first();
        return view('students.edit', compact('student', 'degrees','actually'));
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
        Student::where('id', $id)
        ->update([

            'name'      =>$request->name,
            'lastname'  =>$request->lastname,
            'age'       =>$request->age,
            'gender'    =>$request->gender,
            'phone'     =>$request->phone,
            'parent_name' =>$request->parent_name,
            'parent_DUI'  =>$request->parent_DUI,
            'status'    =>$request->status,
            'address'   =>$request->address
        ]);

        return redirect()->route('students.index')->with('edit','<strong>El alumno/a '.$request->name.' fue actualizado correctamente</strong>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
