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
        <li class="breadcrumb-item active" aria-current="page">Toma de asistencia </li>
      </ol>
    </nav>
  </div>
</div>


<div class="row">

    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
         <!-- <strong class="card-title"> {{Help::ordinal($degree->degree)}} {{$degree->section}} - {{Help::turn($degree->turn)}}. <br>PERIODO EN CURSO DEL AÑO ESCOLAR: PERIODO {{$periodoActual->nperiodo}} </strong> -->


          <strong class="card-title">
            <br>PERIODO EN CURSO DEL AÑO ESCOLAR: PERIODO {{$periodoActual->nperiodo}} <br>
            Control de Asistencia Escolar para el grado:
           {{Help::ordinal($degree->degree)}} {{$degree->section}} - {{Help::turn($degree->turn)}}  </strong></strong>
        </div>
        <div>

        </div>

          <div class="card-body">

          
          <form action="{{route('saveAttendanceRecord')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <table>
            <tr>
              <td>
                <label for="">Seleccione la fecha de asistencia:</label>
                <input type="date" name="date" required>
              </td>
            </tr>
          </table>                    
            <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th width="10" scope="col">#</th>
                    <th scope="col" class="text-center" width="50">Nombre</th>
                    <th scope="col"  class="text-center"  width="40">Asistencia</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($students as $key=> $item)
                    <tr style="font-size: 100%">
                       @foreach ($std as $value)
                       @if ($item->student_id == $value->id)                                                                     
                       <input type="hidden" value="{{$item->id}}" name="studenthistory[]">
                       <th scope="row">{{$key+1}}</th>
                       <td class="text-center">
                        <input type="hidden" value="{{$item->student_id}}" name="student_id[]">
                           {{$value->name}}  {{$value->lastname}}
                      </td>
                       <td><select name="asistencia[]" class="form-control" style="font-size: 90%">
                        <option value="1">ASISTIO</option>
                        <option value="0">NO ASISTIO</option>
                        <option value="2">FALTA CON PERMISO</option>
                        </select>
                       </td>
                       @endif
                       @endforeach
                    </tr>
                    @endforeach
              </tbody>
            </table>
            <button class="btn btn-primary" type="submit" >GUARDAR ASISTENCIA   <i class="fa fa-check-circle"></i></button>
        </form>
        </div>
      </div>
    </div>
  </div>
@endsection
