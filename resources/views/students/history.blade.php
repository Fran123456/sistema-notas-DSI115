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
        <div class="card-header"><strong>Historial del alumno</strong></div>


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
                <th>Estado</th>
              </tr>
              </thead>
              <tr>              
                <td>{{$student->name}}</td>
                <td>{{$student->lastname}}</td>
                <td>{{$student->age}}</td>
                <td>{{Help::getGender($student->gender)}}</td>
                <td>
                @if ($student->status =="AI")
                    Antiguo Ingreso
                @elseif($student->status =="NI")
                    Nuevo Ingreso
                @elseif ($student->status =="EG")
                    Egresado
                @elseif ($student->status =="AB")
                    Abandonó
                @else
                    En espera
                @endif
                </td>
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
                      @foreach ($years as $key2 => $value2)
                        @if ($value->school_year_id == $value2->id)
                          {{$value2->year}}
                        @endif
                      @endforeach
                    </th>
                  </tr>
                  <tr>
                    <th class="center">Grado</th>
                    <th class="center">Estado</th>            
                  </tr>
                </thead>
              
                  <tr>
                    <td>
                     @foreach ($degrees as $key3 => $value3)
                      @if ($value->degree_id == $value3->id)        
                        {{Help::ordinal($value3->degree)}}
                      @endif
                    @endforeach
                    </td>
                  <td>
                    <!--A editar-->   
                    Aprobado
                    </td>
                  </tr>
              </tbody>
              </table>
            </div>
          </div>
        
        @endforeach          
        
          </div>
        </div>
      </div>
    </div>

  </form>
@endsection
