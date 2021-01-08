<?php

namespace App\Http\Controllers\Period;

use App\Http\Controllers\Controller;
use App\SchoolPeriod;
use App\SchoolYear;
use App\Help\Help;
use Illuminate\Http\Request;
use App\ScoreStudent;
use Illuminate\Support\Facades\DB;
use App\Subject;
use App\Degree;
use App\DegreeSchoolYear;
use App\DegreeSchoolSubject;
use Carbon\Carbon;

class PeriodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idyear)
    {
        auth()->user()->authorizeRoles(['Administrador','Secretaria']);
        $year= SchoolYear::find($idyear);
        $periodos= SchoolPeriod::where('school_year_id',$idyear)->orderBy('nperiodo','ASC')->get();
       $cantidad= count($periodos);
        return view('periods.index', compact('year','periodos','cantidad'));
    }

    public function finishPeriod($period){
      $year = Help::getSchoolYear();
      $aux = SchoolPeriod::where('school_year_id', $year->id)->where('nperiodo', $period)->first();
      $pe = SchoolPeriod::where('school_year_id', $year->id)->where('nperiodo', $period)->
      update([
        'finish'=> $aux->finish == true ? false : true
      ]);
      return back()->with('success', 'El periodo ha sido modificado correctamente');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idyear)
    {
        auth()->user()->authorizeRoles(['Administrador']);
        $periodos= SchoolPeriod::where('school_year_id',$idyear)->orderBy('nperiodo','ASC')->get();
        $cantidad= count($periodos);
       $n1=0; $n2=0; $n3=0;

       //validacion de priodo
    /*  for ($i=0; $i < $cantidad ; $i++) {
          if ($periodos[$i]['nperiodo'] == 1 ) {
              $n1=1;
          break;
          } else {
             if ($periodos[$i]['nperiodo'] == 2) {
                 $n2=1;
                break;
             } else {
                 $n3=1;
             }

          }
      } */

       if ($cantidad >= 3) {
        return back()->with('delete','No se pueden asignar más de 3 periodos a un año escolar');
    } else {
        $year= SchoolYear::find($idyear);
    return view('periods.create', compact('year','periodos','n1','n2','n3'));
    }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $idyear)
    {
        auth()->user()->authorizeRoles(['Administrador']);
        $schoolYear=SchoolYear::find($idyear);        
        $bandera=0;
        $periodos= SchoolPeriod::where('school_year_id',$idyear)->orderBy('nperiodo','ASC')->get();
        foreach ($periodos as $value) {
            if ($value->nperiodo == $request->nperiodo) {
              $bandera=1;
            }
        }

        if ($bandera==1) {
            return back()->with('delete','Error. Ya existe el  <strong>PERIODO '.$request->nperiodo.'</strong>. Seleccione Otra Opcion.')->withInput();
        } else {

            //Revisando las fechas entre periodo
            $startDate= Carbon::create($request->startdate);
            $endDate= Carbon::create($request->enddate);
            foreach($periodos as $period){
                $startDatePeriodCreated= Carbon::create($period->start_date);
                $endDatePeriodCreated= Carbon::create($period->end_date);
                if(($startDate->lessThanOrEqualTo($startDatePeriodCreated)||$startDate->lessThanOrEqualTo($endDatePeriodCreated))&& $request->nperiodo > $period->nperiodo){
                    if($startDate->year!=$schoolYear->year){
                        return back()->with('delete','<strong>Error. La fecha de inicio seleccionada se encuentra en un año diferente al seleccionado</strong>')->withInput();
                    }else{
                        return back()->with('delete','<strong>Error. La fecha de inicio se encuentra dentro del periodo '.$period->nperiodo .' ya registrado</strong>')->withInput();
                    }                
                }
                if(($endDate->greaterThanOrEqualTo($startDatePeriodCreated))&& $request->nperiodo < $period->nperiodo){
                    if($startDate->year!=$schoolYear->year){
                        return back()->with('delete','<strong>Error. La fecha de finalización seleccionada se encuentra en un año diferente al seleccionado</strong>')->withInput();
                    }else{
                        return back()->with('delete','<strong>Error. La fecha de finalización se encuentra dentro de un periodo ya registrado</strong>')->withInput();
                    }                
                }                                
            }

            //Revisando fechas respecto a las fechas establecidas del año escolar
            $schoolYearStartDate=Carbon::create($schoolYear->start_date);
            $schoolYearEndDate=Carbon::create($schoolYear->end_date);            
            if(!($startDate->between($schoolYearStartDate,$schoolYearEndDate))){
                return back()->with('delete','<strong>Error. La fecha de inicio introducida no se encuentra dentro del rango de fechas establecidas del año escolar actual.</strong>')->withInput();
            }
            if(!($endDate->between($schoolYearStartDate,$schoolYearEndDate))){
                return back()->with('delete','<strong>Error. La fecha de finalización introducida no se encuentra dentro del rango de fechas establecidas del año escolar actual.</strong>')->withInput();
            }
            
            //Revisando que la fecha de inicio no sea mayor a la de finalización
            if($startDate->lessThan($endDate)){
                if($schoolYear->year == $startDate->year && $schoolYear->year == $endDate->year){
                    SchoolPeriod::create([
                        'start_date' => $request->startdate,
                        'end_date' => $request->enddate,
                        'school_year_id' => $idyear,
                        'nperiodo' => $request->nperiodo,
                    ]);
                    return redirect()->route('periods-index',$idyear)->with('success','Registro Creado Correctamente');
                }
                else{
                    return back()->with('delete','<strong>Error. El año ingresado no es igual al año seleccionado en las fechas.</strong>')->withInput();
                }
            }
            else{
                return back()->with('delete','<strong>Error. La fecha de inicio es mayor o igual a la fecha de finalización del periodo.</strong>')->withInput();
            }
            
        }

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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        auth()->user()->authorizeRoles(['Administrador']);
        $year=SchoolYear::where('active',1)->first();
        $periodo= SchoolPeriod::find($id);
        return view('periods.edit', compact('periodo','year'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idperiodo)
    {           
        auth()->user()->authorizeRoles(['Administrador']);
        $periodo= SchoolPeriod::find($idperiodo);
        $schoolYear=SchoolYear::find($periodo->school_year_id);
        $periodos= SchoolPeriod::where('school_year_id',$periodo->school_year_id)
                                ->where('nperiodo','<>',$periodo->nperiodo)
                                ->orderBy('nperiodo','ASC')->get();        
        $startDate= Carbon::create($request->startdate);
        $endDate= Carbon::create($request->enddate);
        foreach($periodos as $period){
            $startDatePeriodCreated= Carbon::create($period->start_date);
            $endDatePeriodCreated= Carbon::create($period->end_date);
            if(($startDate->lessThanOrEqualTo($startDatePeriodCreated)||$startDate->lessThanOrEqualTo($endDatePeriodCreated))&& $periodo->nperiodo > $period->nperiodo){
                if($startDate->year!=$schoolYear->year){
                    return back()->with('delete','<strong>Error. La fecha de inicio seleccionada se encuentra en un año diferente al seleccionado</strong>');    
                }else{
                    return back()->with('delete','<strong>Error. La fecha de inicio se encuentra dentro del periodo '.$period->nperiodo .' ya registrado</strong>');    
                }                
            }
            if(($endDate->greaterThanOrEqualTo($startDatePeriodCreated))&& $periodo->nperiodo < $period->nperiodo){                
                if($startDate->year!=$schoolYear->year){
                    return back()->with('delete','<strong>Error. La fecha de finalización seleccionada se encuentra en un año diferente al seleccionado</strong>');    
                }else{
                    return back()->with('delete','<strong>Error. La fecha de finalización se encuentra dentro de un periodo ya registrado</strong>');
                }                
            }                                
        }

        //Revisando fechas respecto a las fechas establecidas del año escolar
        $schoolYearStartDate=Carbon::create($schoolYear->start_date);
        $schoolYearEndDate=Carbon::create($schoolYear->end_date);            
        if(!($startDate->between($schoolYearStartDate,$schoolYearEndDate))){
            return back()->with('delete','<strong>Error. La fecha de inicio introducida no se encuentra dentro del rango de fechas establecidas del año escolar actual.</strong>');
        }
        if(!($endDate->between($schoolYearStartDate,$schoolYearEndDate))){
            return back()->with('delete','<strong>Error. La fecha de finalización introducida no se encuentra dentro del rango de fechas establecidas del año escolar actual.</strong>');
        }
        
        if($startDate->lessThan($endDate)){
            
                SchoolPeriod::where('id',$idperiodo)->update([
                    'start_date' => $request->startdate,
                    'end_date' => $request->enddate,
                ]);
                return redirect()->route('periods-index',$periodo->school_year_id)->with('edit','Registro Actualizado Correctamente');                        
        }
        else{
            return back()->with('delete','<strong>Error. La fecha de inicio es mayor o igual a la fecha de finalización del periodo.</strong>');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        auth()->user()->authorizeRoles(['Administrador']);
        $period=SchoolPeriod::find($request->id);
        if($period->current==1){
            return back()->with('delete',' <strong> El periodo no pude ser eliminado por estar activo </strong>');
        }
        SchoolPeriod::destroy($request->id);
        return back()->with('success','<strong> Registro Eliminado Correctamente </strong>');
    }

    public function changePeriodStatus(Request $request,$idyear,$idperiod){
        auth()->user()->authorizeRoles(['Administrador']);
        $schoolYear= SchoolYear::find($idyear);
        $period=SchoolPeriod::find($idperiod);
        SchoolPeriod::where('current',1)->where('school_year_id',$schoolYear->id)->update(['current'=>0]);
        SchoolPeriod::where('id',$idperiod)->update(['current'=>1]);
        return back()->with('success','<strong>El periodo escolar '.$period->nperiodo. ' - '.$schoolYear->year. ' ha sido activado correctamente</strong>');
    }

    public function showPeriodScoresOverview($idYear,$idPeriod){
        auth()->user()->authorizeRoles(['Administrador','Secretaria']);

        $schoolYear= SchoolYear::find($idYear);
        $period=SchoolPeriod::find($idPeriod);
        $subjects=Subject::all();
        $subjectsYear=DegreeSchoolSubject::where('school_year_id',$idYear)->get();
        $degreesYear=DegreeSchoolYear::where('school_year_id',$idYear)->get();

        $infoBySubject=array();

        foreach($subjects as $subject){

            $subjectYear=DegreeSchoolSubject::where('subject_id',$subject->id)->where('school_year_id',$idYear)->get();

            if(sizeof($subjectYear)>0){
                $averageBySubject=0;
                $aprobadosBySubject=0;
                $aprobadosBySubjectPercentage=0;
                $reprobadosBySubject=0;
                $reprobadosBySubjectPercentage=0;
                $sumScoresBySubject=0;

                $studentAverageBySubject=DB::select(
                    "SELECT students.name as student,subjects.name as subject, sum(score*score_type.percentage/100) as average
                    FROM score_students JOIN subjects ON score_students.subject_id=subjects.id
                    JOIN score_type ON score_students.score_type_id=score_type.id
                    JOIN students ON score_students.student_id=students.id
                    WHERE score_students.school_period_id = ? AND score_students.subject_id=?
                    GROUP BY score_students.student_id",[$idPeriod,$subject->id]);

                foreach($studentAverageBySubject as $average){
                    $sumScoresBySubject=$sumScoresBySubject+$average->average;
                    if($average->average>=6) $aprobadosBySubject++;
                    else $reprobadosBySubject++;
                }

                $evaluadosBySubject=$aprobadosBySubject+$reprobadosBySubject;
                if($evaluadosBySubject!=0){
                    $averageBySubject=$sumScoresBySubject/$evaluadosBySubject;
                    $aprobadosBySubjectPercentage=$aprobadosBySubject/$evaluadosBySubject;
                    $reprobadosBySubjectPercentage=$reprobadosBySubject/$evaluadosBySubject;
                }

                array_push($infoBySubject,array(
                    $subject->name,
                    $averageBySubject,
                    $aprobadosBySubject,
                    $aprobadosBySubjectPercentage,
                    $reprobadosBySubject,
                    $reprobadosBySubjectPercentage,
                    $evaluadosBySubject
                ));
            }
        }

        $infoByDegree=array();

        foreach($degreesYear as $degreeYear){

            $degree=Degree::find($degreeYear->degree_id);
            $averageByDegree=0;
            $aprobadosByDegree=0;
            $aprobadosByDegreePercentage=0;
            $reprobadosByDegree=0;
            $reprobadosByDegreePercentage=0;
            $sumScoresByDegree=0;

            $studentScoresByDegree=DB::select(
                "SELECT students.name as student,degrees.degree as degree, sum(score*score_type.percentage/100) as sumAverages
                FROM score_students JOIN score_type ON score_students.score_type_id=score_type.id
                JOIN degrees ON score_students.degree_id=degrees.id
                JOIN students ON score_students.student_id=students.id
                WHERE score_students.school_period_id = ? AND score_students.degree_id=?
                GROUP BY score_students.student_id",[$idPeriod,$degree->id]);

            $nSubjectsByDegree=sizeof(DB::select("SELECT count(subject_id) as n FROM score_students WHERE degree_id=? AND school_year_id=? AND school_period_id=? GROUP BY subject_id",[$degree->id,$idYear,$idPeriod]));

            foreach($studentScoresByDegree as $score){
                $studentAverage=$score->sumAverages/$nSubjectsByDegree;
                $sumScoresByDegree=$sumScoresByDegree+$studentAverage;
                if($studentAverage>=6) $aprobadosByDegree++;
                else $reprobadosByDegree++;
            }

            $evaluadosByDegree=$aprobadosByDegree+$reprobadosByDegree;
            if($evaluadosByDegree!=0){
                $averageByDegree=$sumScoresByDegree/$evaluadosByDegree;
                $aprobadosByDegreePercentage=$aprobadosByDegree/$evaluadosByDegree;
                $reprobadosByDegreePercentage=$reprobadosByDegree/$evaluadosByDegree;
            }

            $degreeData=Help::ordinal($degree->degree)." ".$degree->section;
            $degreeId = $degree->id;

            array_push($infoByDegree,array(
                $degreeData,
                $averageByDegree,
                $aprobadosByDegree,
                $aprobadosByDegreePercentage,
                $reprobadosByDegree,
                $reprobadosByDegreePercentage,
                $evaluadosByDegree,
                $degreeId
            ));
        }

        return view('periods.periodScoresOverview', [
            "schoolYear"=>$schoolYear,
            "period"=>$period,
            "infoBySubject"=>$infoBySubject,
            "infoByDegree"=>$infoByDegree,
            "degreesYear"=>$degreesYear,
            "subjectsYear"=>$subjectsYear]);
    }






}
