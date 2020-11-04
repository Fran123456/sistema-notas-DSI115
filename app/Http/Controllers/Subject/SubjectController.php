<?php

namespace App\Http\Controllers\Subject;

use App\Http\Controllers\Controller;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Matcher\Subset;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // auth()->user()->authorizeRoles(['Administrador','Secretaria']);
        $subjects = Subject::get();
        return view('subjects.subjects',["subjects"=>$subjects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      //  auth()->user()->authorizeRoles(['Administrador','Secretaria']);
        return view('subjects.subjectsCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // auth()->user()->authorizeRoles(['Administrador','Secretaria']);
        $s = Subject::where([
            'name' => $request->nombre
        ])->get();

        if(count($s)>0){
            return back()->with('delete', '<strong>La materia '.$request->nombre.' ya existe.</strong>');
        }else{
             $newSubject = Subject::create([
             'name'   => $request->nombre,
             'active' => $request->active
        ]);
        return redirect()->route('subjects.index')->with('success', '<strong>La materia '.$request->nombre.' ha sido guardada correctamente.</strong>');
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
        $subject= Subject::where('id',$id)->first();
        return view('subjects.edit', compact('subject'));
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
        Subject::where('id',$id)
        ->update([
            'name' =>$request->name,
            'active' =>$request->state,

        ]);
        return redirect()->route('subjects.index')->with('edit','Registro Editado Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        auth()->user()->authorizeRoles(['Administrador','Secretaria']);
       $materia=Subject::find($id);
       $relatedYears=DB::table('degree_subject_year as year')
       ->join('subjects as sub','year.subject_id','=','sub.id')
       ->where('sub.id','=',$id)
       ->get();
       if(count($relatedYears)>=1)
            return back()->with('delete', '<strong>No se puede eliminar la materia '.$materia->name.' porque pertenece a uno o más años escolares</strong>');
       else
            Subject::destroy($id);
            return back()->with('success', '<strong>La materia '.$materia->name.' ha sido eliminada correctamente</strong>');

    }

    public function changeStatusSubject(Request $request, $id){
        auth()->user()->authorizeRoles(['Administrador','Secretaria']);
        $backSubject=Subject::find($id);
        $valorCambio=1;
        if($backSubject->active==0){
            $valorCambio=1;
        }
        else{
            $queryYearActive=DB::table('school_years')
            ->select(['id'])
            ->where('id','=',1)
            ->get();            
            $query=DB::select("select count(school_year_id) as conteo from degree_subject_year where school_year_id= ? and subject_id=?",[$queryYearActive[0]->id,$backSubject->id]);
            if($query[0]->conteo>0){
                $valorCambio=$backSubject->active;
            }
            else{
                $valorCambio=0;
            }

        }
        if($valorCambio!=$backSubject->active){
            Subject::where('id',$id)->update(['active'=>$valorCambio]);
            return redirect()->route('subjects.index')->with('edit','<strong>La materia '.$backSubject->name.' ha sido modificada correctamente</strong>');
        }
        else{
            return redirect()->route('subjects.index')->with('edit','<strong>La materia '.$backSubject->name.' no puede ser desactivada</strong>');            
        }
    }
}
