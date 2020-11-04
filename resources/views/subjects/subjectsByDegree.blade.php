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
                  <th scope="col">Materias</th>
                  <th scope="col">Ver</th>
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
                        <a href=# class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i></a>                
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
