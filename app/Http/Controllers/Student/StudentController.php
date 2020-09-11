<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Student;
use App\Degree;
use App\SchoolYear;
use App\DegreeSchoolYear;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::orderBy('status')->get();
        return view('students.students',["students"=>$students]);
    }

    public function update(Request $request, $id)
    {
    	Student::where('id', $id)
    	->update([

    		'name' 		=>$request->name,
    		'lastname'  =>$request->lastname,
    		'age'		=>$request->age,
    		'gender'	=>$request->gender,
    		'phone'		=>$request->phone,
    		'parent_name' =>$request->parent_name,
    		'parent_DUI'  =>$request->parent_DUI,
    		'status'	=>$request->status,
    		'address'	=>$request->address
    	]);

    	return redirect()->route('students.index')->with('edit','<strong>El alumno/a '.$request->name.' fue actualizado correctamente</strong>');

    }

    public function edit($id){
    	$actually = SchoolYear::where('active', true)->first();
    	$degrees = DegreeSchoolYear::where('school_year_id', $actually->id)->get();
    	$student = Student::where("id", $id)->first();
    	return view('students.edit', compact('student', 'degrees','actually'));
    }
}
