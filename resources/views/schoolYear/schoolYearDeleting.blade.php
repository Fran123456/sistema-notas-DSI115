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
      <li class="breadcrumb-item"><a href="{{ route('years.index') }}">Años escolares</a></li>
      <!--TENGO QUE AGREGARLE EL AÑO-->
      <li class="breadcrumb-item active" aria-current="page">Eliminación año escolar {{$backSchoolYear->year}}</li>
      </ol>
    </nav>
  </div>
</div>

<!--BODY-->
<div class="card">
        <div class="card-body">        
            <button class="btn btn-danger" data-toggle="modal" data-target="#confirmElimination"><i class="fa fa-trash" aria-hidden="true"></i></button>
        </div>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="coordinadores-tab" data-toggle="tab" href="#coordinadores" role="tab" aria-controls="coordinadores" aria-selected="true">Coordinadores por grado año escolar {{$backSchoolYear->year}}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="materias-tab" data-toggle="tab" href="#materias" role="tab" aria-controls="materias" aria-selected="false">Materias asignadas año escolar {{$backSchoolYear->year}}</a>
        </li>          
    </ul>

    <!--Tabs' content-->

    <div class="tab-content" id="myTabContent">

        <!--Coordinadores Tab-->
        <div class="tab-pane fade show active" id="coordinadores" role="tabpanel" aria-labelledby="coordinadores-tab">
          <div class="card-header">      
            <strong class="card-title">Coordinadores por sección año escolar {{$backSchoolYear->year}}</strong>
          </div>
          <!--Degree_school_year--> 
                         
          <div class="col">
            <div class="card-body">
              <div class="card" style="width: auto;">                
                @if($sizeQuerySchoolYear>0)
                  <div class="table-responsive">
                    <table class="table">
                      <!--<table class="table" id="bootstrap-data-table_length">-->
                        <thead>
                          <tr>                                    
                            <th width="100" scope="col">Grado</th>
                            <th width="100" scope="col">Sección</th>
                            <th width="100" scope="col">Turno</th>                            
                            <th width="100" scope="col">Capacidad</th>                                    
                            <th width="175" scope="col">Docente</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($querySchoolYear as $key => $value)
                          <tr>                
                              <td class="align-middle">{{ Help::ordinal($value->degree)}}</td>
                              <td class="align-middle">{{$value->section}}</td>
                              <td class="align-middle">
                              @if ($value->turn =="m")
                                  Matutino
                                @else
                                  Vespertino
                                @endif
                              </td>                              
                              <td class="align-middle">{{$value->capacity}}</td>                    
                              <td class="align-middle">{{$value->name}}</td>
                          </tr>
                          @endforeach
                      </tbody>
                    </table>             
                  </div>   
                @else
                <p><strong>No existen coordinadores asignados.</strong></p>  
                @endif            
              </div>
            </div>
          </div>
        </div>     

        <!--Subjects Tab-->
        <div class="tab-pane fade" id="materias" role="tabpanel" aria-labelledby="materias-tab">
          <div class="card-header">      
            <strong class="card-title">Materias por sección año escolar {{$backSchoolYear->year}}</strong>
          </div>      
            <!--Degree_subject_year-->        
            <div class="row">
              @if($sizeQuerySubjectYear>0)
                
                    @foreach($querySchoolYear as $degree)
                      <div class="col-sm-6">
                      <!--col-lg 3 col-md-3 col-sm-12 col-xs-12-->                      
                        <div class="card-body">
                          <div class="card" style="width: auto;">
                            <div class="card-body">                                  
                              <!--<h5 class="card-title">-->
                                <div class="table-responsive">
                                  <table class="table table-borderless">
                                    <tr>
                                      <td><strong>Grado</strong></td>                      
                                      <td>{{ Help::ordinal($degree->degree)}} </td>                                                          
                                      <td><strong>Turno</strong></td>
                                      <td>@if ($degree->turn =="m")
                                            Matutino
                                          @else
                                            Vespertino
                                          @endif                
                                      </td>
                                    </tr>                                                                        
                                    <tr>
                                      <td><strong>Sección</strong></td>
                                      <td>{{$degree->section}} </td>
                                      <td ><strong>Coordinador</strong></td>
                                      <td colspan="2"> {{$degree->name}}</td>
                                    </tr>
                                  </table>
                                </div>                                                                                                                                                                  
                              <!--</h5>-->
                                <div class="table-responsive">
                                  <table class="table">
                                    <thead>
                                      <tr>                                    
                                        <th width="150" scope="col">Materia</th>                      
                                        <th width="200"scope="col">Docente</th>
                                      </tr>
                                    </thead>
                                    <tbody>    
                                      @foreach($querySubjectYear as $key => $value)
                                        @if($degree->id == $value->degree_id)
                                          <tr>
                                            <td>{{$value->subjectName}}</td>                      
                                            <td>{{$value->name}}</td>                    
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
                    @endforeach                            
              @else
                <p><strong>No existen materias asignadas.</strong></p>
              @endif  
            </div>
        </div>

    </div>               
                
</div><!--BODY-->
@endsection
@include('schoolYear.modalDeleting')

