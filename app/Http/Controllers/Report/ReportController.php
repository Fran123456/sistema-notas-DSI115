<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\StudentHistory;
use App\Student;
use App\SchoolPeriod;
use App\SchoolYear;
use App\ScoreStudent;
use App\AttendanceStudent;
use Barryvdh\DomPDF\Facade as PDF;
use App\User;
use App\Degree;
use DB;
use App\Subject;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin(Request $request)
    {

        $student = Student::where("id", $request->usuario_id)->first();

        $attendance = AttendanceStudent::where("student_history_id",  $request->usuario_id)->where('period_id', $request->periodo_id)->get();

        $period = SchoolPeriod::where("id", $request->periodo_id)->first();

        $history = StudentHistory::where("student_id",  $request->usuario_id)->first();

        $pdf = PDF::loadView('pdf.reports', compact('student', 'attendance', 'history', 'period'));

         return $pdf->download('ASISTENCIA-'.$student->name.'-'.$student->lastname.'-PERIODO '.$period->nperiodo.'.pdf');
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

        return view('students.studentReports', compact('student'));
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

    public function reportpdf($idstudent, $idperiod)
    {

       $student = Student::where("id", $idstudent)->first();

       $attendance = AttendanceStudent::where("student_history_id", $idstudent)->where('period_id', $idperiod)->get();

       $period = SchoolPeriod::where("id", $idperiod)->first();

       $history = StudentHistory::where("student_id", $idstudent)->first();

       $pdf = PDF::loadView('pdf.reports', compact('student', 'attendance', 'history', 'period'));

        return $pdf->download('reporte-asistencia.pdf');
    }

    public function scorespdf($id)
    {
        $student = Student::where("id", $id)->first();
        $history = StudentHistory::where("student_id", $id)->first();
        $periods = SchoolPeriod::all();
        $scores = ScoreStudent::where("student_id", $id)->get();

        $pdf = PDF::loadView('pdf.scores', compact('student', 'history', 'periods', 'scores'));

        return $pdf->download('reporte-notas.pdf');
    }

    public function failedpdf($idDegree, $idYear, $idTeacher)
    {
        $schoolYear = SchoolYear::where('active', true)->first();
        $teacher=User::find($idTeacher);
        $degree= Degree::find($idDegree);
        $students=  User::studentsByYearByDegree($degree->id,$schoolYear->id);

        $notas=DB::select(
        "SELECT students.name as nombre, students.lastname as apellido,students.id as id,subjects.name as materia, score_students.school_period_id as periodo, sum((score*score_type.percentage/100)/3) as promedio 

        FROM score_students

        JOIN subjects ON score_students.subject_id=subjects.id 
        JOIN score_type ON score_students.score_type_id=score_type.id 
        JOIN students ON score_students.student_id=students.id
        JOIN degrees ON score_students.degree_id=degrees.id
        JOIN school_period ON score_students.school_period_id=school_period.id 

        WHERE score_students.degree_id=? AND score_students.school_year_id=?

        GROUP BY score_students.student_id,score_students.subject_id",[$idDegree,$schoolYear->id]);

        //dd($notas);

        $pdf = PDF::loadView('pdf.failed', compact('schoolYear', 'teacher', 'degree', 'students','notas'));

        return $pdf->download('reporte-reprobados.pdf');
        
    }

    public function passedpdf($idDegree, $idYear, $idTeacher)
    {

        $schoolYear = SchoolYear::where('active', true)->first();
        $teacher=User::find($idTeacher);
        $degree= Degree::find($idDegree);
        $students=  User::studentsByYearByDegree($degree->id,$schoolYear->id);

        $notas=DB::select(
        "SELECT students.name as nombre, students.lastname as apellido,students.id as id,subjects.name as materia, score_students.school_period_id as periodo, sum((score*score_type.percentage/100)/3) as promedio 

        FROM score_students

        JOIN subjects ON score_students.subject_id=subjects.id 
        JOIN score_type ON score_students.score_type_id=score_type.id 
        JOIN students ON score_students.student_id=students.id
        JOIN degrees ON score_students.degree_id=degrees.id
        JOIN school_period ON score_students.school_period_id=school_period.id 

        WHERE score_students.degree_id=? AND score_students.school_year_id=?

        GROUP BY score_students.student_id,score_students.subject_id",[$idDegree,$schoolYear->id]);

        $pdf = PDF::loadView('pdf.passed', compact('schoolYear', 'teacher', 'degree', 'students', 'notas'));

        return $pdf->download('reporte-aprobados.pdf');

    }

    public function attendancespdf($idYear, $idPeriod,$degree,$section)
    {

        $schoolYear = SchoolYear::find($idYear);
        $period=SchoolPeriod::find($idPeriod);
        $degree=Degree::where('degree',$degree)->where('section',$section)->first();

        $attendances= DB::select(
        "SELECT students.name as name,students.lastname as lastname,
        sum(CASE WHEN attendance_students.active = 1 THEN 1 ELSE 0 END) as asistencias,
        sum(CASE WHEN attendance_students.active = 0 THEN 1 ELSE 0 END) as faltas,
        sum(CASE WHEN attendance_students.active = 2 THEN 1 ELSE 0 END) as permisos 
        FROM attendance_students 
        INNER JOIN students_history ON attendance_students.student_history_id=students_history.id 
        INNER JOIN degrees ON students_history.degree_id = degrees.id 
        INNER JOIN students ON students_history.student_id = students.id 
        WHERE attendance_students.period_id=? AND degrees.id=? 
        GROUP BY attendance_students.student_history_id",[$period->id,$degree->id]);

        $pdf = PDF::loadView('pdf.attendances', compact('schoolYear', 'period','degree','attendances'));
        return $pdf->download('ASISTENCIAS-GRADO'.$degree->degree.''.$degree->section.'-PERIODO'.$period->nperiodo.'-AÑO'.$schoolYear->year.'.pdf');

    }
}
