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
       // auth()->user()->authorizeRoles(['administrador']);
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        Degree::where('id',$id)
        ->update([

            'degree' =>$request->degree,
            'section' =>$request->section,
            'turn' =>$request->turn,
            'active' =>$request->active,
        ]);

        return $this->index()->with('info','Editado Correctamente');
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
}
