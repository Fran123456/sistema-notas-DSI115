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

        <!--Resumen de notas por materia Tab-->
        <div class="tab-pane fade show active" id="materias" role="tabpanel" aria-labelledby="materias-tab">
          <div class="card-header">
            <strong class="card-title">RESUMEN DE NOTAS POR MATERIA PERIODO {{$period->nperiodo}} - {{$schoolYear->year}}</strong>
          </div>

          <div class="col">
            <div class="card-body">
                  @if(sizeof($subjectsYear)>0)
                  <div class="table-responsive">                  
                    <table class="table text-center">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col">Materia</th>                          
                            <th scope="col">Nota promedio en la materia</th>
                            <th scope="col">Cantidad de alumnos aprobados</th>
                            <th scope="col">Porcentaje aprobados</th>
                            <th scope="col">Cantidad de alumnos reprobados</th>
                            <th scope="col">Porcentaje reprobados</th>
                            <th scope="col">Total de alumnos evaluados</th>
                          </tr>
                        </thead>
                        <tbody>
                        @for($i=0;$i<(sizeof($infoBySubject));$i++)
                          @php
                            $subject=$infoBySubject[$i][0];
                            $averageBySubject=$infoBySubject[$i][1];
                            $aprobadosBySubject=$infoBySubject[$i][2];
                            $aprobadosBySubjectPercentage=$infoBySubject[$i][3];
                            $reprobadosBySubject=$infoBySubject[$i][4];
                            $reprobadosBySubjectPercentage=$infoBySubject[$i][5];
                            $evaluadosBySubject=$infoBySubject[$i][6];                 
                          @endphp
                          <tr>
                              <td class="align-middle">{{$subject}}</td>                   
                              <td class="align-middle">{{number_format($averageBySubject,2)}}</td>
                              <td class="align-middle">{{$aprobadosBySubject}}</td>
                              <td class="align-middle">{{number_format(($aprobadosBySubjectPercentage)*100,2)}}%</td>
                              <td class="align-middle">{{$reprobadosBySubject}}</td>
                              <td class="align-middle">{{number_format(($reprobadosBySubjectPercentage)*100,2)}}%</td>
                              <td class="align-middle">{{$evaluadosBySubject}}</td>
                          </tr>
                        @endfor
                        </tbody>
                    </table>
                  </div>
                  @else
                    <p style="color:red;text-align:center;">No se encontraron materias para este año escolar</p>
                  @endif
            </div>
          </div>
        </div>

        <!--Resumen de notas por grado Tab-->
        <div class="tab-pane fade" id="grados" role="tabpanel" aria-labelledby="grados-tab">
          <div class="card-header">
            <strong class="card-title">RESUMEN DE NOTAS POR GRADO PERIODO {{$period->nperiodo}} - {{$schoolYear->year}}</strong>
          </div>

          <div class="col">
            <div class="card-body">             
                @if(sizeof($degreesYear)>0)
                <div class="table-responsive">
                    <table class="table text-center">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col">Grado</th>                          
                            <th scope="col">Nota promedio en el grado</th>
                            <th scope="col">Cantidad de alumnos aprobados</th>
                            <th scope="col">Porcentaje aprobados</th>
                            <th scope="col">Cantidad de alumnos reprobados</th>
                            <th scope="col">Porcentaje reprobados</th>
                            <th scope="col">Total de alumnos evaluados</th>
                            <th scope="col">Reporte de notas</th>
                          </tr>
                        </thead>
                        <tbody>
                        @for($i=0;$i<(sizeof($infoByDegree));$i++)
                          @php
                            $degree=$infoByDegree[$i][0];
                            $averageByDegree=$infoByDegree[$i][1];
                            $aprobadosByDegree=$infoByDegree[$i][2];
                            $aprobadosByDegreePercentage=$infoByDegree[$i][3];
                            $reprobadosByDegree=$infoByDegree[$i][4];
                            $reprobadosByDegreePercentage=$infoByDegree[$i][5];
                            $evaluadosByDegree=$infoByDegree[$i][6];                 
                          @endphp
                          <tr>
                              <td class="align-middle">{{$degree}}</td>                   
                              <td class="align-middle">{{number_format($averageByDegree,2)}}</td>
                              <td class="align-middle">{{$aprobadosByDegree}}</td>
                              <td class="align-middle">{{number_format(($aprobadosByDegreePercentage)*100,2)}}%</td>
                              <td class="align-middle">{{$reprobadosByDegree}}</td>
                              <td class="align-middle">{{number_format(($reprobadosByDegreePercentage)*100,2)}}%</td>
                              <td class="align-middle">{{$evaluadosByDegree}}</td>
                              <td class="align-middle">
                                <a href="{{ route('period-scores.pdf', [$infoByDegree[$i][7], $period->id, $schoolYear->id]) }}" class="btn btn-dark"><i class="fa fa-clipboard-list" aria-hidden="true"></i></a>
                              </td>
                          </tr>
                        @endfor
                        </tbody>
                    </table>
                  </div>
                  @else
                    <p style="color:red;text-align:center;">No se encontraron grados para este año escolar</p>
                  @endif       
            </div>
          </div>
        </div>

    </div>

</div><!--BODY-->
@endsection

