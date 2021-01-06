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
       <!-- <strong class="card-title">Materias para el docente {{Auth::user()->name}} -->
        <strong class="card-title">Grados para el docente encargado:  {{Auth::user()->name}} -
          Año escolar {{Help::getSchoolYear()->year}}
        </strong>
      </div>
        <div class="card-body">
            <table class="table" id="bootstrap-data-table_length">
              <thead>
                <tr>
                  <th width="40" scope="col">#</th>
                  <th width="200" scope="col">Grado</th>
                  <th scope="col">Capacidad</th>
                  <th scope="col">Inscritos</th>
                  <th width="40" scope="col">Asistencia</th>
                  <th width="40" scope="col">Conducta</th>
                  <th width="40" scope="col">Alumnos</th>
                  <th width="50" scope="col">Actividades</th>
                  <th width="40" scope="col">Materias</th>
                  <th width="45" scope="col">Reporte Aprobados</th>
                  <th width="45" scope="col">Reporte Reprobados</th>
                <!--  <th width="40" scope="col"> Notas </th>-->
                
                </tr>
              </thead>
              <tbody>
                @php
                  $y = Help::getSchoolYear();
                @endphp

                 @foreach ($data as $key => $value)

                 <!--Accede a el id el usuario
                  $value[0]->id de igual forma si cambia el id por name obtendra
                  el nombre del docente, los campos son los de la tabla user
                  asi que cualquier campo de ahi podra utilizarlo aqui.
                 -->
                  <tr>
                    <th scope="row">{{$key+1}}</th>
                     <td>{{Help::ordinal($value[1]->degree)}} {{$value[1]->section}}  {{Help::turn($value[1]->turn)}}</td>
                     <td>{{$value[2]['capacity']}}</td>
                     <td>{{$value[2]['full']}}</td>
                     <td>
                      <a href="{{ route('attendancesDates',$value[1]['id']) }}" class="btn btn-info"><i class="fa fa-clipboard-list" aria-hidden="true"></i></a>
                     </td>
                     <td>
                        <a href="{{ route('behaviors-all',  $value[1]['id'])  }}" class="btn btn-warning"><i class="fa fa-users" aria-hidden="true"></i></a>
                       </td>
                     <td>
                        <a href="{{route('showStudentsDegreeTeacher',[Auth::user()->id,$value[1]->id])}}" class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i></a>
                     </td>
                     <td>
                         <a href="{{ route('typesSubjectTeacher', [$value[1]['id'] , $value[0]->id]) }}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i></a>
                     </td>
                     <td>
                          <a href="{{ route('showSubjectsByDegree',[Auth::user()->id,$value[1]->id]) }}" class="btn btn-secondary"><i class="fa fa-book" aria-hidden="true"></i></a>                
                     </td>
                     <td>
                  <a href="{{ route('passed.pdf',[$value[1]->id, $y->id, Auth::user()->id]) }}" class="btn btn-dark"><i class="fa fa-clipboard-list" aria-hidden="true"></i></a>
                     </td>
                     <td>
                      <a href="{{ route('failed.pdf',[$value[1]->id, $y->id, Auth::user()->id]) }}" class="btn btn-dark"><i class="fa fa-clipboard-list" aria-hidden="true"></i></a>
                      </td>
                      <!--<td>
                        <form action="{{route('getScoresTypeByStudent')}}" method="get" enctype="multipart/form-data">
                           <input hidden value="{{$y->id}}" name="year">
                           <input hidden value="{{$value[1]['id']}}" name="degree">
                           <input hidden value="1" name="look">
                           <button type="submit" class="btn btn-warning"><i class="fa fa-edit" aria-hidden="true"></i></button>
                        </form>
                      </td>-->
                    

                  </tr>
                @endforeach
            </tbody>
          </table>
      </div>
    </div>
  </div>
</div>



@endsection