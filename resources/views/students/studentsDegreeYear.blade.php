@extends('layouts.app')
@section('content')

@include('alerts.dataTable')

<div class="row">
  @include('alerts.alerts')
</div>
dsds
<div class="row">
  <div class="col-md-12">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('years.index') }}">Años escolares</a></li>
        <li class="breadcrumb-item"><a href="{{ route('teacher-grade',$schoolYear->id) }}">Crear grado, docente para año escolar</a></li>
        <li class="breadcrumb-item active" aria-current="page">Estudiantes</li>
      </ol>
    </nav>
  </div>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
        <strong class="card-title">Alumnos {{Help::ordinal($degree->degree)}} {{$degree->section}} - Año {{$schoolYear->year}}</strong>
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
                  <th scope="col">Teléfono</th>
                  <th scope="col">Encargado</th>
                  <th scope="col">Estado</th>
                  <th width="40" scope="col"> Eliminar </th>
                  <th width="40" scope="col">Asistencias </th>
                </tr>
              </thead>
              <tbody>
                 @foreach ($students as $key => $value)
                  <tr>
                    <th scope="row">{{$key+1}}</th>
                     <td>
                        {{$value->lastname}}
                     </td>
                     <td>{{$value->name}}</td>
                     <td>{{$value->age}}</td>
                     <td>{{Help::getGender($value->gender)}}</td>
                     <td>{{$value->phone}}</td>
                     <td>{{$value->parent_name}}</td>
                     <td>
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
                     </td>
                     <td>
                     @if (Auth::user()->roles()->first()->name =="Administrador")
                        <form method="POST" action="{{route('studenthistories.destroy', $value->id) }}">
                           @csrf
                           <input type="hidden" name="_method" value="delete" />
                           <button class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </form>
                     @else
                     <button class="btn btn-danger" disabled=""><i class="fa fa-trash" aria-hidden="true"></i></button>
                     @endif
                     </td>
                     <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#periodos-{{$value->id}}">
                            <i class="fa fa-download"></i>
                          </button>
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
@include('students.modal.periodo')
