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
use DB;
use App\ScoreStudent;

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

    /*METODO PARA DISTRIBUIR LOS % POR PERIODO A LOS ALUMNOS*/
    public function SendTypes(Request $request){
      $query = ScoreType::scoreTypeByDegree($request->periodx,$request->yearx, $request->gradex, $request->subjectx);
      $countQuery = ScoreType::countScoreTypeByDegree($query);

      $sol = ScoreType::validateSendType($query); //validamos si han sido enviadas o no
      if($sol == true){
        return back()->with('delete', 'Ya han sido distribuidos los porcentajes');
      }

      if($countQuery == 100){
        //vamos a distribuir
        $students = User::studentsByYearByDegree($request->gradex,$request->yearx);
        foreach ($students as $key => $student) {
          foreach ($query as $key2 => $type) {
              $c = ScoreStudent::create([
               'score_type_id' => $type->id,
               'student_id' =>$student->id,
               'school_period_id' =>$type->school_period_id,
               'school_year_id' =>$type->school_year_id,
               'degree_id' =>$type->degree_id,
               'subject_id'=>$type->subject_id,
               'score' =>0,
              ]);

              $w = ScoreType::where('id', $type->id)->
              update([
                'send' => true
              ]);
          }
        }
        return back()->with('success', 'Se ha distribuido el periodo para los alumnos');
        //return $query;
      }else{
        return back()->with('delete', 'Aun no se puede distribuir hasta que cumpla el 100%');
      }
    }
      /*METODO PARA DISTRIBUIR LOS % POR PERIODO A LOS ALUMNOS*/

}
