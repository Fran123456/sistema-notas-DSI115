@extends('layouts.app')
@section('content')

@include('alerts.dataTable')

<div class="row">
  @include('alerts.alerts')
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
        <strong class="card-title">Usuarios</strong>
      </div>
        <div class="card-body">
            <table class="table" id="bootstrap-data-table_length">
              <thead>
                <tr>
                  <th width="40" scope="col">#</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Correo</th>
                  <th scope="col" width="160">Rol</th>
                  <th width="40" scope="col"> Ver </th>
                  <th width="40" scope="col"> Editar </th>
                  <th width="40" scope="col"> Eliminar </th>
                </tr>
              </thead>
              <tbody>
                 @foreach ($users as $key => $value)
                  <tr>
                    <th scope="row">{{$key+1}}</th>
                     <td>
                        {{$value->name}}
                     </td>
                     <td>
                        {{$value->email}}
                     </td>
                     <td>
                        {{$value->roles()->first()->name}}
                     </td>
                     <td>
                        <a href="" class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i></a>
                     </td>
                      <td>
                        <a href="" class="btn btn-warning"><i class="fa fa-edit" aria-hidden="true"></i></a></td>
                      <td>
                        @if (Auth::user()->id == $value->id)
                          <button disabled="" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        @else
                          <form method="POST" action="{{route('users.destroy', $value->id) }}">
                           @csrf
                           <input type="hidden" name="_method" value="delete" />
                           <button class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </form>
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
