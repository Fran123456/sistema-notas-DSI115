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
        <li class="breadcrumb-item active" aria-current="page">Alumnos</li>
      </ol>
    </nav>
  </div>
</div>

<div class="row ">
    <div class="col-md-12 col-sm-12 col-xs-12 text-right">
       <a class="btn btn-info mb-1" href="{!! route('addStudent') !!}"><i class="fa fa-plus" aria-hidden="true"></i></a>
    </div>
</div>


<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
        <strong class="card-title">Alumnos</strong>
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
                  <th width="40" scope="col"> Editar </th>
                  <th width="40" scope="col"> Eliminar </th>
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
                        <a href="{{route('students.edit', $value->id)}}" class="btn btn-warning"><i class="fa fa-edit" aria-hidden="true"></i></a>
                     </td>
                     <td><button class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
                  </tr>
                @endforeach
            </tbody>
          </table>
      </div>
    </div>
  </div>
</div>

@endsection
