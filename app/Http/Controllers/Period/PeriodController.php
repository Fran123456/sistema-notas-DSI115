<?php

namespace App\Http\Controllers\Period;

use App\Http\Controllers\Controller;
use App\SchoolPeriod;
use App\SchoolYear;
use Illuminate\Http\Request;

class PeriodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idyear)
    {
        $year= SchoolYear::find($idyear);
        $periodos= SchoolPeriod::where('school_year_id',$idyear)->orderBy('nperiodo','ASC')->get();
       $cantidad= count($periodos);
        return view('periods.index', compact('year','periodos','cantidad'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idyear)
    {
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
        return back()->with('delete','No se pueden asignar mas de 3 periodos a un año escolar');
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
        $bandera=0;
        $periodos= SchoolPeriod::where('school_year_id',$idyear)->orderBy('nperiodo','ASC')->get();
        foreach ($periodos as $value) {
            if ($value->nperiodo == $request->nperiodo) {
              $bandera=1;
            }
        }

        if ($bandera==1) {
            return back()->with('delete','Error. Ya existe el  <strong>PERIODO '.$request->nperiodo.'</strong>. Seleccione Otra Opcion.');
        } else {
            SchoolPeriod::create([
                'start_date' => $request->startdate,
                'end_date' => $request->enddate,
                'school_year_id' => $idyear,
                'nperiodo' => $request->nperiodo,
            ]);
            return redirect()->route('periods-index',$idyear)->with('success','Registro Creado Correctamente');
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
        $periodo= SchoolPeriod::find($id);
        return view('periods.edit', compact('periodo'));
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
        $periodo= SchoolPeriod::find($idperiodo);
        SchoolPeriod::where('id',$idperiodo)->update([
            'start_date' => $request->startdate,
            'end_date' => $request->enddate,
        ]);
        return redirect()->route('periods-index',$periodo->school_year_id)->with('edit','Registro Actualizado Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        SchoolPeriod::destroy($request->id);
        return back()->with('delete','Registro Eliminado Correctamente');
    }

    public function changePeriodStatus(Request $request,$idyear,$idperiod){
        $request->user()->authorizeRoles(['administrador']);
        $schoolYear= SchoolYear::find($idyear);
        $period=SchoolPeriod::find($idperiod);
        SchoolPeriod::where('current',1)->where('school_year_id',$schoolYear->id)->update(['current'=>0]);
        SchoolPeriod::where('id',$idperiod)->update(['current'=>1]);
        return back()->with('success','<strong>El periodo escolar '.$period->nperiodo. ' - '.$schoolYear->year. ' ha sido activado correctamente</strong>');
    }
}
