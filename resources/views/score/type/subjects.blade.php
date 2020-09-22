@extends('layouts.app')
@section('content')
@include('alerts.dataTable')

<style media="screen">
.bg-success {
  background-color: #3ac47d52 !important;
}
</style>

<div class="row">
  @include('alerts.alerts')
</div>
<div class="row">
  <div class="col-md-12">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('gradesTeacher',$te->id) }}">
          Administración de docente - Año escolar {{Help::getSchoolYear()->year}}
        </a></li>
        <li class="breadcrumb-item active" aria-current="page">Materias</li>
      </ol>
    </nav>
  </div>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
        <strong class="card-title">Materias para el grado: {{Help::ordinal($grade->degree)}} 
          {{$grade->section}} - {{Help::turn($grade->turn)}} (ADMINISTRAR % TAREAS Y EVALUACIONES)</strong>
      </div>
        <div class="card-body">
            <table class="table" id="bootstrap-data-table_length">
              <thead>
                <tr>
                  <th width="40" scope="col">#</th>
                  <th width="200" scope="col">Materia</th>
                  <th width="200" scope="col">Docente</th>
                  <th width="40" scope="col">Año</th>
                  <th width="120" scope="col">Grado</th>
                  <th width="40" scope="col"> Asignar % </th>
                
                  
                </tr>
              </thead>
              <tbody>
                 @foreach ($grades as $key => $value)
                  <tr>
                    <th scope="row">{{$key+1}}</th>
                     <td>{{$value->subject->name}}</td>
                     <td>{{$value->docente->name}}</td>
                     <td>{{$value->school_year->year}}</td>
                     <td>{{Help::ordinal($value->degree->degree)}} {{$value->degree->section}} - {{Help::turn($value->degree->turn)}}
                     </td>
                     
                     <td>
                         <a href="{{ route('scorePercentage',[ $grade->id , $te->id ]) }}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i></a>
                     </td>

                     
                     

                  </tr>
                @endforeach
            </tbody>
          </table>
      </div>
    </div>
  </div>
</div>



@endsection
