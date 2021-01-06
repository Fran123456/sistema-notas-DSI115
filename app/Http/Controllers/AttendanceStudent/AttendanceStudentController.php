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

        auth()->user()->authorizeRoles(['Docente']);

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
        auth()->user()->authorizeRoles(['Docente']);
        $activeYear= SchoolYear::where('active',1)->first();
        $attendance=DB::select("SELECT * FROM attendance_students INNER JOIN
         (students_history INNER JOIN students ON students_history.student_id = students.id) ON
         attendance_students.student_history_id = students_history.id WHERE students_history.degree_id= ?
         AND attendance_students.attendance_date = ? AND students_history.school_year_id= ? ORDER BY students.lastname", [$degreeId, $attendanceDate,$activeYear->id]);
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
        auth()->user()->authorizeRoles(['Docente']);
        $activeYear= SchoolYear::where('active',1)->first();
        $attendance=DB::select("SELECT * FROM attendance_students INNER JOIN
         (students_history INNER JOIN students ON students_history.student_id = students.id) ON
         attendance_students.student_history_id = students_history.id WHERE students_history.degree_id= ?
         AND attendance_students.attendance_date = ? AND students_history.school_year_id= ? ORDER BY students.lastname", [$degreeId, $attendanceDate,$activeYear->id]);
        $degree=Degree::where('id',$degreeId)->get()->first();
        return view('attendanceStudents.attendanceEdit', compact('attendance','degree','attendanceDate','activeYear'));
    }

    public function updateAttendanceRecord(Request $request){

        auth()->user()->authorizeRoles(['Docente']);

        $newArray=array_combine($request->student_id,$request->asistencia);

        foreach($newArray as $key => $student){
            $studentHistoryId=StudentHistory::where('degree_id',$request->degree)
            ->where('school_year_id',$request->activeYear)
            ->where('student_id',$key)
            ->get()->first();

            AttendanceStudent::where('student_history_id', $studentHistoryId->id)->where('attendance_date',$request->date)
            ->update([
                'active' => $student,
              ]);
        }
        return redirect()->route('attendancesDates',$request->degree)->with('edit','<strong> Los cambios fueron guardados con éxito </strong>');

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


        auth()->user()->authorizeRoles(['Docente']);
        $activedYear=SchoolYear::where('active',1)->get()->first()->id;
        $periodoActual= SchoolPeriod::where('school_year_id',$activedYear)->where('current',1)->first();
        $degSchoolYear= DegreeSchoolYear::find($idDegreeSchoolYear);
        $degree= Degree::find($degSchoolYear->degree_id);
        /*$students= StudentHistory::where('degree_id',$degree->id)
        ->where('school_year_id',$activedYear)
        ->get();*/

        $students=DB::table('students_history')
                        ->join('students','students_history.student_id','=','students.id')
                        ->where('students_history.degree_id',$degree->id)
                        ->where('students_history.school_year_id',$activedYear)
                        ->select('*')
                        ->orderBy('students.lastname')
                        ->get();

        $std= Student::all();

        $now = new \DateTime();
        $now= $now->format('Y-m-d');
       return view('attendanceStudents.dailyRecord', compact('degSchoolYear','degree','students','now','std','periodoActual'));
    }

    public function saveRecord(Request $request)
    {
        auth()->user()->authorizeRoles(['Docente']);
        $activedYear=SchoolYear::where('active',1)->get()->first()->id;
        $periodoActual= SchoolPeriod::where('school_year_id',$activedYear)->where('current',1)->first();


        $data= $request->all();

        $fechaValidacion= AttendanceStudent::where('attendance_date','=',$request->date)
                                            ->where('period_id','=',$periodoActual->id)
                                            ->where('student_history_id','=',$data['studenthistory'][0])
                                            ->count('student_history_id');
        if($fechaValidacion>0){
            return back()->with('edit','<strong> Ya existe una asistencia registrada con la fecha '.Help::dateFormatter($request->date).' </strong>');
        }
        else{
            $stdh= StudentHistory::find($data['studenthistory'][0]);
            $grado= Degree::find($stdh->degree_id);
            $mensaje= Help::ordinal($grado->degree). $grado->section .'-'. Help::turn($grado->turn);
            $now = new \DateTime();
            $now= $now->format('Y-m-d');
        // dd($mensaje);
        //  dd($data['studenthistory'][24]);

            for ($i=0; $i <count($data['student_id']) ; $i++) {
                AttendanceStudent::create([
                    'attendance_date' => $request->date,
                    'period_id' => $periodoActual->id,
                    'student_history_id' =>$data['studenthistory'][$i],
                    'active' => $data['asistencia'][$i],
                ]) ;
            }

            return redirect()->route('attendancesDates',$grado->id)->with('edit','<strong>'.count($data['student_id']).'  </strong> Asistencias Guardadas del
            Grado:   <strong>  '.$mensaje.'</strong>  fecha: <strong> '.$request->date.'</strong> ');
        }

    }

    public function filter(Request $request,$control)
    {
        auth()->user()->authorizeRoles(['Docente']);
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

    //RESUMEN de las asistencias
    public function attendanceOverview($idYear,$idPeriod){

        auth()->user()->authorizeRoles(['Administrador','Secretaria']);

        $period=SchoolPeriod::find($idPeriod);
        $year=SchoolYear::find($period->school_year_id);

        $attendances = DB::select("
            SELECT sum(CASE WHEN attendance_students.active = 1 THEN 1 ELSE 0 END) as asistencias,
            sum(CASE WHEN attendance_students.active = 1 THEN 1 ELSE 0 END)/(SELECT count(*) FROM attendance_students WHERE attendance_students.period_id= ?)as porAsistencias,
            sum(CASE WHEN attendance_students.active = 0 THEN 1 ELSE 0 END) as faltas,
            sum(CASE WHEN attendance_students.active = 0 THEN 1 ELSE 0 END)/(SELECT count(*) FROM attendance_students WHERE attendance_students.period_id= ?)as porFaltas,
            sum(CASE WHEN attendance_students.active = 2 THEN 1 ELSE 0 END) as permisos,
            sum(CASE WHEN attendance_students.active = 2 THEN 1 ELSE 0 END)/(SELECT count(*) FROM attendance_students WHERE attendance_students.period_id= ?)as porPermisos
            FROM attendance_students INNER JOIN students_history ON attendance_students.student_history_id=students_history.id WHERE attendance_students.period_id= ?",[$period->id,$period->id,$period->id,$period->id]);

            $degrees= DB::select("
            SELECT students_history.degree_id as grado,degrees.degree, degrees.section, degrees.turn,
            sum(CASE WHEN attendance_students.active = 1 THEN 1 ELSE 0 END) as asistencias,
            sum(CASE WHEN attendance_students.active = 1 THEN 1 ELSE 0 END)/(select count(*) FROM attendance_students INNER JOIN students_history ON attendance_students.student_history_id=students_history.id WHERE attendance_students.period_id= ? AND students_history.degree_id = grado) as porAsistencias,
            sum(CASE WHEN attendance_students.active = 0 THEN 1 ELSE 0 END) as faltas,
            sum(CASE WHEN attendance_students.active = 0 THEN 1 ELSE 0 END)/(select count(*) FROM attendance_students INNER JOIN students_history ON attendance_students.student_history_id=students_history.id WHERE attendance_students.period_id= ? AND students_history.degree_id = grado) as porFaltas,
            sum(CASE WHEN attendance_students.active = 2 THEN 1 ELSE 0 END) as permisos,
            sum(CASE WHEN attendance_students.active = 2 THEN 1 ELSE 0 END)/(select count(*) FROM attendance_students INNER JOIN students_history ON attendance_students.student_history_id=students_history.id WHERE attendance_students.period_id= ? AND students_history.degree_id = grado) as porPermisos
            FROM ((attendance_students INNER JOIN students_history ON attendance_students.student_history_id=students_history.id) INNER JOIN degrees ON students_history.degree_id = degrees.id) WHERE attendance_students.period_id= ? GROUP BY grado",[$period->id,$period->id,$period->id,$period->id]);
            return view('periods.attendanceOverview',compact('attendances','degrees','period','year'));

    }
}
