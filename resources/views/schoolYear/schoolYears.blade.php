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
        <li class="breadcrumb-item active" aria-current="page">Años escolares</li>
      </ol>
    </nav>
  </div>
</div>


<div class="row ">
    <div class="col-md-12 col-sm-12 col-xs-12 text-right">
       <a class="btn btn-info mb-1" href="{{ route('years.create') }}"><i class="fa fa-plus" aria-hidden="true"></i></a>
    </div>
</div>


<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
        <strong class="card-title">Años escolares</strong>
      </div>
        <div class="card-body">
            <table class="table" id="bootstrap-data-table_length">
              <thead>
                <tr>
                  <th width="40" scope="col">#</th>
                  <th width="200" scope="col">Fecha inicio</th>
                  <th width="200" scope="col">Fecha de finalización</th>
                  <th scope="col">Año</th>
                  <th scope="col">Activo</th>
                  <th scope="col" width="40">Estado</th>
                  <th width="40" scope="col"> Administrar </th>
                  <th width="40" scope="col"> Periodos </th>
                  <th width="40" scope="col"> Editar </th>
                  <th width="40" scope="col"> Eliminar </th>
                </tr>
              </thead>
              <tbody>
                 @foreach ($years as $key => $value)
                  <tr @if ($value->active)
                    class="bg-success"
                  @endif>
                    <th scope="row">{{$key+1}}</th>

                     <td>{{Help::dateFormatter($value->start_date)}}</td>
                     <td>{{Help::dateFormatter($value->end_date)}}</td>
                     <td>{{$value->year}}</td>
                     <td>
                      @if ($value->active)
                        Activado
                      @else
                        No Activo
                      @endif

                     </td>
                     <td>
                     @if (!($value->active))
                     <a href="{{ route('changeStatusSchoolYear', $value->id) }}" class="btn btn-danger"><i class="fas fa-exchange-alt" aria-hidden="true"></i></a>
                     @else
                     <button disabled="" class="btn btn-danger"><i class="fas fa-exchange-alt" aria-hidden="true"></i></button>
                     @endif
                     </td>
                     <td>
                       @if ($value->active)
                         <a href="{!! route('teacher-grade', $value->id) !!}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i></a>
                       @else
                         <button disabled class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i></button>
                       @endif
                     </td>

                     <td>
                        <a href="{!! route('periods-index',$value->id) !!}" class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></a>
                      </td>
                      <td>
                        <a href="" class="btn btn-warning"><i class="fa fa-edit" aria-hidden="true"></i></a>
                      </td>

                      <td>
                      @if (!$value->active)
                        <a href="{{ route('deletingSchoolYear', $value->id) }}" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                      @else
                        <button disabled class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
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
