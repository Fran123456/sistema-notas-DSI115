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
          <li class="breadcrumb-item"><a href="{{ route('periods-index',$schoolYear->id) }}">Periodos Escolares</a></li>
          <li class="breadcrumb-item active" aria-current="page">Resumen notas periodo {{$period->nperiodo}} - {{$schoolYear->year}}</li>
        </ol>
      </nav>
    </div>
  </div>

<!--BODY-->
<div class="card">

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="materias-tab" data-toggle="tab" href="#materias" role="tab" aria-controls="materias" aria-selected="true">Resumen de notas por materia</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="grados-tab" data-toggle="tab" href="#grados" role="tab" aria-controls="grados" aria-selected="false">Resumen de notas por grado</a>
        </li>
    </ul>

    <!--Tabs' content-->

    <div class="tab-content" id="myTabContent">

        <!--Notas por materias Tab-->
        <div class="tab-pane fade show active" id="materias" role="tabpanel" aria-labelledby="materias-tab">
          <div class="card-header">
            <strong class="card-title">RESUMEN DE NOTAS POR MATERIA PERIODO {{$period->nperiodo}} - {{$schoolYear->year}}</strong>
          </div>

          <div class="col">
            <div class="card-body">
              <div class="card" style="width: auto;">
                  <div class="table-responsive">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Materia</th>                          
                            <th scope="col">Nota promedio en la materia</th>
                            <th scope="col">Cantidad de alumnos aprobados</th>
                            <th scope="col">Porcentaje aprobados</th>
                            <th scope="col">Cantidad de alumnos reprobados</th>
                            <th scope="col">Porcentaje reprobados</th>
                            <th scope="col">Total de alumnos inscritos</th>
                          </tr>
                        </thead>
                        <tbody>
                        @for($i=0;$i<(sizeof($information));$i++)
                          @php
                            $materia=$information[$i][0];
                            $periodAverage=$information[$i][1];
                            $aprobados=$information[$i][2];
                            $reprobados=$information[$i][3];
                            $inscritos=$information[$i][4];                 
                          @endphp
                          <tr>
                              <td class="align-middle">{{$materia}}</td>                   
                              <td class="align-middle">{{number_format($periodAverage,2)}}</td>
                              <td class="align-middle">{{$aprobados}}</td>
                              <td class="align-middle">{{number_format(($aprobados/$inscritos)*100,2)}}%</td>
                              <td class="align-middle">{{$reprobados}}</td>
                              <td class="align-middle">{{number_format(($reprobados/$inscritos)*100,2)}}%</td>
                              <td class="align-middle">{{$inscritos}}</td>
                          </tr>
                        @endfor
                        </tbody>
                    </table>
                  </div>
              </div>
            </div>
          </div>
        </div>

        <!--Notas por grados Tab-->
        <div class="tab-pane fade" id="grados" role="tabpanel" aria-labelledby="grados-tab">
          <div class="card-header">
            <strong class="card-title">RESUMEN DE NOTAS POR GRADO</strong>
          </div>

          <div class="col">
            <div class="card-body">
              <div class="card" style="width: auto;">
              resumen de notas por grado
              </div>
            </div>
          </div>
        </div>

    </div>

</div><!--BODY-->
@endsection

