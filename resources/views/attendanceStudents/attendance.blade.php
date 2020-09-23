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

<!--BREADCUMB-->
<div class="row">
  <div class="col-md-12">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('gradesTeacher',Auth::user()->id) }}">Administración de docente - Año escolar {{Help::getSchoolYear()->year}}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('attendancesDates', $degree->id) }}">Asistencias Grado {{Help::ordinal($degree->degree)}} {{$degree->section}} - {{Help::turn($degree->turn)}}</a></li>
        <li class="breadcrumb-item active" aria-current="page">Asistencia fecha: {{$attendanceDate}} </li>
      </ol>
    </nav>
  </div>
</div>

<!--BODY-->
<div class="card">
    <div class="col-sm-12">
        <div class="card-body">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Fecha</strong></td>

                                <td> {{$attendanceDate}}</td>

                            </tr>
                        </table>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover" id="bootstrap-data-table_length">
                            <thead>
                                <tr>
                                <th width="50" scope="col">#</th>
                                <th width="150" scope="col">Nombre</th>
                                <th width="150" scope="col">Apellido</th>
                                <th width="150" scope="col">Registro</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($attendance as $key => $value)

                                    <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$value->name}}</td>
                                    <td>{{$value->lastname}}</td>
                                    <td>

                                        @if ($value->active==0)
                                            NO ASISTIO
                                        @else
                                            @if ($value->active==1)
                                                ASISTIO
                                            @else
                                                FALTA CON PERMISO
                                            @endif

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
    </div>
</div><!--BODY-->
@endsection
