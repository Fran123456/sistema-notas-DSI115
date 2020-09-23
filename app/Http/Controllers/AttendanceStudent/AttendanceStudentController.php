<?php

namespace App\Http\Controllers\AttendanceStudent;

use App\AttendanceStudent;
use App\Degree;
use Illuminate\Support\Facades\DB;
use App\DegreeSchoolYear;
use App\Help\Help;
use App\Http\Controllers\Controller;
use App\SchoolPeriod;
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
        $periodos= SchoolPeriod::where('school_year_id',$activedYear)->get();
        $periodoActual= SchoolPeriod::where('school_year_id',$activedYear)->where('current',1)->first();
        $periodoFiltrado=$periodoActual;
        
        $attendanceDates=DB::select("SELECT students_history.degree_id, attendance_students.attendance_date,
        sum(CASE WHEN attendance_students.active = 1 THEN 1 ELSE 0 END) as asistencias,
        sum(CASE WHEN attendance_students.active = 0 THEN 1 ELSE 0 END) as faltas,
        sum(CASE WHEN attendance_students.active = 2 THEN 1 ELSE 0 END) as permisos
        FROM attendance_students INNER JOIN students_history ON attendance_students.student_history_id=students_history.id WHERE students_history.degree_id = ? AND students_history.school_year_id = ?  AND attendance_students.period_id=? GROUP BY  students_history.degree_id,attendance_students.attendance_date",[$degreeId,$activedYear,$periodoActual->nperiodo]);

        $degree=Degree::where('id',$degreeId)->get()->first();
        //dd($degree);
        ($attendanceDates);
        $now = new \DateTime();
        $now= $now->format('Y-m-d');
        //filtrado
         $total=StudentHistory::where('degree_id',$degreeId)
         ->where('school_year_id',$activedYear)->get();
         $total=count($total);
         $control=0;

       return view('attendanceStudents.attendances', compact('attendanceDates','degree','now','total','periodos','periodoActual','periodoFiltrado','control'));
    }

    public function index()
    {

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

    }

    public function showAttendance($degreeId, $attendanceDate){
        $activeYear= SchoolYear::where('active',1)->first();
        $attendance=DB::select("SELECT * FROM attendance_students INNER JOIN
         (students_history INNER JOIN students ON students_history.student_id = students.id) ON
         attendance_students.student_history_id = students_history.id WHERE students_history.degree_id= ?
         AND attendance_students.attendance_date = ? AND students_history.school_year_id= ?", [$degreeId, $attendanceDate,$activeYear->id]);
        $degree=Degree::where('id',$degreeId)->get()->first();
        return view('attendanceStudents.attendance', compact('attendance','degree','attendanceDate'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    public function editAttendance($degreeId, $attendanceDate){
        $activeYear= SchoolYear::where('active',1)->first();
        $attendance=DB::select("SELECT * FROM attendance_students INNER JOIN
         (students_history INNER JOIN students ON students_history.student_id = students.id) ON
         attendance_students.student_history_id = students_history.id WHERE students_history.degree_id= ?
         AND attendance_students.attendance_date = ? AND students_history.school_year_id= ?", [$degreeId, $attendanceDate,$activeYear->id]);
        $degree=Degree::where('id',$degreeId)->get()->first();        
        return view('attendanceStudents.attendanceEdit', compact('attendance','degree','attendanceDate','activeYear'));
    }
    
    public function updateAttendanceRecord(Request $request){

        //dd($request);                
        $arrayStudentHistory= array();
        foreach($request->student_id as $key => $student){
            //$studentHistoryId= DB::select("SELECT id FROM students_history WHERE degree_id = ? AND school_year_id = ? AND student_id = ?", [$request->degree,$request->activeYear,$student]);            
            $studentHistoryId=StudentHistory::where('degree_id',$request->degree)
            ->where('school_year_id',$request->activeYear)
            ->where('student_id',$student)
            ->get()->first();
            
            AttendanceStudent::where('id', $studentHistoryId->id)->where('attendance_date',$request->date)
            ->update([
                'active' => $request->asistencia[$key],
              ]);
                        
            array_push($arrayStudentHistory,$studentHistoryId);            
        }

        return back()->with('success','éxito en update');
                
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {        
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
        $activedYear=SchoolYear::where('active',1)->get()->first()->id;
        $periodoActual= SchoolPeriod::where('school_year_id',$activedYear)->where('current',1)->first();
        $degSchoolYear= DegreeSchoolYear::find($idDegreeSchoolYear);
        $degree= Degree::find($degSchoolYear->degree_id);
        $students= StudentHistory::where('degree_id',$degree->id)->get();
        $std= Student::all();

        $now = new \DateTime();
        $now= $now->format('Y-m-d');
       return view('attendanceStudents.dailyRecord', compact('degSchoolYear','degree','students','now','std','periodoActual'));
    }

    public function saveRecord(Request $request)
    {
        $activedYear=SchoolYear::where('active',1)->get()->first()->id;
        $periodoActual= SchoolPeriod::where('school_year_id',$activedYear)->where('current',1)->first();

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
                'period_id' => $periodoActual->id,
                'student_history_id' =>$data['studenthistory'][$i],
                'active' => $data['asistencia'][$i],
            ]) ;
        }



      return redirect()->route('attendancesDates',$grado->id)->with('edit','<strong>'.count($data['date']).'  </strong> Asistencias Guardadas del
      Grado:   <strong>  '.$mensaje.'</strong>  fecha: <strong> '.$now.'</strong> ');
    // return back()->with('edit','Registro Guardado');
    }
    public function filter(Request $request,$control)
    {        
        $activedYear=SchoolYear::where('active',1)->get()->first()->id;
        $periodos= SchoolPeriod::where('school_year_id',$activedYear)->get();
        $periodoActual= SchoolPeriod::where('school_year_id',$activedYear)->where('current',1)->first();
        $periodoFiltrado= SchoolPeriod::find($request->periodo_id);

        $attendanceDates=DB::select("SELECT students_history.degree_id, attendance_students.attendance_date,
        sum(CASE WHEN attendance_students.active = 1 THEN 1 ELSE 0 END) as asistencias,
        sum(CASE WHEN attendance_students.active = 0 THEN 1 ELSE 0 END) as faltas,
        sum(CASE WHEN attendance_students.active = 2 THEN 1 ELSE 0 END) as permisos
        FROM attendance_students INNER JOIN students_history ON attendance_students.student_history_id=students_history.id WHERE students_history.degree_id = ? AND students_history.school_year_id = ?  AND attendance_students.period_id=? GROUP BY  students_history.degree_id,attendance_students.attendance_date",[$request->degree,$activedYear,$periodoFiltrado->id]);            

        $degree=Degree::where('id',$request->degree)->get()->first();
        //dd($degree);        
        $now = new \DateTime();
        $now= $now->format('Y-m-d');
        //filtrado
         $total=StudentHistory::where('degree_id',$request->degree)
         ->where('school_year_id',$activedYear)->get();
         $total=count($total);
         $control=0;
         if ($periodoActual->id != $periodoFiltrado->id ) {
            $control=1;
         }


       return view('attendanceStudents.attendances', compact('attendanceDates','degree','now','total','periodos','periodoActual','periodoFiltrado','control'));

    }
}
