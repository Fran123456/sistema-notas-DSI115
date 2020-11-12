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
      <li class="breadcrumb-item active" aria-current="page">Materias asociadas al grado {{Help::ordinal($degree->degree)}} {{$degree->section}}</li>
      </ol>
    </nav>
  </div>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
        <strong class="card-title">Materias para el grado {{Help::ordinal($degree->degree)}} {{$degree->section}} - Año {{$schoolYear->year}} <br/> Docente encargado de grado: {{$teacher->name}}</strong>

      </div>
        <div class="card-body">
            <table class="table" id="bootstrap-data-table_length">
              <thead>
                <tr>
                  <th width="30" scope="col">#</th>
                  <th scope="col">Materia</th>
                  <th scope="col">Notas <br>periodo 1</th>
                  <th scope="col">Notas <br>periodo 2</th>
                  <th scope="col">Notas <br>periodo 3</th>
                </tr>
              </thead>
              <tbody>
                 @foreach ($subjects as $key => $value)
                  <tr>
                    <th scope="row">{{$key+1}}</th>
                     <td>
                        {{$value->name}}
                     </td>
                     <td>
                     @if (Help::validatePeriod(1))
                        <a href="{{route('showStudentScoreBySubject',[Auth::user()->id,$value->id,1])}}" class="btn btn-success"><i class="fa fa-edit" aria-hidden="true"></i></a>
                     @else
                        <i class="fa fa-times" aria-hidden="true"></i>
                     @endif
                     </td>
                     <td>
                     @if (Help::validatePeriod(2))
                        <a href="{{route('showStudentScoreBySubject',[Auth::user()->id,$value->id,2])}}" class="btn btn-info"><i class="fa fa-edit" aria-hidden="true"></i></a>
                     @else
                        <i class="fa fa-times" aria-hidden="true"></i>
                     @endif
                     </td>
                     <td>
                     @if (Help::validatePeriod(3))
                        <a href="{{route('showStudentScoreBySubject',[Auth::user()->id,$value->id,3])}}" class="btn btn-secondary"><i class="fa fa-edit" aria-hidden="true"></i></a>
                     @else
                        <i class="fa fa-times" aria-hidden="true"></i>
                     @endif
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
