@extends('layouts.app')
@section('content')

@include('alerts.dataTable')

<div class="row">
  @include('alerts.alerts')
</div>

{{--<div class="row">
  <div class="col-md-12">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Alumnos</li>
      </ol>
    </nav>
  </div>
</div> --}}

<div class="row ">
    <div class="col-md-12 col-sm-12 col-xs-12 text-right">
        <a href="{{route('behaviors.create')}}" class="btn btn-primary">Crear Nuevo Indicador de Conducta  <i class="fa fa-plus"></i></a>
    </div>
</div>


<br>
<div class="row">
  <div class="col-lg-12">
    <br>
    <div class="card">
      <div class="card-header">
        <strong class="card-title">INDICADORES DE CONDUCTA </strong>
      </div>
        <div class="card-body">
            <table class="table">
                <thead class="thead-light">
                <tr>
                  <th width="50" scope="col">#</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Codigo</th>
                  <th scope="col">Descripcion</th>
                  <th width="col" scope="col">Editar</th>
                  <th width="col" scope="col">Eliminar</th>

                </tr>
              </thead>
              <tbody>
                 @foreach ($indicadores as $key => $value)
                  <tr>
                    <th scope="row">{{$key+1}}</th>

                     <td>{{$value->name}}</td>
                     <td>{{$value->code}}</td>
                     <td>{{$value->description}}</td>



                     <td>
                        <a href="{{route('behaviors.edit',[$value->id])}}" class="btn btn-warning"><i class="fa fa-edit" aria-hidden="true"></i></a>
                     </td>
                     <td>
                      {{--  <a href="{{route('behaviors.destroy',$value->id)}}" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a> --}}
                     <form action="{{route('behaviors-delete')}}" method="POST">
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
