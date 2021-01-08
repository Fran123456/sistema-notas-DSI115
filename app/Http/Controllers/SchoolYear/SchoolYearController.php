<?php

namespace App\Http\Controllers\SchoolYear;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SchoolYear;
use App\Degree;
use App\User;
use App\DegreeSchoolYear;
use App\DegreeSchoolSubject;
use App\SchoolPeriod;
use App\ScoreStudent;
use App\Student;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use SebastianBergmann\Diff\Diff;
use Superglobals;
use Illuminate\Support\Facades\DB;
use App\StudentHistory;
use App\Subject;
use Carbon\Carbon;
use Sabberworm\CSS\Value\Size;

class SchoolYearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        auth()->user()->authorizeRoles(['Administrador','Secretaria']);
        $years = SchoolYear::orderBy('year','asc')->get();
       return view('schoolYear.schoolYears', compact('years'));
    }

    public function finish($id){
      auth()->user()->authorizeRoles(['Administrador']);
      $year = SchoolYear::find($id);
      $periods = SchoolPeriod::where('school_year_id', $id)->get();
      $periods2 = SchoolPeriod::where('school_year_id', $id)->where('finish', false)->get();

      return view('schoolYear.finish.finish', compact('year','periods','periods2'));
    }

    public function finishProcess($year){

      auth()->user()->authorizeRoles(['Administrador']);
      $yearx = SchoolYear::find($year);
      //actualizar el periodo para que ya no este activo//
      $s = SchoolYear::where('id', $year)->update([
        'finish'=>true,
        'active'=>false
      ]);  //actualizar el periodo para que ya no este activo//
      $nextYear=SchoolYear::where('year','>',$yearx->year)->get();

      //Validamos si existe un año creado diferente para poder cerrar
      if(count($nextYear)==0){
        return redirect()->back()->with('delete','<strong> Debe crear un año para proceder al cierre del '.$yearx->year.'</strong>');
      }else{
        $ss = SchoolYear::where('id', $nextYear[0]->id)->update([
          'active'=>true
        ]);
      }

      $periods = SchoolPeriod::where('school_year_id',$year)->get();

      $students= Student::all();
      $subjects= Subject::all();

      $aprobados=[];
      $reprobados=[];


      foreach($students as $student){

        $flag=0; //bandera para controlar si es aprobado o reprobado
        $scores=[];//para almacenar los promedios finales de todas las notas, tendrá 7 elementos por ser 7 materias

        foreach($subjects as $subject){// por cada materia
          $notasPeriodo=[];//para guardar las notas del periodo
          foreach($periods as $period){// revisaremos cada periodo            
            //Consultamos todas las notas del estudiante
            $query=DB::table('score_students')
                    ->join('score_type','score_type.id','=','score_students.score_type_id')
                    ->where('score_students.school_year_id','=',$year)
                    ->where('score_students.school_period_id','=',$period->id)
                    ->where('score_students.subject_id','=',$subject->id)
                    ->where('score_students.student_id','=',$student->id)
                    ->select('*')
                    ->get();

            $suma = 0;//para ir sumando la nota del periodo de la materia ocupamos el foreach
            foreach($query as $comprobacion){
              $suma += ($comprobacion->score * ($comprobacion->percentage/100));
            }
            array_push($notasPeriodo,$suma);//lo guardamos
          }          
          $sumaMateria=0;//para sacar la nota final de la materia, igual con foreach
          //dd($notasPeriodo);
          foreach($notasPeriodo as $score){
            $sumaMateria += ($score/sizeof($notasPeriodo));
          }

          array_push($scores,$sumaMateria);//lo guardamos en el array de notas finales          
        }        
        //dd($notasPeriodo,$scores);
        //Analizaremos las notas para saber si dejó una materia
        foreach($scores as $score){
          if($score < 6.00 ){
            $flag=1;//modificamos el valor de la bandera
          }
        }

        if($flag==1){//si el valor de flag es 1 lo guardamos en el array de reprobados
          array_push($reprobados,$student);
        }
        else{
          array_push($aprobados,$student);//si el valor es 0 se guarda en aprobados
        }
      }

      /*
      En http://localhost/sistema-notas-DSI115/public/students se visualizará estado = en espera
      debido a que así fue controlado en la vista:
          @if ($value->status =="AI")
          Antiguo Ingreso
          @elseif($value->status =="NI")
          Nuevo Ingreso
          @elseif ($value->status =="EG")
          Egresado
          @elseif ($value->status =="AB")
          Abandonó
          @else
          En espera
          @endif
      */
      //Actualizaremos el status para los aprobados
      foreach($aprobados as $aprobado){

        Student::where('id','=',$aprobado->id)->update([
          'status' => 'AIA', //AIA = Antiguo Ingreso Aprobado
        ]);
              
      }
      
      //Actualizaremos el estado de los aprobados del grado más alto a egresado
      $maxDegree=DB::table('degrees')->max('degree');
      DB::table('students_history')
          ->join('degrees','degrees.id','=','students_history.degree_id')
          ->join('students','students_history.student_id','=','students.id')
          ->where('students.status','=','AIA')
          ->where('degrees.degree','=',$maxDegree)
          ->update([
            'students.status' => 'EG', //EG = egresado
          ]);

      

      //Actualizaremos el status para los reprobados
      foreach($reprobados as $reprobado){
        Student::where('id','=',$reprobado->id)->update([
          'status' => 'AIR', //AIR = Antiguo Ingreso Reprobado
        ]);
      }



      return redirect()->route('years.index')->with('success','Año escolar '.$yearx->year .' cerrado satisfactoriamente');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      auth()->user()->authorizeRoles(['Administrador']);
      return view('schoolYear.schoolYearCreate');
    }


    /*CREATE A REGISTRY (YEAR) FOR A TEACHER AND GRADE*/
    public function createYearTeacher($id){
      auth()->user()->authorizeRoles(['Administrador','Secretaria']);
      $year = SchoolYear::find($id);
  //    $degrees = Degree::where('active', true)->orderBy('turn')->get();
       //$degrees = SchoolYear::where('active', true)->first();
       //return $degrees->degrees;
       //$GLOBALS["yearid"] = $id;

       $degrees = Degree::whereDoesntHave('shoolYear', function(Builder $query) use($year)  {
         $query->where('school_year_id', $year->id );
       })
      ->where('active', true)->orderBy('turn')
      ->get();


       $teachers = User::where('role_id', 2)->get();
       $degreesTeacher = SchoolYear::where('active', true)->first();

       $materiasAnex = array();
       $studentAnex = array();

       foreach ($degreesTeacher->degrees as $key => $value) {
        $aux = DegreeSchoolSubject::where('school_year_id', $value->pivot->school_year_id)
        ->where('degree_id', $value->id)->get();

        $studentCount =StudentHistory::where('school_year_id',$value->pivot->school_year_id)
        ->where('degree_id',$value->id)->get();

        array_push($materiasAnex, count($aux));
          array_push($studentAnex, count($studentCount));
       }

       //return $degreesTeacher->degrees[0]->pivot->capacity;
      //return count($degreesTeacher->degrees);



       return view('schoolYear.schoolYearTeacherCreate',compact('degrees','materiasAnex','teachers','year','degreesTeacher','studentAnex'));
    }
    /*CREATE A REGISTRY (YEAR) FOR A TEACHER AND GRADE*/

    /*STORE A REGISTRY (YEAR) FOR A TEACHER AND GRADE*/
    public function storeYearTeacher(Request $request){
      auth()->user()->authorizeRoles(['Administrador','Secretaria']);
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
      auth()->user()->authorizeRoles(['Administrador']);
      
       $validate = SchoolYear::where('year', $request->year)->get();
       if(count($validate)>0){
         return back()->with('delete', "No se puede agregar el año escolar porque ya existe un registro con el mismo año")
         ->withInput();
       }

      $startYear=Carbon::create($request->year,1,1);
      $endYear=Carbon::create($request->year,12,31);
      $startDate= Carbon::create($request->start_date);
      $endDate= Carbon::create($request->end_date);
      
      if(!($startDate->between($startYear,$endYear))){
        return back()->with('delete', "La fecha de inicio ingresada no correponde con el año introducida.")->withInput();
      }
      if(!($endDate->between($startYear,$endYear))){
        return back()->with('delete', "La fecha de finalización ingresada no correponde con el año introducida.")->withInput();
      }
      if($startDate->greaterThanOrEqualTo($endDate)){
        return back()->with('delete', "La fecha de inicio es igual o mayor a la fecha de finalización ingresada.")->withInput();
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
      auth()->user()->authorizeRoles(['Administrador','Secretaria']);
      $backSchoolYear=SchoolYear::find($id);
      SchoolYear::destroy($id);
      return redirect()->route('years.index')->with('success','<strong>El año escolar '.$backSchoolYear->year.' fue eliminado correctamente</strong>');
    }

    public function changeStatusSchoolYear(Request $request, $id){
      auth()->user()->authorizeRoles(['Administrador']);
      $backSchoolYear=SchoolYear::find($id);
      SchoolYear::where('active',1)->update(['active'=>0]);
      SchoolYear::where('id',$id)->update(['active'=>1]);
      return redirect()->route('years.index')->with('edit','<strong>El año escolar '.$backSchoolYear->year.' ha sido activado correctamente</strong>');
    }
    public function editYear_grade($id_year_grade)
    {
      auth()->user()->authorizeRoles(['Administrador','Secretaria']);
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
      auth()->user()->authorizeRoles(['Administrador','Secretaria']);
       $aux = DegreeSchoolYear::find($id_year_grade);
        DegreeSchoolYear::where('id',$id_year_grade)->update([
            'user_id' =>$request->teacher,
            'degree_id' =>$request->degree,

            'capacity' =>$request->capacity,
        ]);

        DegreeSchoolSubject::where('degree_id', $aux->degree_id)
        ->where('school_year_id',$aux->school_year_id)
        ->update([
          'degree_id' => $request->degree
        ]);

        return redirect()->route('teacher-grade',$request->school_year_id)->with('success','Registro Modificado Correctamente');
    }

    public function deletingSchoolYear(Request $request, $id){
      auth()->user()->authorizeRoles(['Administrador']);
      $backSchoolYear=SchoolYear::find($id);
      if($backSchoolYear->active){
        return redirect()->route('years.index')->with('delete',' <strong> No es posible eliminar un año activo </strong>');
      }

      $querySchoolYear=DB::select("SELECT degrees.id, degrees.degree, degrees.section, degrees.turn, users.name, degree_school_year.capacity from ((users inner join degree_school_year on users.id = degree_school_year.user_id) inner join degrees on degrees.id = degree_school_year.degree_id) where degree_school_year.school_year_id = ?",[$id]);
      $sizeQuerySchoolYear=sizeof($querySchoolYear);

      $querySubjectYear=DB::select("SELECT subjects.name as subjectName, users.name, degree_subject_year.degree_id, degree_subject_year.subject_id from (((users inner join degree_subject_year on users.id = degree_subject_year.user_id) inner join degrees on degrees.id = degree_subject_year.degree_id) inner join subjects on subjects.id = degree_subject_year.subject_id) where degree_subject_year.school_year_id = ?",[$id]);
      $sizeQuerySubjectYear=sizeof($querySubjectYear);

      return view('schoolYear.schoolYearDeleting', compact('querySchoolYear','querySubjectYear','backSchoolYear','sizeQuerySchoolYear','sizeQuerySubjectYear'));
    }
}
