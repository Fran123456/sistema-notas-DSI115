<?php

namespace App\Http\Controllers\AttendanceStudent;

use App\AttendanceStudent;
use App\Degree;
use Illuminate\Support\Facades\DB;
use App\DegreeSchoolYear;
use App\Help\Help;
use App\Http\Controllers\Controller;
use App\SchoolYear;
use App\Student;
use App\StudentHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use League\CommonMark\Inline\Element\Strong;

class AttendanceStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function attendancesDates($degreeId){
        
        $activedYear=SchoolYear::where('active',1)->get()->first()->id;

        $attendanceDates= array();

        $query=DB::select("SELECT students_history.degree_id, attendance_students.attendance_date, count(attendance_students.attendance_date) as asistencia FROM attendance_students INNER JOIN students_history on attendance_students.student_history_id=students_history.id WHERE students_history.degree_id = ? AND students_history.school_year_id = ? AND attendance_students.active =1 GROUP BY  students_history.degree_id,attendance_students.attendance_date",[$degreeId,$activedYear]);
            foreach($query as $element){
                array_push($attendanceDates,$element);
            }

        $degree=Degree::where('id',$degreeId)->get()->first();
        //dd($degree);
        ($attendanceDates);
        $now = new \DateTime();
        $now= $now->format('Y-m-d');

        return view('attendanceStudents.attendances', compact('attendanceDates','degree','now'));
    }

    public function index()
    {
        /*
        $idUser=Auth::user()->id;

        $activedYear=SchoolYear::where('active',1)->get()->first()->id;

        $userAsignedDegree=DegreeSchoolYear::where('user_id',$idUser)->where('school_year_id',$activedYear)->get();

        $attendanceDates= array();
        foreach($userAsignedDegree as $degree){

            $query=DB::select("SELECT students_history.degree_id, attendance_students.attendance_date, count(attendance_students.attendance_date) as asistencia FROM attendance_students INNER JOIN students_history on attendance_students.student_history_id=students_history.id WHERE students_history.degree_id = ? AND students_history.school_year_id = ? AND attendance_students.active =1 GROUP BY  students_history.degree_id,attendance_students.attendance_date",[$degree->id,$activedYear]);
            foreach($query as $element){
                array_push($attendanceDates,$element);
            }
        }

        ($attendanceDates);
        $now = new \DateTime();
        $now= $now->format('Y-m-d');

        return view('attendanceStudents.attendances', compact('attendanceDates','userAsignedDegree','now'));*/
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
    public function show(Request $request)
    {     
        
        //dd($request);
        //dd($request->request);
        $attendance = DB::select("SELECT * FROM attendance_students INNER JOIN (students_history INNER JOIN students ON students_history.student_id = students.id) ON attendance_students.student_history_id = students_history.id WHERE students_history.degree_id= ? AND attendance_students.attendance_date = ?", [$request->degreeId, $request->attendanceDate]);
        //$attendance=DB::select("SELECT * FROM attendance_students INNER JOIN (students_history INNER JOIN students ON students_history.student_id = students.id) ON attendance_students.student_history_id = students_history.id WHERE students_history.degree_id= ? AND attendance_students.attendance_date = ?", );        
        //dd($attendance);
        
        $degree=Degree::where('id',$request->degreeId)->get()->first();        
        $date=$request->attendanceDate;        
        
        return view('attendanceStudents.attendance', compact('attendance','degree','date'));
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
        //
    }

    public function record($idDegreeSchoolYear)
    {
        $degSchoolYear= DegreeSchoolYear::find($idDegreeSchoolYear);
        $degree= Degree::find($degSchoolYear->degree_id);
        $students= StudentHistory::where('degree_id',$degree->id)->get();
        $std= Student::all();

        $now = new \DateTime();
        $now= $now->format('Y-m-d');
       return view('attendanceStudents.dailyRecord', compact('degSchoolYear','degree','students','now','std'));
    }

    public function saveRecord(Request $request)
    {

        $data= $request->all();

        $stdh= StudentHistory::find($data['studenthistory'][0]);
        $grado= Degree::find($stdh->degree_id);
        $mensaje= Help::ordinal($grado->degree). $grado->section .'-'. Help::turn($grado->turn);
        $now = new \DateTime();
        $now= $now->format('Y-m-d');
       // dd($mensaje);
      //  dd($data['studenthistory'][24]);

        for ($i=0; $i <count($data['date']) ; $i++) {
            AttendanceStudent::create([
                'attendance_date' => $data['date'][$i],
                'student_history_id' =>$data['studenthistory'][$i],
                'active' => '1',
            ]) ;
        }


      
      return redirect()->route('attendancesDates',$grado->id)->with('edit','<strong>'.count($data['date']).'  </strong> Asistencias Guardadas del
      Grado:   <strong>  '.$mensaje.'</strong>  fecha: <strong> '.$now.'</strong> ');
    // return back()->with('edit','Registro Guardado');
    }
}