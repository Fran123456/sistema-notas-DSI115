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
      <li class="breadcrumb-item active" aria-current="page">Estudiantes grado {{Help::ordinal($degree->degree)}} {{$degree->section}}</li>
      </ol>
    </nav>
  </div>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
        <strong class="card-title">Alumnos {{Help::ordinal($degree->degree)}} {{$degree->section}} - Año {{$schoolYear->year}} <br/> Docente: {{$teacher->name}}</strong>

      </div>
        <div class="card-body">
            <table class="table" id="bootstrap-data-table_length">
              <thead>
                <tr>
                  <th width="30" scope="col">#</th>
                  <th scope="col">Apellidos</th>
                  <th scope="col">Nombres</th>
                  <th scope="col">Edad</th>
                  <th scope="col">Género</th>
                <!--  <th scope="col">Teléfono</th>
                  <th scope="col">Encargado</th>-->
                  <!--<th scope="col">Estado</th>-->
                  <th scope="col">Periodo 1</th>
                </tr>
              </thead>
              <tbody>
                @php
                  $y = Help::getSchoolYear();
                @endphp
                 @foreach ($students as $key => $value)
                  <tr>
                    <th scope="row">{{$key+1}}</th>
                     <td>
                        {{$value->lastname}}
                     </td>
                     <td>{{$value->name}}</td>
                     <td>{{$value->age}}</td>
                     <td>{{Help::getGender($value->gender)}}</td>
                    <!--  <td>{{$value->phone}}</td>
                     <td>{{$value->parent_name}}</td>-->
                    <!-- <td>
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
                    </td>-->
                     <td>
                       <form action="{{route('getScoresTypeByStudent')}}" method="get" enctype="multipart/form-data">
                          <input hidden value="{{$y->id}}" name="year">
                          <input hidden value="{{$degree->id}}" name="degree">
                          <input hidden value="0" name="look">
                          <input hidden value="{{$value->id}}" name="student">
                          <button type="submit" class="btn btn-warning"><i class="fa fa-edit" aria-hidden="true"></i></button>
                       </form>
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
