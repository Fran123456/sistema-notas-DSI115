<?php

namespace App\Http\Controllers\Behavior;

use App\BehaviorIndicator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}
