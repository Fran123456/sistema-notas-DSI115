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
        <li class="breadcrumb-item"><a href="{{ route('gradesTeacher',Auth::user()->id) }}">Administración de docente - Año escolar {{Help::getSchoolYear()->year}}</a></li>
        <li class="breadcrumb-item active" aria-current="page">Asistencias Grado {{Help::ordinal($degree->degree)}} {{$degree->section}} - {{Help::turn($degree->turn)}} </li>
      </ol>
    </nav>
  </div>
</div>
<small>*Se tomará la fecha de sistema para el registro de asistencia diaria</small>
<div class="row">
    
                      <div class="col-sm-12">

                      <!--col-lg 3 col-md-3 col-sm-12 col-xs-12-->
                        <div class="card-body">

                          <!--<div class="card" style="width: auto;">-->
                          <div class="card">

                            <div class="card-body">
                                @php
                                    $bandera=0;
                                foreach ($attendanceDates as $value) {
                                    if ($value->degree_id == $degree->id ) {
                                        if ($value->attendance_date == $now) {
                                            $bandera=1;
                                            }
                                    }
                                }
                                @endphp
                               @if ($bandera==1)

                               <button  class="btn btn-danger" disabled>Tomar Asistencia <i class="fa fa-ban"></i></button>
                               @else
                               <a href="{{route('attendanceRecord',$degree->id)}}" class="btn btn-success">Tomar Asistencia</a>
                               @endif
                                <a href="" class="btn btn-primary">Historial de Registros</a>

                              <!--<h5 class="card-title">-->
                                <div class="table-responsive">
                                  <table class="table table-borderless">
                                    <tr>
                                      <td><strong>Grado</strong></td>

                                      <td> {{Help::ordinal($degree->degree)}} {{$degree->section}} - {{Help::turn($degree->turn)}}</td>

                                    </tr>
                                  </table>
                                </div>
                              <!--</h5>-->
                                <div class="table-responsive">
                                  <table class="table" table-hover" id="bootstrap-data-table_length">
                                    <thead>
                                      <tr>
                                        <th width="150" scope="col">Fecha</th>
                                        <th width="150" scope="col">Asistencia</th>
                                        <th width="150" scope="col">Ver</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($attendanceDates as $key => $value)
                                        @if($value->degree_id == $degree->id )
                                          <tr>
                                            <td>{{$value->attendance_date}}</td>
                                            <td>{{$value->asistencia}}</td>                                            
                                            <!-- IMPORTANTE-->
                                            <td>
                                              <a href="{{ route('showAttendance',[$value->degree_id,$value->attendance_date])}}" class="btn btn-info"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            </td>
                                          <!--Cerrado IMPORTANTE -->
                                          </tr>
                                        @endif
                                      @endforeach
                                    </tbody>
                                  </table>
                                </div>
                            </div>
                          </div>
                        </div>
                      </div>

    
</div>


@endsection
