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
      <li class="breadcrumb-item"><a href="{{ route('periods-index',$year->id) }}">Periodos Escolares</a></li>
      <!--TENGO QUE AGREGARLE EL AÑO-->      
      <li class="breadcrumb-item active" aria-current="page">Resumen Periodo {{$period->nperiodo}} Año {{$year->year}}</li>
      </ol>
    </nav>
  </div>
</div>

<!--BODY-->
<div class="card">        

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true">Resumen General</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="grados-tab" data-toggle="tab" href="#grados" role="tab" aria-controls="grados" aria-selected="false">Resumen por grados</a>
        </li>
    </ul>

    <!--Tabs' content-->

    <div class="tab-content" id="myTabContent">

        <!--Coordinadores Tab-->
        <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
          <div class="card-header">
            <strong class="card-title">Resumen General</strong>
          </div>          
          <div class="col">
            <div class="card-body">
              <div class="card" style="width: auto;">
                @if(count($attendances))
                  <div class="table-responsive">
                    <table class="table">
                      <!--<table class="table" id="bootstrap-data-table_length">-->
                        <thead>
                          <tr>
                            <th class="table-info" width="100" scope="col">Con Asistencia</th>
                            <th width="100" scope="col">Porcentaje</th>
                            <th class="table-info" width="100" scope="col">Con Falta</th>
                            <th width="100" scope="col">Porcentaje</th>
                            <th class="table-info" width="100" scope="col">Con Permiso</th>
                            <th width="100" scope="col">Porcentaje</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendances as $key => $value)
                          <tr>                              
                              <td class="table-info align-middle">{{$value->asistencias}}</td>
                              <td class="align-middle">{{number_format($value->porAsistencias*100,2)}}</td>
                              <td class="table-info align-middle">{{$value->faltas}}</td>
                              <td class="align-middle">{{number_format($value->porFaltas*100,2)}}</td>
                              <td class="table-info align-middle">{{$value->permisos}}</td>
                              <td class="align-middle">{{number_format($value->porPermisos*100,2)}}</td>
                          </tr>
                          @endforeach
                      </tbody>
                    </table>
                  </div>
                @else
                <p class="text-center"><strong>No existencias asistencias registradas</strong></p>
                @endif
              </div>
            </div>
          </div>
        </div>

        <!--Resumen por Grado-->
        <div class="tab-pane fade" id="grados" role="tabpanel" aria-labelledby="grados-tab">
          <div class="card-header">
            <strong class="card-title">Resumen por Grados</strong>
          </div>            
            <div class="row">
              @if(count($degrees))
                    @foreach($degrees as $degree)
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
                                    </tr>
                                  </table>
                                </div>
                              <!--</h5>-->
                                <div class="table-responsive">
                                  <table class="table">
                                    <thead>
                                      <tr>
                                        <th class="table-info" width="100" scope="col">Con Asistencia</th>
                                        <th width="100" scope="col">Porcentaje</th>
                                        <th class="table-info" width="100" scope="col">Con Falta</th>
                                        <th width="100" scope="col">Porcentaje</th>
                                        <th class="table-info" width="100" scope="col">Con Permiso</th>
                                        <th width="100" scope="col">Porcentaje</th>
                                      </tr>
                                    </thead>
                                    <tbody>                                    
                                        <tr>
                                        <td class="table-info" >{{$degree->asistencias}}</td>
                                        <td>{{number_format($degree->porAsistencias*100,2)}}</td>
                                        <td class="table-info" >{{$degree->faltas}}</td>
                                        <td>{{number_format($degree->porFaltas*100,2)}}</td>
                                        <td class="table-info" >{{$degree->permisos}}</td>
                                        <td>{{number_format($degree->porPermisos*100,2)}}</td>
                                        </tr>                                      
                                    </tbody>
                                  </table>
                                </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    @endforeach
              @else
                <div lass="col-sm-12">
                  <p class="text-center"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; No existen asistencias registradas.</strong></p>
                </div>
              @endif
            </div>
        </div>

    </div>

</div><!--BODY-->
@endsection
