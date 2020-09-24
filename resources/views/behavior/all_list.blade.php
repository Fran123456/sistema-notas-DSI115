@extends('layouts.app')
@section('content')

@include('alerts.dataTable')

<div class="row">
  @include('alerts.alerts')
</div>
{{--
<div class="row">
  <div class="col-md-12">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Alumnos</li>
      </ol>
    </nav>
  </div>
</div>
--}}




<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
        <strong class="card-title">REGISTROS DE INDICADORES DE  CONDUCTA PARA EL GRADO: {{Help::ordinal($grado->degree).' '. $grado->section .'-'. Help::turn($grado->turn)}}</strong>
      </div>
        <div class="card-body">
            <table class="table" id="bootstrap-data-table_length">
              <thead>
                <tr>

                  <th width="30" >Periodo</th>
                  <th width="30" >Registrar Datos</th>
                  <th width="30" >Ver Registros</th>
                  <th width="30" > Eliminar Registros</th>
                </tr>
              </thead>
              <tbody>
                 @foreach ($periodos as $key => $value)
                  <tr>
                  <!--  <th scope="row">{{$key+1}}</th> -->
                     <td>
                        PERIODO {{$value->nperiodo}}
                     </td>

                     <td>
                        <a href="{{ route('behaviors-register', [$grado->id,$value->id]) }}" class="btn btn-primary"><i class="fa fa-receipt" aria-hidden="true"></i></a>
                     </td>
                     <td>
                        <a href="{{ route('behaviors-register-detail', [$grado->id,$value->id]) }}" class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i></a>
                     </td>
                     <td>
                       {{--  <form action="">
                            <button href="{{route('behaviors-register-delete', $value->id)}}" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                         </form> --}}
                      <a href="{{route('behaviors-register-delete', [$grado->id,$value->id])}}" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
