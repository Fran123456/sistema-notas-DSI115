<?php

namespace App\Http\Controllers\Subject;

use App\Http\Controllers\Controller;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        //
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
        //
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
        //
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
        //
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

    public function changeStatusSubject(Request $request, $id){
      //  $request->user()->authorizeRoles(['administrador']);
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
            $query=DB::select("select count(degree_school_year_id) as conteo from degree_subject_year where degree_school_year_id= ? and subject_id=?",[$queryYearActive[0]->id,$backSubject->id]);
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
            //Porque tiene una relación con el año activo
        }
    }
}
