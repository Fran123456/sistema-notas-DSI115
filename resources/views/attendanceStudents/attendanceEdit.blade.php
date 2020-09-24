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
        <li class="breadcrumb-item active" aria-current="page">Edición asistencia fecha: {{Help::dateFormatter($attendanceDate)}} </li>
      </ol>
    </nav>
  </div>
</div>


<div class="row">
  <div class="col-lg-12">
    <div class="card">
        <br>
        <div class="text-center"><h3>Edición asistencia fecha {{Help::dateFormatter($attendanceDate)}}</h3></div>                
      <div class="card-body">
        <form method="post" action="{{route('updateAttendance')}}"  enctype="multipart/form-data">
          <input name="_method" type="hidden" value="PATCH">            
            @csrf
            <table class="table table-hover">
                <thead>
                  <tr>
                    <th width="40" scope="col">#</th>
                    <th width="100" scope="col">Nombre</th>
                    <th width="100" scope="col">Apellido</th>
                    <th width="150" scope="col">Registro</th>
                  </tr>
                </thead>
                <input hidden value="{{$attendanceDate}}" name="date">
                <input hidden value="{{$activeYear->id}}" name="activeYear">
                <input hidden value="{{$degree->id}}" name="degree">
                <tbody>
                @foreach($attendance as $key => $value)
                    <tr>
                        <td>{{$key+1}}</td>
                        <input type="hidden" value="{{$value->id}}" name="student_id[]">
                        <td>{{$value->name}}</td>
                        <td>{{$value->lastname}}</td>                        
                        <td>
                            <select name="asistencia[]" class="form-control" style="font-size: 90%">
                                @if ($value->active==0)
                                    <option value="1">ASISTIO</option>
                                    <option selected="selected" value="0">NO ASISTIO</option>
                                    <option value="2">FALTA CON PERMISO</option>
                                @else
                                    @if ($value->active==1)
                                        <option selected="selected" value="1">ASISTIO</option>
                                        <option value="0">NO ASISTIO</option>
                                        <option value="2">FALTA CON PERMISO</option>
                                    @else
                                        <option value="1">ASISTIO</option>
                                        <option value="0">NO ASISTIO</option>
                                        <option selected="selected" value="2">FALTA CON PERMISO</option>
                                    @endif
                                @endif
                            </select>
                        </td>
                    </tr>
                @endforeach
              </tbody>
            </table>
            <button class="btn btn-primary" type="submit" >Guardar cambios  <i class="fa fa-check-circle"></i></button>
        </form>
      </div>
    </div>
  </div>
</div>



@endsection
