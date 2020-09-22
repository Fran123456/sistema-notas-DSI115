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
        <li class="breadcrumb-item"><a href="{{ route('gradesTeacher',$te->id) }}">
          Administración de docente - Año escolar {{Help::getSchoolYear()->year}}
        </a></li>
        <li class="breadcrumb-item active" aria-current="page">Materias</li>
      </ol>
    </nav>
  </div>
</div>



<div class="row ">
    <div class="col-md-12 col-sm-12 col-xs-12 text-right">
       <a class="btn btn-info mb-1" href=""><i class="fa fa-plus" aria-hidden="true"></i></a>
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
                  <th width="40" scope="col"> Editar </th>
                  <th width="40" scope="col"> Eliminar </th>
                </tr>
              </thead>
              <tbody>
                 @foreach ($grades as $key => $value)
                  <tr>
                    <th scope="row">{{$key+1}}</th>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td>
                     
                     </td>
                     <td>
                     <a href="" class="btn btn-danger"><i class="fas fa-exchange-alt" aria-hidden="true"></i></a>
                     
                     </td>
                     <td>
                         <a href="" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i></a>
                     </td>

                      <td>
                        <a href="" class="btn btn-warning"><i class="fa fa-edit" aria-hidden="true"></i></a>
                      </td>
                      <td>              
                        <a href="" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
