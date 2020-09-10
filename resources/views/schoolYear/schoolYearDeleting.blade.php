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
      <li class="breadcrumb-item"><a href="{{ route('years.index') }}">Años escolares</a></li>
      <!--TENGO QUE AGREGARLE EL AÑO-->
      <li class="breadcrumb-item active" aria-current="page">Eliminación año escolar {{$backSchoolYear->year}}</li>
      </ol>
    </nav>
  </div>
</div>

<div class="card">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="coordinadores-tab" data-toggle="tab" href="#coordinadores" role="tab" aria-controls="coordinadores" aria-selected="true">Coordinadores por grado año escolar {{$backSchoolYear->year}}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="materias-tab" data-toggle="tab" href="#materias" role="tab" aria-controls="materias" aria-selected="false">Materias asignadas año escolar {{$backSchoolYear->year}}</a>
        </li>  
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="coordinadores" role="tabpanel" aria-labelledby="coordinadores-tab">
        <div class="card-header">
      <!--TENGO QUE AGREGARLE EL AÑO-->
        <strong class="card-title">Coordinadores por sección año escolar {{$backSchoolYear->year}}</strong>
      </div>
      <!--Degree_school_year-->
      <!--Grados relacionados-->
      <div class="card-body">
      @if($sizeQuerySchoolYear>0)
            <table class="table">
            <!--<table class="table" id="bootstrap-data-table_length">-->
              <thead>
                <tr>                                    
                  <th width="100" scope="col">Grado</th>
                  <th width="100" scope="col">Sección</th>
                  <th width="100" scope="col">Turno</th>
                  <th width="200" scope="col">Docente</th>
                  <th width="100" scope="col">Capacidad</th>                                    
                </tr>
              </thead>
              <tbody>
                 @foreach ($querySchoolYear as $key => $value)
                <tr>                
                    <td>{{ Help::ordinal($value->degree)}}</td>
                    <td>{{$value->section}}</td>
                    <td>
                    @if ($value->turn =="m")
                       Matutino
                      @else
                       Vespertino
                      @endif
                    </td>
                    <td>{{$value->name}}</td>
                    <td>{{$value->capacity}}</td>                    
                </tr>
                @endforeach
            </tbody>
          </table>          
          @else
          <p><strong>No existen coordinadores asignados.</strong></p>  
          @endif
      </div>
        </div>
        <div class="tab-pane fade" id="materias" role="tabpanel" aria-labelledby="materias-tab">
        <div class="card-header">      
        <strong class="card-title">Materias por sección año escolar {{$backSchoolYear->year}}</strong>
      </div>      
        <!--Degree_subject_year-->        
        <div class="card-body">
        @if($sizeQuerySubjectYear>0)
            <table class="table">
              <thead>
                <tr>                                    
                  <th width="150" scope="col">Materia</th>
                  <th width="100" scope="col">Grado</th>
                  <th width="100" scope="col">Sección</th>
                  <th width="100" scope="col">Turno</th>
                  <th width="200"scope="col">Docente</th>
                </tr>
              </thead>
              <tbody>
              @foreach ($querySubjectYear as $key => $value)
                <tr>
                    <td>{{$value->subjectName}}</td>
                    <td>{{ Help::ordinal($value->degree)}}</td>
                    <td>{{$value->section}}</td>
                    <td>
                    @if ($value->turn =="m")
                       Matutino
                      @else
                       Vespertino
                      @endif
                    </td>
                    <td>{{$value->name}}</td>                    
                </tr>
                @endforeach
            </tbody>
          </table>
          @else
        <p><strong>No existen materias asignadas.</strong></p>
      @endif
      </div>
      
        </div>          
    </div>
        <div class="card-body">        
            <button class="btn btn-danger" data-toggle="modal" data-target="#confirmElimination"><i class="fa fa-trash" aria-hidden="true"></i></button>
        </div>
        
</div>
@endsection
@include('schoolYear.modalDeleting')

