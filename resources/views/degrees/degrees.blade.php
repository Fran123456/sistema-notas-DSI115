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
                  <th scope="col">Estado</th>
                  <th width="40" scope="col"> Editar </th>
                </tr>
              </thead>
              <tbody>
                 @foreach ($degrees as $key => $value)
                  <tr>
                    <th scope="row">{{$key+1}}</th>
                     <td>
                        {{$value->degree}}
                     </td>
                     <td>{{$value->section}}</td>
                     <td>{{$value->turn}}</td>
                     <td>{{$value->active}}</td>


                     @if (Auth::user()->roles()->first()->name =="Administrador")
                      <td>
                        <a href=# class="btn btn-warning"><i class="fa fa-edit" aria-hidden="true"></i></a>
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
