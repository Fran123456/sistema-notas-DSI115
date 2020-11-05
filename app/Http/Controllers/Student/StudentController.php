<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Student;
use App\Degree;
use App\SchoolYear;
use App\DegreeSchoolYear;
use App\StudentHistory;
use App\User;
use App\SchoolPeriod;
use App\BehaviorIndicatorsStudent;
use App\Help\Help;
use App\ScoreStudent;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {    
        auth()->user()->authorizeRoles(['Administrador','Secretaria']);
        $schoolYear=Help::getSchoolYear();//objeto
        //$students = Student::orderBy('status')->get();        
        $students=DB::select("SELECT students.id as clave, students_history.degree_id as grado, students.name, students_history.school_year_id as school_year,students.*, degrees.degree,degrees.section,degrees.turn, CASE WHEN EXISTS( SELECT grado FROM ((students INNER JOIN students_history ON students.id = students_history.student_id) INNER JOIN degrees ON degrees.id = students_history.degree_id) WHERE school_year = ?) THEN CONCAT(degrees.degree, ' ', degrees.section, ' ', degrees.turn) ELSE 'NO TIENE GRADO' END AS result FROM ((students INNER JOIN students_history ON students.id = students_history.student_id) INNER JOIN degrees ON degrees.id = students_history.degree_id) ORDER BY students.lastname",[$schoolYear->id]);
        foreach($students as $keyOne => $student){
            if($student->school_year != $schoolYear->id){                
                foreach($students as $keyTwo => $comparison){
                    if($student->school_year != $comparison->school_year && $student->id == $comparison->id){                        
                        unset($students[$keyOne]);
                    }
                }                                                                                            
            }                        
           else{               
                $str=chunk_split($student->result,1,'');                
                if($str[4]=='m'){
                    $student->result=Help::ordinal($str[0]).' '.$str[2].' Matutino';
                }
                else{
                    $student->result=Help::ordinal($str[0]).' '.$str[2].' Verspertino';
                }
            }
        }
        $new=array_merge($students);//Para restablecer el # de keys del array
        return view('students.students',["students"=>$new]);
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
        auth()->user()->authorizeRoles(['Administrador','Secretaria']);
        $student = Student::where("id", $id)->first();
        $studentrecord = StudentHistory::where("student_id", $id)->get();        
        $currentyear = SchoolYear::where('active', true)->first();
        $periods = SchoolPeriod::all();
        $behavior = BehaviorIndicatorsStudent::where("student_id", $id)->get();
        $scores = ScoreStudent::where("student_id", $id)->get();
        return view('students.history', compact('student', 'studentrecord', 'currentyear', 'periods', 'behavior', 'scores'));
    }

    public function beforedeleting($id)
    {
        //
        auth()->user()->authorizeRoles(['Administrador','Secretaria']);
        $student = Student::where("id", $id)->first();
        $studentrecord = StudentHistory::where("student_id", $id)->get();        
        $currentyear = SchoolYear::where('active', true)->first();
        return view('students.delete', compact('student', 'studentrecord', 'currentyear'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        auth()->user()->authorizeRoles(['Administrador','Secretaria']);
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
        auth()->user()->authorizeRoles(['Administrador','Secretaria']);
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
        auth()->user()->authorizeRoles(['Administrador','Secretaria']);

        $history = StudentHistory::where("student_id", $id)->first();   

        StudentHistory::destroy($history->id);     
        Student::destroy($id); 

          
        return redirect()->route('students.index')->with('delete','<strong>El alumno/a fue eliminado correctamente</strong>');
    }
}

