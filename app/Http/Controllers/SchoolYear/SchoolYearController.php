<?php

namespace App\Http\Controllers\SchoolYear;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SchoolYear;
use App\Degree;
use App\User;
use App\DegreeSchoolYear;
use Illuminate\Database\Eloquent\Builder;
use Superglobals;
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
    public function createYearTeacher($id){
      $year = SchoolYear::find($id);
      $degrees = Degree::where('active', true)->orderBy('turn')->get();
       //$degrees = SchoolYear::where('active', true)->first();
       //return $degrees->degrees;
       //$GLOBALS["yearid"] = $id;

       /*$degrees = Degree::whereDoesntHave('shoolYear', function(Builder $query) use($year)  {
         $query->where('school_year_id', $year->id );
       })
      ->where('active', true)->orderBy('turn')
      ->get();*/

       $teachers = User::where('role_id', 2)->get();
       $degreesTeacher = SchoolYear::where('active', true)->first();

       //return $degreesTeacher->degrees[0]->pivot->capacity;
      //return count($degreesTeacher->degrees);

       return view('schoolYear.schoolYearTeacherCreate',compact('degrees','teachers','year','degreesTeacher'));
    }
    /*CREATE A REGISTRY (YEAR) FOR A TEACHER AND GRADE*/

    /*STORE A REGISTRY (YEAR) FOR A TEACHER AND GRADE*/
    public function storeYearTeacher(Request $request){
       $year = DegreeSchoolYear::create($request->all());
       return back()->with('success', 'Grado asignado correctamente al año escolar actual');
    }
    /*STORE A REGISTRY (YEAR) FOR A TEACHER AND GRADE*/


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

    public function changeStatusSchoolYear(Request $request, $id){
      $request->user()->authorizeRoles(['administrador']);
      $backSchoolYear=SchoolYear::find($id);
      SchoolYear::where('active',1)->update(['active'=>0]);
      SchoolYear::where('id',$id)->update(['active'=>1]);
      return redirect()->route('years.index')->with('edit','<strong>El año escolar '.$backSchoolYear->year.' ha sido activado correctamente</strong>');
    }
}
