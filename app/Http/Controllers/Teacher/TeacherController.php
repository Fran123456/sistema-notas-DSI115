<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\DegreeSchoolSubject;
use App\Help\Help;
use App\Degree;
use App\DegreeSchoolYear;
use App\Subject;
use App\SchoolPeriod;
use App\SchoolYear;
use DB;
//use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    public function grades($id){//id del teacher
		$data =  User::teacher();
		//dd($data);
    	//return $data;
    	return view('score.teacher.teacherMenu',compact('data'));
    }

   /*tipos de evaluacion que va tener una materia*/
    public function types($grade, $teacher){
       $grades  = DegreeSchoolSubject::where('school_year_id',Help::getSchoolYear()->id)
       ->where('degree_id', $grade)->get();
       $grade = Degree::find($grade);
       $te = User::find($teacher);
       return view('score.type.subjects',compact('grades','te','grade'));
    }
    /*tipos de evaluacion que va tener una materia*/

    public function scorePercentage($grade,$teacher, $subject, $period){
        $grade = Degree::find($grade);
        $teacher = User::find($teacher);
        $subject = Subject::find($subject);
        $numberPeriodBack=$period;
        $year=Help::getSchoolYear();
        $types=Help::types();
        $period = SchoolPeriod::where('nperiodo',$period)        
        ->where('school_year_id', $year->id)->first();

        /*$arrayPercentages=ScoreType::where('school_period_id',$numberPeriodBack)
            ->where('school_year_id',$year->id)
            ->where('degree_id',$grade->id)
            ->where('subject_id',$subject->id)
            ->get();*/

        $query=DB::SELECT("SELECT * FROM score_type WHERE (school_period_id = ? AND school_year_id = ? AND degree_id = ? AND subject_id = ?)",[$numberPeriodBack,$year->id,$grade->id,$subject->id]);
        //dd($arrayPercentages);
        //dd($query);
        

        if($period==null){
            return back()->with('delete','<strong> No existe registro del periodo '.$numberPeriodBack.' del año '.Help::getSchoolYear()->year.'. </strong>');
        }
        
        return view('score.type.scoreTypesCreate', compact('grade','teacher','subject','period','year','types','query'));
    }


    public function showStudentsDegreeTeacher($idteacher,$iddegree)
    {
        $schoolYear = SchoolYear::where('active', true)->first();
        $teacher=User::find($idteacher);
        $degree= Degree::find($iddegree);
        $students = DB::table('students as stu')
        ->join('students_history as sh','stu.id','=','sh.student_id')
        ->select('sh.id','stu.name','stu.lastname','stu.gender','stu.age','stu.address','stu.phone','stu.parent_name','stu.status')
        ->where('sh.degree_id','=',$degree->id)
        ->where('sh.school_year_id','=',$schoolYear->id)
        ->get();
        return view('students.studentsDegreeTeacher',["students"=>$students,"schoolYear"=>$schoolYear,"degree"=>$degree,"teacher"=>$teacher]);
    }
}
