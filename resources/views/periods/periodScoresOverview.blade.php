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
            <strong class="card-title">RESUMEN DE NOTAS POR MATERIA</strong>
          </div>

          <div class="col">
            <div class="card-body">
              <div class="card" style="width: auto;">
                resumen de notas por materia
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

