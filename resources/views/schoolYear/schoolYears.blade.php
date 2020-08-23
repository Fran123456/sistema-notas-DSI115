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
                  <th scope="col">Fecha inicio</th>
                  <th scope="col">Fecha de finalización</th>
                  <th scope="col">Año</th>
                  <th scope="col">Estado</th>
                  <th width="40" scope="col"> Editar </th>
                </tr>
              </thead>
              <tbody>
                 @foreach ($years as $key => $value)
                  <tr>
                    <th scope="row">{{$key+1}}</th>
                     <td>
                        {{ Help::ordinal($value->degree)}}
                     </td>
                     <td>{{$value->start_date}}</td>
                     <td>{{$value->end_date}}</td>
                     <td>{{$value->year}}</td>
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
