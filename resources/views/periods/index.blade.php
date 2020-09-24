@extends('layouts.app')
@section('content')

@include('alerts.dataTable')

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
                  <th width="50" scope="col">Periodo</th>
                  <th scope="col">Inicio</th>
                  <th scope="col">Fin</th>
                  <th scope="col">Estado</th>
                  <th scope="col">Editar</th>
                  <th  scope="col">Eliminar</th>

                </tr>
              </thead>
              <tbody>
                 @foreach ($periodos as $key => $value)
                  <tr>
                    <th scope="row">{{$value->nperiodo}}</th>

                     <td>{{Help::dateFormatter($value->start_date)}}</td>
                     <td>{{Help::dateFormatter($value->end_date)}}</td>

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
                        <button type="submit" class="btn btn-danger"> <i class="fa fa-trash" aria-hidden="true"></i></button>
                     </form>
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
