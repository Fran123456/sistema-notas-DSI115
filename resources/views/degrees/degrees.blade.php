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
        <li class="breadcrumb-item active" aria-current="page">Grados</li>
      </ol>
    </nav>
  </div>
</div>



<div class="row ">
    <div class="col-md-12 col-sm-12 col-xs-12 text-right">
       <a class="btn btn-info mb-1" href="{{ route('degrees.create') }}"><i class="fa fa-plus" aria-hidden="true"></i></a>
    </div>
</div>




<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
        <strong class="card-title">Grados</strong>
      </div>
        <div class="card-body">
            <table class="table" id="bootstrap-data-table_length">
              <thead>
                <tr>
                  <th width="40" scope="col">#</th>
                  <th scope="col">Grado</th>
                  <th scope="col">Seccion</th>
                  <th scope="col">Turno</th>
                  <th scope="col">Activo</th>
                  <th scope="col">Estado</th>
                  <th width="40" scope="col"> Editar </th>
                </tr>
              </thead>
              <tbody>
                 @foreach ($degrees as $key => $value)
                  <tr>
                    <th scope="row">{{$key+1}}</th>
                     <td>
                        {{ Help::ordinal($value->degree)}}
                     </td>
                     <td>{{$value->section}}</td>
                     <td>
                      @if ($value->turn =="m")
                       Matutino
                      @else
                       Vespertino
                      @endif
                     </td>
                     <td>
                      @if ($value->active)
                       Activo
                      @else
                       No activo
                      @endif

                     </td>
                     <td>
                     <a href="{{ route('changeStatusDegree', $value->id) }}" class="btn btn-danger"><i class="fas fa-exchange-alt" aria-hidden="true"></i></a>
                     </td>                     
                     @if (Auth::user()->roles()->first()->name =="Administrador")
                      <td>
                        <a href="{{route('degrees.edit',$value->id)}}" class="btn btn-warning"><i class="fa fa-edit" aria-hidden="true"></i></a>
                      </td>
                     @else
                     <td> <button class="btn btn-warning" disabled=""><i class="fa fa-edit" aria-hidden="true"></i></button> </td>
                     @endif



                  </tr>
                @endforeach
            </tbody>
          </table>
      </div>
    </div>
  </div>
</div>

@endsection
