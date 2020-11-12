<?php

namespace App\Http\Controllers\Behavior;

use App\BehaviorIndicator;
use App\BehaviorIndicatorsStudent;
use App\Degree;
use App\Help\Help;
use App\Http\Controllers\Controller;
use App\SchoolPeriod;
use App\SchoolYear;
use App\StudentHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BehaviorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        auth()->user()->authorizeRoles(['Administrador','Secretaria']);
        $indicadores= BehaviorIndicator::all();
        return view('behavior.crud.index', compact('indicadores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        auth()->user()->authorizeRoles(['Administrador','Secretaria']);
        return view('behavior.crud.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        auth()->user()->authorizeRoles(['Administrador','Secretaria']);
        BehaviorIndicator::create([
            'name' => $request->name,
            'code' => $request->code,
            'description' =>$request->description,
        ]);
        return redirect()->route('behaviors.index')->with('success','Indicador de Conducta Creado Correctamente');
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
        auth()->user()->authorizeRoles(['Administrador','Secretaria']);
        $indicador= BehaviorIndicator::find($id);
        return view('behavior.crud.edit', compact('indicador'));
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
        auth()->user()->authorizeRoles(['Administrador','Secretaria']);
        BehaviorIndicator::where('id',$id)->update([
            'name' => $request->name,
            'code' => $request->code,
            'description' =>$request->description,
        ]);
        return redirect()->route('behaviors.index')->with('EDIT','Indicador de Conducta Editado Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        auth()->user()->authorizeRoles(['Administrador','Secretaria']);
        BehaviorIndicator::find($request->id)->delete();
        return back()->with('delete','Indicador de Conducta Eliminado Correctamente');
    }
    public function all($degree)
    {
        auth()->user()->authorizeRoles(['Docente']);
        $activo= SchoolYear::where('active',1)->get();
        //dd($activo[0]->id);
        $periodos = SchoolPeriod::where('school_year_id',$activo[0]->id)->get();
       $grado= Degree::find($degree);
       return view('behavior.all_list', compact('grado','periodos'));
    }
    public function register($degreeid, $periodid)
    {
        auth()->user()->authorizeRoles(['Docente']);
        $periodSelected= SchoolPeriod::find($periodid);
        $activePeriod= SchoolPeriod::where('current',1)->get();

        $year= SchoolYear::where('active',1)->get();
        $students= BehaviorIndicatorsStudent::join('behavior_indicators','behavior_indicators.id','behavior_indicators_student.behavior_indicator_id')
        ->join('students','students.id','behavior_indicators_student.student_id')
        ->select('students.name as nombre','students.lastname','behavior_indicators.name','behavior_indicators.code')
        ->where('school_period_id',$periodid)
        ->where('school_year_id',$year[0]->id)
        ->where('degree_id',$degreeid)->get();


        if ($periodSelected->id != $activePeriod[0]->id) {
            return back()->with('delete','Error, el Periodo Seleccionado <strong>No Se encuentra Activo </strong>Para El Registro de Datos.');
        } else {
            if (   count($students) >0 ) {
                return back()->with('delete','Error. <strong>Ya Se han Registrado </strong> Los Indicadores de Conducta Para Este Periodo');
            } else {
                $degree= Degree::find($degreeid);
                $activeYear= SchoolYear::where('active',1)->get();
                $activePeriod= SchoolPeriod::where('current',1)->get();

                $students= StudentHistory::join('students','students.id','students_history.student_id')
                ->select('students.id','students.name','students.lastname','students_history.degree_id','students_history.school_year_id')
                ->where('school_year_id',$activeYear[0]->id)
                ->where('degree_id',$degreeid)
                ->where('students_history.status',1)->orderBy('students.lastname','ASC')->get();
                $indicadores=BehaviorIndicator::all();

                return view('behavior.students_behavior', compact('degree','activeYear','activePeriod','students','indicadores'));
            }

        }


    }

    public function saveRegister(Request $request)
    {
        $data= $request->all();
        //dd($data);
        //dd( intval( $data['behavior_indicator_id'][0]));
        $grado= Degree::find($data['degree_id'][0]);
        $periodo= SchoolPeriod::find($data['school_period_id'][0]);
        $mensaje= Help::ordinal($grado->degree). $grado->section .'-'. Help::turn($grado->turn);

        $cantidad=count($data['student_id']);
        for ($i=0; $i < $cantidad ; $i++) {
            BehaviorIndicatorsStudent::create([
                'behavior_indicator_id' =>  $data['behavior_indicator_id'][$i],
                'student_id' =>$data['student_id'][$i],
                'school_period_id' => $data['school_period_id'][$i],
                'school_year_id' => $data['school_year_id'][$i],
                'degree_id' => $data['degree_id'][$i],

            ]);
        }

        return redirect()->route('behaviors-all',$grado->id)->with('success','<strong>'. $cantidad.'</strong> Registros guardados de Indicadores de Conducta
          Para el Grado <strong>'.$mensaje.' Para el PERIODO' .$periodo->nperiodo.'</strong>');
    }
    public function detail($degreeid, $periodid)
    {
        auth()->user()->authorizeRoles(['Docente']);
        $degree= Degree::find($degreeid);
        $year= SchoolYear::where('active',1)->get();
        $periodo= SchoolPeriod::find($periodid);
        $students= BehaviorIndicatorsStudent::join('behavior_indicators','behavior_indicators.id','behavior_indicators_student.behavior_indicator_id')
        ->join('students','students.id','behavior_indicators_student.student_id')
        ->select('students.name as nombre','students.lastname','behavior_indicators.name','behavior_indicators.code')
        ->where('school_period_id',$periodo->id)
        ->where('school_year_id',$year[0]->id)
        ->where('degree_id',$degreeid)
        ->orderBy('students.lastname','ASC')
        ->get();
        if (  count($students) == 0 ) {
           return back()->with('edit','Sin Registros Encontrados');
        } else {
            return view('behavior.detail', compact('degree','periodo','students'));
        }


    }
    public function delete($iddegrre, $idperiodo)
    {
        auth()->user()->authorizeRoles(['Docente']);
        $periodo= SchoolPeriod::find($idperiodo);
        $yearActive= SchoolYear::where('active',1)->first();
        BehaviorIndicatorsStudent::where('school_period_id',$idperiodo)
        ->where('school_year_id',$yearActive->id)
        ->where('degree_id',$iddegrre)->delete();
        return back()->with('delete','Registros Eliminado Correctamente del <strong> PERIODO'.$periodo->nperiodo.'</strong>');
    }
}
