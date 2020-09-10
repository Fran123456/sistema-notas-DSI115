<?php

namespace App\Http\Controllers\SchoolYear;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SchoolYear;
use App\Degree;
use App\User;
use App\DegreeSchoolYear;
use App\DegreeSchoolSubject;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use SebastianBergmann\Diff\Diff;
use Superglobals;
use Illuminate\Support\Facades\DB;
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

       $materiasAnex = array();

       foreach ($degreesTeacher->degrees as $key => $value) {
        $aux = DegreeSchoolSubject::where('school_year_id', $value->pivot->school_year_id)
        ->where('degree_id', $value->id)->get();
        array_push($materiasAnex, count($aux));
       }

       //return $degreesTeacher->degrees[0]->pivot->capacity;
      //return count($degreesTeacher->degrees);

       return view('schoolYear.schoolYearTeacherCreate',compact('degrees','materiasAnex','teachers','year','degreesTeacher'));
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
      $backSchoolYear=SchoolYear::find($id);
      SchoolYear::destroy($id);      
      return redirect()->route('years.index')->with('success','<strong>El año escolar '.$backSchoolYear->year.' fue eliminado correctamente</strong>');
    }

    public function changeStatusSchoolYear(Request $request, $id){
      $request->user()->authorizeRoles(['administrador']);
      $backSchoolYear=SchoolYear::find($id);
      SchoolYear::where('active',1)->update(['active'=>0]);
      SchoolYear::where('id',$id)->update(['active'=>1]);
      return redirect()->route('years.index')->with('edit','<strong>El año escolar '.$backSchoolYear->year.' ha sido activado correctamente</strong>');
    }
    public function editYear_grade($id_year_grade)
    {

       //id año-grado
        $year_grade= DegreeSchoolYear::find($id_year_grade);

        //grado seleccionado
        $degreeSelected= Degree::find($year_grade->degree_id);

        //año escolar
        $year= SchoolYear::find($year_grade->school_year_id);

        //grados disponobles
        $availableDegrees = Degree::whereDoesntHave('shoolYear')
                  ->where('active', true)->orderBy('turn')
                  ->get();

        //docentes
        $teachers= User::join('role_user','role_user.user_id','users.id')
        ->select('users.name','users.id')
        ->where('role_user.role_id','=','2')->get();

       return view('schoolYear.grade.edit', compact('year_grade','degreeSelected','year','availableDegrees','teachers'));
    }
    public function save_editYear_grade(Request $request, $id_year_grade)
    {
        DegreeSchoolYear::where('id',$id_year_grade)->update([
            'user_id' =>$request->teacher,
            'degree_id' =>$request->degree,

            'capacity' =>$request->capacity,
        ]);
        return redirect()->route('teacher-grade',$request->school_year_id)->with('success','Registro Modificado Correctamente');
    }

    public function deletingSchoolYear(Request $request, $id){
      
      $backSchoolYear=SchoolYear::find($id);      
      if($backSchoolYear->active){
        return redirect()->route('years.index')->with('delete',' <strong> No es posible eliminar un año activo </strong>');
      }
      
      $querySchoolYear=DB::select("SELECT degrees.degree, degrees.section, degrees.turn, users.name, degree_school_year.capacity from ((users inner join degree_school_year on users.id = degree_school_year.user_id) inner join degrees on degrees.id = degree_school_year.degree_id) where degree_school_year.school_year_id = ?",[$id]);      
      $sizeQuerySchoolYear=sizeof($querySchoolYear);
      $querySubjectYear=DB::select("SELECT subjects.name as subjectName, degrees.degree, degrees.section, degrees.turn, users.name from (((users inner join degree_subject_year on users.id = degree_subject_year.user_id) inner join degrees on degrees.id = degree_subject_year.degree_id) inner join subjects on subjects.id = degree_subject_year.subject_id) where degree_subject_year.school_year_id = ?",[$id]);      
      $sizeQuerySubjectYear=sizeof($querySubjectYear);

      return view('schoolYear.schoolYearDeleting', compact('querySchoolYear','querySubjectYear','backSchoolYear','sizeQuerySchoolYear','sizeQuerySubjectYear'));
    }
}
