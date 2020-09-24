  @extends('layouts.app')
  @section('content')


  <div class="row">
    @include('alerts.alerts')
  </div>
  <style media="screen">
    .pa{
      padding-top: 35px;
    }
  </style>

  <div class="row">
    <div class="col-md-12">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('students.index') }}">Estudiantes</a></li>
          <li class="breadcrumb-item active" aria-current="page">Actividad del alumno</li>
        </ol>
      </nav>
    </div>
  </div>

  <form enctype="multipart/form-data">
  @csrf
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header"><strong>Escuela San Francisco Gotera de San Martín <br>Código: 99999</strong></div>
        <div class="card-header"><strong>Registro académico<br>Año escolar actual: {{$currentyear->year}}</strong></div>



        <div class="card-body card-block">
          <div class="row">
            <div class="col-md-12">
            
            <table class="table table-bordered" align="center">
            <tbody>
              <thead>
              <tr class="table-active">              
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Edad</th>
                <th>Género</th>
                <th>Tipo</th>
                <th>Estado</th>
              </tr>
              </thead>
              <tr>              
                <td>{{$student->name}}</td>
                <td>{{$student->lastname}}</td>
                <td>{{$student->age}}</td>
                <td>{{Help::getGender($student->gender)}}</td>
                <td>{{Help::typeOfStudent($student->status)}}</td>
                <td>Activo</td>
              </tr>     
            </tbody>
            </table>

            </div>     
          </div>

        @foreach ($studentrecord as $key => $value)
          <div class="row">
            <div class="col-md-12">
              <table class="table table-bordered" align="center">
              <tbody>
                <thead>
                  <tr>
                    @if ($value->status)
                      <th colspan="12" class="table-active" style="text-align:center; font-weight:bold; letter-spacing:1px;">ACTUALMENTE EN CURSO</th>
                    @endif 
                  </tr>            
                  <tr>
                    <th colspan="12" class="table-active" style="text-align:center; font-weight:bold; letter-spacing:6px;">
                      {{$value->year->year}}
                    </th>
                  </tr>
                  <tr>
                    <th class="center">Grado</th>
                    <th class="center">Sección</th>
                    <th class="center">Turno</th>
                    <th class="center">Docente encargado</th>
                    <th class="center">Estado</th>            
                  </tr>
                </thead>              
                  <tr>
                    <td>{{Help::ordinal($value->degree->degree)}}</td>
                    <td>{{$value->degree->section}}</td>  
                    <td>{{Help::turn($value->degree->turn)}}</td>
                    <td>{{$value->degreesy->teacher->name}}</td>            
                  
                    <td>
                    <!--A editar-->   
                    Aprobado
                    </td>
                  </tr>
                </tbody>
              </table> 

              @foreach($periods as $key2 => $value2)
                <table class="table table-bordered" align="center">
                  <tbody>
                    <thead>
                      <tr>
                        <th colspan="12" class="table-active" style="text-align:center; font-weight:bold; letter-spacing:1px;">{{Help::periods($value2->nperiodo)}}</th>
                      </tr>
                      <tr>
                        @foreach($value->degree->subjects as $key3 => $value3)
                        <th>{{$value3->name}}</th>
                        @endforeach
                        <th>Asistencia</th>
                        <th>Conducta</th>
                      </tr>
                    </thead>
                    <tr>
                     @foreach($value->degree->subjects as $key3 => $value3)
                        <th></th>
                      @endforeach
                      @if($value2->nperiodo == $value->attendancebyperiod->period_id)
                      <th>{{$value->attendancebyperiod->active}}</th>
                      @else
                      <th>N/A</th>
                      @endif
                      <th></th>
                    </tr>

                  </tbody>
                </table>
                @endforeach
            </div>
          </div>
        
        @endforeach          
        
          </div>
        </div>
      </div>
    </div>

  </form>
@endsection
