@extends('layouts.app')
@section('content')

@include('alerts.dataTable')

<div class="row">
  @include('alerts.alerts')
</div>

<div class="row">
  <div class="col-md-12">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route('gradesTeacher',$teacher->id) }}">Administración de docente - Año escolar {{Help::getSchoolYear()->year}}</a></li>
      <li class="breadcrumb-item"><a href="{{ route ('showSubjectsByDegree',[$teacher->id,$degree->id])}}"> Materias asociadas al grado {{Help::ordinal($degree->degree)}} {{$degree->section}}</a></li>
      <li class="breadcrumb-item active" aria-current="page">Notas {{$subject->name}} - periodo {{$period->nperiodo}}</li>
      </ol>
    </nav>
  </div>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
        <strong class="card-title">Notas de la asignatura {{$subject->name}} para el grado {{Help::ordinal($degree->degree)}} {{$degree->section}} - Año {{$schoolYear->year}} - Periodo {{$period->nperiodo}}<br/>Docente: {{$teacher->name}}</strong>
      </div>
        <div class="card-body"> 
        <form method="get" action="{{ route('updateScoresBySubject') }}" enctype="multipart/form-data">
        <input type="text" value="" id="student" name="student" hidden>
        <input type="hidden" value="{{$subject->id}}" name="subject">
        <input type="hidden" value="{{$degree->id}}" name="degree">
        <input type="hidden" value="{{$period->id}}" name="period">
        <table class="table text-center table-sm table-bordered" id="bootstrap-data-table_length">
          <thead style="background-color:lightblue;color:blue;">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nombre del estudiante</th>
              @foreach ($scoreTypes as $type)
              <th>
                {{$type->activity}}<br/> ({{$type->percentage}})%
              </th>
              @endforeach
              <th scope="col">Guardar cambios</th>
              <th scope="col">Nota final</th>
            </tr>
          </thead>
          <tbody style="background-color:lightgray;">
            @foreach ($students as $key => $value)
              @php
              $notafinal = 0;
              @endphp                
              <tr>
                <th scope="row">{{$key+1}}</th>
                <td>{{$value->name}} {{$value->lastname}}</td>
                  @foreach ($scoreTypes as $type)
                    @foreach ($scores as $score)  
                      @if ($score->student_id==$value->idStudent and $score->score_type_id==$type->id)
                        <td>
                          <input type="number" style="background-color:gray;color:white" class="form-control" min="0.00" max="10.00" step="0.01" value="{{number_format($score->score,2)}}" name="{{$score->id}}">
                        </td> 
                        @php
                        $notafinal = ($score->score * ($type->percentage/100)  )  + $notafinal;
                        @endphp
                      @endif
                    @endforeach                                   
                  @endforeach                    
                <td>
                    <button onclick="asignarEstudiante({{$value->idStudent}})" data-toggle="tooltip" data-placement="top" title="Guardar" class="btn btn-light"><i class="fa fa-save" aria-hidden="true"></i></button>
                </td>
                <td>{{number_format($notafinal,2)}}</td>   
              </tr>
            @endforeach
          </tbody>
        </table>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
function asignarEstudiante(idStudent){
  var studentInput = document.getElementById("student");
  studentInput.value = idStudent;
}
</script>
@endsection
