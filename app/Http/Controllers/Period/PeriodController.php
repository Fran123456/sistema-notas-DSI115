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
        return view('periods.index', compact('year','periodos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idyear)
    {
        $year= SchoolYear::find($idyear);
        return view('periods.create', compact('year'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $idyear)
    {
        SchoolPeriod::create([
            'start_date' => $request->startdate,
            'end_date' => $request->enddate,
            'school_year_id' => $idyear,
            'nperiodo' => $request->nperiodo,
        ]);
        return redirect()->route('periods-index',$idyear)->with('success','Registro Creado Correctamente');

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
}
