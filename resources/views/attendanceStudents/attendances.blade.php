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

<div class="row">

                      <div class="col-sm-12">

                      <!--col-lg 3 col-md-3 col-sm-12 col-xs-12-->
                      <p>*Se tomará la fecha de sistema para el registro de asistencia diaria</p>
                        <div class="card-body">
                            PERIODO EN CURSO DEL AÑO ESCOLAR: <strong> PERIODO {{$periodoActual->nperiodo}}</strong>


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
                               @if ($bandera==1 || $control==1)

                               <button  class="btn btn-danger" disabled>Tomar Asistencia <i class="fa fa-ban"></i></button>
                               @else
                               <a href="{{route('attendanceRecord',$degree->id)}}" class="btn btn-success">Tomar Asistencia</a>
                               @endif
                               <!-- <a href="" class="btn btn-primary">Historial de Registros</a> -->
                                <hr>
                                <!-- Boton de filtrado-->

                                <form action="{{route('attendance-filter',1)}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="degree" value="{{$degree->id}}">
                                    <input type="hidden" name="year" value="{{$periodoActual->school_year_id}}">

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                    @php
                                                        $cantidad= count($periodos);
                                                    @endphp
                                                   <select class="form-control" name="periodo_id">
                                                    @for ($i=0; $i <$cantidad ; $i++)
                                                        @if ($periodos[$i]->id == $periodoFiltrado->id )
                                                        <option value="{{$periodoFiltrado->id}}" selected>PERIODO {{$periodoFiltrado->nperiodo}} </option>
                                                       @else
                                                        <option value="{{$periodos[$i]->id}}">PERIODO {{$periodos[$i]->nperiodo}}</option>
                                                        @endif
                                                    @endfor

                                                  </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="submit" class="btn btn-warning mb-1">Filtrar <i class="fa fa-filter" aria-hidden="true"></i></button>
                                        </div>
                                    </div>
                                </form>

                              <!--<h5 class="card-title">-->
                                <div class="table-responsive">
                                  <table class="table table-borderless">
                                    <tr>
                                      <td  width="150" scope="col">Mostrando Registros de Asistencia: <strong>PERIODO {{$periodoFiltrado->nperiodo}}</strong> Grado: <strong> {{Help::ordinal($degree->degree)}} {{$degree->section}} - {{Help::turn($degree->turn)}} </strong>  Alumnos Registrados: <strong>{{$total}}</strong></td>
                                    </tr>
                                  </table>
                                </div>

                              <!--</h5>-->
                                <div class="table-responsive">
                                  <br>
                                  <table class="table" table-hover" id="bootstrap-data-table_length">
                                    <thead>
                                      <tr>
                                        <th width="150" scope="col">Fecha</th>
                                        <th width="150" scope="col">Con Asistencia</th>
                                        <th width="150" scope="col">Con Falta</th>
                                        <th width="150" scope="col">Con Permiso</th>
                                        <th width="150" scope="col">Total de Alumnos</th>
                                        <th width="150" scope="col">Ver Detalle</th>
                                        <th width="150" scope="col">Editar</th>

                                      </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($attendanceDates as $key => $value)
                                        @if($value->degree_id == $degree->id )
                                          <tr>
                                            <td>{{Help::dateFormatter($value->attendance_date)}}</td>
                                            <td>{{$value->asistencias}}</td>
                                            <td>{{$value->faltas}}</td>
                                            <td>{{$value->permisos}}</td>
                                            <td><strong>{{$total}}</td>
                                            <!-- IMPORTANTE-->
                                            <td>
                                              <a href="{{ route('showAttendance',[$value->degree_id,$value->attendance_date])}}" class="btn btn-info"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            </td>
                                            <td>
                                              <a href="{{ route('editAttendance',[$value->degree_id,$value->attendance_date])}}" class="btn btn-warning"><i class="fa fa-edit" aria-hidden="true"></i></a>
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
