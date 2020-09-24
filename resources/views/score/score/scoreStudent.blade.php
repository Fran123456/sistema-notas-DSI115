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
        <li class="breadcrumb-item active" aria-current="page">Materias</li>
      </ol>
    </nav>
  </div>
</div>

@if ($look == 1)
<form method="get" action="" enctype="multipart/form-data">
  <div class="row ">
      <div class="col-md-4">
         <div class="form-group">
           <input placeholder="Nombre alumno" class="form-control" type="text" name="student" value="">
         </div>
       </div>
       <div class="mb-1">
          <button type="submit" class="btn btn-info mb-1" ><i class="fa fa-search" aria-hidden="true"></i></button>
       </div>
    </div>
  </form>
@endif


<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
        <strong class="card-title">Materias</strong>
      </div>
        <div class="card-body">
            <table class="table" id="bootstrap-data-table_length">
              <thead>
                <tr>
                  <th width="40" scope="col">#</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Activo</th>
                  <th scope="col">Estado</th>
                  <th width="40" scope="col">Editar</th>
                  <th width="40" scope="col"> Eliminar </th>
                </tr>
              </thead>
              <tbody>
                 @foreach ($types as $key => $value)
                  <tr>
                    <th scope="row">{{$key+1}}</th>
                     <td></td>
                     <td></td>
                     <td></td>
                  </tr>
                @endforeach
            </tbody>
          </table>
      </div>
    </div>
  </div>
</div>

@endsection
