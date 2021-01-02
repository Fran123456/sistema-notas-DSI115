@extends('layouts.app')
@section('content')

@include('alerts.dataTable')
<style media="screen">
.bg-success {
  background-color: #c43a3a4d !important;
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
          <li class="breadcrumb-item active" aria-current="page">Periodos Escolares</li>
        </ol>
      </nav>
    </div>
  </div>

<div class="row ">
    <div class="col-md-12 col-sm-12 col-xs-12 text-right">
        <a href="{{route('periods-create',$year->id)}}" class="btn btn-primary">Crear Nuevo Periodo  <i class="fa fa-plus"></i></a>
    </div>
</div>

<button disabled="" class="btn btn-success">{{$cantidad}}/3 periodos asignados</button>
<br>
<div class="row">
  <div class="col-lg-12">
    <br>
    <div class="card">
      <div class="card-header">
        <strong class="card-title">PERIODOS AÑO Lectivo {{$year->year}} -
          Inicio: {{Help::dateFormatter($year->start_date)}}
        Fin: {{Help::dateFormatter($year->end_date)}}</strong>
      </div>
        <div class="card-body">
            <table class="table">
                <thead class="thead-light">
                <tr>
                  <th width="60" scope="col">Periodo</th>
                  <th width="90" scope="col">Inicio</th>
                  <th width="90" scope="col">Fin</th>
                  <th width="60" scope="col">Asistencias</th>
                  <th width="60" scope="col">Notas</th>
                  <th width="60" scope="col">Conducta</th>
                  <th width="60" scope="col">Estado</th>
                  <th width="60" scope="col">Editar</th>
                  <th width="60"  scope="col">Eliminar</th>
                  <th  width="80"scope="col">ACCIONES</th>

                </tr>
              </thead>
              <tbody>
                 @foreach ($periodos as $key => $value)
                  <tr @if ($value->finish == true)
                    class="bg-success"
                  @endif>
                    <th scope="row">{{$value->nperiodo}}</th>

                     <td>{{Help::dateFormatter($value->start_date)}}</td>
                     <td>{{Help::dateFormatter($value->end_date)}}</td>
                     <!--Resumen Asistencia-->
                     <td><a href="{{route('attendanceOverview',[$year->id,$value->id])}}" class="btn btn-info"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                     <!--Resumen Notas-->
                     <td><a href="{{route('periodScoresOverview',[$year->id,$value->id])}}" class="btn btn-info"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                     <td>
                       <a href="" class="btn btn-info"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                     </td>
                     <td>
                     @if (!($value->current))
                     <a href="{{ route('changePeriodStatus',[$year->id,$value->id]) }}"  class="btn btn-info"><i class="fas fa-exchange-alt" aria-hidden="true"></i></a>
                     @else
                     <button disabled="" class="btn btn-info"><i class="fas fa-exchange-alt" aria-hidden="true"></i></button>
                     @endif
                     </td>

                     <td>
                        <a href="{{route('periods-edit',[$value->id])}}" class="btn btn-warning"><i class="fa fa-edit" aria-hidden="true"></i></a>
                     </td>
                     <td>
                     <form action="{{route('periods-delete')}}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{$value->id}}">
                        <button type="submit" disabled class="btn btn-danger"> <i class="fa fa-trash" aria-hidden="true"></i></button>
                     </form>
                    </td>
                    <td>
                      @if ($value->finish == true)
                        <a href="{{route('periods-finish',$value->nperiodo)}}" class="btn btn-danger">Habilitar<i class="fa fa-check" aria-hidden="true"></i>
                         </a>
                      @else
                        <a href="{{route('periods-finish',$value->nperiodo)}}" class="btn btn-success">Finalizar<i class="fa fa-check" aria-hidden="true"></i>
                         </a>
                      @endif

                    </td>
                  </tr>
                @endforeach
            </tbody>
          </table>
      </div>
    </div>
  </div>
</div>

@endsection
