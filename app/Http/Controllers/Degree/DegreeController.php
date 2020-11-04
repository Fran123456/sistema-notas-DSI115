<?php

namespace App\Http\Controllers\Degree;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Degree;
use App\Help\Help;

class DegreeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        auth()->user()->authorizeRoles(['Administrador','Secretaria']);
        $degrees = Degree::orderBy('turn')->get();
        return view('degrees.degrees',["degrees"=>$degrees]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        auth()->user()->authorizeRoles(['Administrador','Secretaria']);
        return view('degrees.degreesCreate');
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
        $d = Degree::where([
            'degree' => $request->degree,
            'section' => $request->seccion
        ])->get();

      if(count($d)>0){
          return back()->with('delete', '<strong>El grado '.$request->degree.' sección '.$request->seccion.' ya existe.</strong>');
       }else{
        $newDegree = Degree::create([
            'degree'   => $request->degree,
            'section'  => $request->seccion,
            'turn'     => $request->turn,
            'active'   => $request->active
        ]);
        return redirect()->route('degrees.index')->with('success', '<strong>El grado '.$request->degree.' sección '.$request->seccion.' ha sido guardado correctamente.</strong>');
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
        auth()->user()->authorizeRoles(['Administrador','Secretaria']);
        $degree= Degree::where("id",$id)->first();
        return view('degrees.edit', compact('degree'));
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
        Degree::where('id',$id)
        ->update([

            'degree' =>$request->degree,
            'section' =>$request->section,
            'turn' =>$request->turn,
            'active' =>$request->active,
        ]);


        return redirect()->route('degrees.index')->with('edit','Editado Correctamente');
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

    public function changeStatusDegree(Request $request, $id){
        auth()->user()->authorizeRoles(['Administrador','Secretaria']);
        $backDegree=Degree::find($id);
        $valorCambio=1;
        $stringCambio="";
        if($backDegree->active==0){
            $valorCambio=1;
        }
        else{
            $valorCambio=0;
        }
        Degree::where('id',$id)->update(['active'=>$valorCambio]);
        if($valorCambio==1){
            $stringCambio=" activado ";
        }
        else{
            $stringCambio=" desactivado ";
        }
        return redirect()->route('degrees.index')->with('edit','<strong>El grado '.$backDegree->degree.' sección '.$backDegree->section.' turno '.$backDegree->turn.' ha sido '.$stringCambio.' correctamente</strong>');

    }
}
