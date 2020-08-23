<?php

namespace App\Http\Controllers\SchoolYear;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SchoolYear;
use App\Degree;
use App\User;
use App\DegreeShoolYear;
class SchoolYearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $years = SchoolYear::orderBy('year','asc')->get();

        return view('schoolYear.schoolYears', compact('years'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('schoolYear.schoolYearCreate');
    }


    /*CREATE A REGISTRY (YEAR) FOR A TEACHER AND GRADE*/
    public function createYearTeacher(){
       $degrees = Degree::where('active', true)->orderBy('turn')->get();
       $teachers = User::where('role_id', 2)->get();
       return view('schoolYear.schoolYearTeacherCreate',compact('degrees','teachers'));
    }
    /*CREATE A REGISTRY (YEAR) FOR A TEACHER AND GRADE*/

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       $validate = SchoolYear::where('year', $request->year)->get();
       if(count($validate)>0){
         return back()->with('delete', "No se puede agregar el año escolar porque ya existe un registro con el mismo año")
         ->withInput();
       }

       if($request->active == 1){
         SchoolYear::where('active', true)->update([
           'active' =>false
         ]);
       }
       $year = SchoolYear::create($request->all());
       // SchoolYear::find($year->id)->degrees()->save($year, ['user_id' => $request->user_id , 'capacity' =>  $request->capacity]);
       return redirect()->route('years.index')->with('success','<strong>Año escolar creado correctamente</strong>');
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
}
