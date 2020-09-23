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

        $accumulatedPercentage=ScoreType::where('school_period_id',$request->period)
            ->where('school_year_id',$request->year)
            ->where('degree_id',$request->grade)
            ->where('subject_id',$request->subject)
            ->sum('percentage');
        if($accumulatedPercentage==100){
            return back()->with('delete', '<strong> Ya se ha alcanzado el porcentaje máximo. </strong>');
        }
        else{
            if($accumulatedPercentage+$request->percentage > 100 || $request->percentage <= 0){
                return back()->with('delete', '<strong> El porcentaje ingresado no es válido. </strong>');
            }
            else{
                if($request->type=='Actitud'){
                    $checkingNumberBehavior=ScoreType::where('school_period_id',$request->period)
                    ->where('school_year_id',$request->year)
                    ->where('degree_id',$request->grade)
                    ->where('subject_id',$request->subject)
                    ->where('type','Actitud')
                    ->count();
                    if($checkingNumberBehavior>0){
                        return back()->with('delete', '<strong> Ya existe una nota de Actitud ingresada. </strong>');
                    }
                }
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

        return back()->with('success','<strong>Porcentaje guardado con éxito.</strong>');
    }


    public function destroy(Request $request)
    {
        ScoreType::destroy($request->id);

        return back()->with('delete','<strong>Porcentaje eliminado correctamente</strong>');
    }

}
