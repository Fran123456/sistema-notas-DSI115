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



<div class="row ">
    <div class="col-md-12 col-sm-12 col-xs-12 text-right">
       <a class="btn btn-info mb-1" href="{{ route('subjects.create') }}"><i class="fa fa-book" aria-hidden="true"></i><i class="fa fa-plus" aria-hidden="true"></i></a>
    </div>
</div>




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
                 @foreach ($subjects as $key => $value)
                  <tr>
                    <th scope="row">{{$key+1}}</th>                     
                     <td>{{$value->name}}</td>                     
                     <td>
                      @if ($value->active)
                       Activo
                      @else
                       No activo
                      @endif
                     </td>
                     <td>
                     <a href="{{ route('changeStatusSubject', $value->id) }}" class="btn btn-danger"><i class="fas fa-exchange-alt" aria-hidden="true"></i></a>
                     </td>                     
                     @if (Auth::user()->roles()->first()->name =="Administrador")
                      <td>
                        <a href="{{route('subjects.edit',$value->id)}}" class="btn btn-warning"><i class="fa fa-edit" aria-hidden="true"></i></a>
                      </td>
                     @else
                     <td> <button class="btn btn-warning" disabled=""><i class="fa fa-edit" aria-hidden="true"></i></button> </td>
                     @endif
                     <td> 
                     @if (Auth::user()->roles()->first()->name =="Administrador")
                        <form method="POST" action="{{route('subjects.destroy', $value->id) }}">
                           @csrf
                           <input type="hidden" name="_method" value="delete" />
                           <button class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </form>
                     @else
                     <button class="btn btn-danger" disabled=""><i class="fa fa-trash" aria-hidden="true"></i></button> 
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
