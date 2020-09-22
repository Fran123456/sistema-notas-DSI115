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
        <li class="breadcrumb-item active" aria-current="page">Administración de docente - Año escolar {{Help::getSchoolYear()->year}}</li>
      </ol>
    </nav>
  </div>
</div>





<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
        <strong class="card-title">Materias para el docente {{Auth::user()->name}} - 
          Año escolar {{Help::getSchoolYear()->year}}
        </strong>
      </div>
        <div class="card-body">
            <table class="table" id="bootstrap-data-table_length">
              <thead>
                <tr>
                  <th width="40" scope="col">#</th>
                  <th width="200" scope="col">Grado</th>
                  <th width="200" scope="col">Año</th>
                  <th scope="col">Capacidad</th>
                  <th scope="col">Inscritos</th>
                  <th scope="col">Asistencia</th>
                  <th width="60" scope="col">Tipos</th>
                  <th width="40" scope="col"> Editar </th>
                  <th width="40" scope="col"> Eliminar </th>
                </tr>
              </thead>
              <tbody>

                 @foreach ($data as $key => $value)

                 <!--Accede a el id el usuario
                  $value[0]->id de igual forma si cambia el id por name obtendra
                  el nombre del docente, los campos son los de la tabla user
                  asi que cualquier campo de ahi podra utilizarlo aqui.
                 -->
                  <tr>
                    <th scope="row">{{$key+1}}</th>
                     <td>{{Help::ordinal($value[1]->degree)}} {{$value[1]->section}}  {{Help::turn($value[1]->turn)}}</td>
                     <td>{{$value[2]['year']}}</td>
                     <td>{{$value[2]['capacity']}}</td>
                     <td>{{$value[2]['full']}}</td>
                     <td>
                      <a href="{{ route('attendancesDates',$value[1]['id']) }}" class="btn btn-info"><i class="fa fa-eye" aria-hidden="true"></i></a>
                     </td>
                     <td>
                         <a href="" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i></a>
                     </td>
                      <td>
                        <a href="" class="btn btn-warning"><i class="fa fa-edit" aria-hidden="true"></i></a>
                      </td>
                      <td>                      
                        <a href="" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
