<?php

namespace App\Http\Controllers\Score;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ScoreType;
use App\SchoolPeriod;
use App\Degree;
use App\Subject;
use App\User;
use App\Help\Help;

class ScoreTypeController extends Controller
{
    public function scoreType(){
    	$years = array();
    	return view('score.type.scoretypes', compact('years'));
    }

    public function crateScoreType(){
    	return view('score.type.scoretypesCreate');
    }

    public function scoreTypeSave(Request $request){
        //dd($request->period,$request->year,$request->grade);

        $accumulatedPercentage=ScoreType::where('school_period_id',$request->period)
            ->where('school_year_id',$request->year)
            ->where('degree_id',$request->grade)
            ->where('subject_id',$request->subject)
            ->sum('percentage');

        //dd($accumulatedPercentage);

        if($accumulatedPercentage==100){
            return back()->with('delete', '<strong> Ya se ha alcanzado el porcentaje máximo. </strong>');
        }
        else{
            if($accumulatedPercentage+$request->percentage > 100){
                return back()->with('delete', '<strong> El porcentaje ingresado sobrepasa el valor máximo. </strong>');
            }
            else{
                $checkingNumberBehavior=ScoreType::where('school_period_id',$request->period)
                    ->where('school_year_id',$request->year)
                    ->where('degree_id',$request->grade)
                    ->where('subject_id',$request->subject)
                    ->where('type','Actitud')
                    ->count();

                if($checkingNumberBehavior>0){
                    return back()->with('delete', '<strong> Ya existe una nota de Actitud ingresada. </strong>');
                }
                else{
                    $scoreType= new ScoreType();
                    $scoreType->school_period_id=$request->period;
                    $scoreType->school_year_id=$request->year;
                    $scoreType->degree_id=$request->grade;
                    $scoreType->subject_id=$request->subject;
                    $scoreType->percentage=$request->percentage;
                    $scoreType->activity=$request->activity;
                    $scoreType->description=$request->description;
                    $scoreType->date=$request->date;
                    $scoreType->type=$request->type;
                    $scoreType->save();
                }            
            }
        }                

        $grade = Degree::find($request->grade);
        $teacher = User::find($request->teacher);
        $subject = Subject::find($request->subject);
        $numberPeriodBack=$request->period;
        $year=Help::getSchoolYear();
        $types=Help::types();
        $period = SchoolPeriod::where('nperiodo',$request->period)        
        ->where('school_year_id', $year->id)->first();
        return redirect()->route('scorePercentage', compact('grade','teacher','subject','period','year','types'))->with('success','<strong> Porcentaje guardado con éxito.</strong>');
    }
}