<?php

namespace App\Http\Controllers\Score;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DegreeSchoolSubject;
use App\Degree;
use App\Subject;
use App\User;
use App\SchoolYear;
use App\SchoolPeriod;
use App\ScoreStudent;
use App\ScoreType;
use App\Help\Help;
use App\Student;
use App\StudentHistory;
use DB;

class ScoreBySubjectController extends Controller
{
    public function showStudentScoreBySubject($idteacher,$id_subject_degree,$nperiod)
    {
        auth()->user()->authorizeRoles(['Docente']);

        $schoolYear = SchoolYear::where('active', true)->first();
        $period = SchoolPeriod::where('nperiodo',$nperiod)->where('school_year_id',$schoolYear->id)->first();
        $teacher = User::find($idteacher);
        $degreeSchoolSubject = DegreeSchoolSubject::find($id_subject_degree);
        $subject = Subject::find($degreeSchoolSubject->subject_id);
        $degree = Degree::find($degreeSchoolSubject->degree_id);

        $students = User::studentsByYearByDegree($degree->id,$schoolYear->id);

        $scores = DB::table('score_students as score')
        ->join('students as stu','score.student_id','=','stu.id')
        ->join('score_type','score.score_type_id','=','score_type.id')
        ->select('score.id','score.student_id','score.score_type_id','stu.name','stu.lastname','score_type.activity','score.score')
        ->where('score.school_year_id',$schoolYear->id)
        ->where('score.school_period_id',$period->id)
        ->where('score.subject_id',$subject->id)
        ->where('score.degree_id',$degree->id)
        ->get();

        $scoreTypes = ScoreType::where('school_year_id',$schoolYear->id)
        ->where('school_period_id',$period->id)
        ->where('subject_id',$subject->id)
        ->where('degree_id',$degree->id)
        ->get();

        return view('score.score.scoresBySubject',["students"=>$students,"scores"=>$scores,"scoreTypes"=>$scoreTypes,"schoolYear"=>$schoolYear,"degree"=>$degree,"teacher"=>$teacher,"subject"=>$subject,"period"=>$period]);
    }

    public function updateScoresBySubject(Request $request)
    {
        auth()->user()->authorizeRoles(['Docente']);

        $student = $request->student;
        $degree = $request->degree;
        $period = $request->period;
        $subject = $request->subject;
        $year = Help::getSchoolYear()->id;
        
        $stu = Student::find($student);
    
        $scores = ScoreStudent::scoreByStudentBySubject($student, $period, $year, $degree, $subject);

        foreach ($scores as $score) 
            ScoreStudent::where('id', $score->id)->update(['score' => $request[$score->id]]);
            
        return back()->with('success', '<strong> Los cambios se han guardado con éxito para el alumno '.$stu->name.' '.$stu->lastname.'</strong>');
    }
    
}
