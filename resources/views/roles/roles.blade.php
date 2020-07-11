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
        <li class="breadcrumb-item active" aria-current="page">Roles</li>
      </ol>
    </nav>
  </div>
</div>



<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
        <strong class="card-title">Roles</strong>
      </div>
        <div class="card-body">
            <table class="table" id="bootstrap-data-table_length">
              <thead>
                <tr>
                  <th width="40" scope="col">#</th>
                  <th scope="col">Rol</th>
                  <th width="40" scope="col"> Editar </th>
                </tr>
              </thead>
              <tbody>
                 @foreach ($roles as $key => $value)
                  <tr>
                    <th scope="row">{{$key+1}}</th>
                     <td>
                        {{$value->name}}
                     </td>

                      <td>
                        <a href="{{ route('roles.edit', $value->id) }}" class="btn btn-warning"><i class="fa fa-edit" aria-hidden="true"></i></a>
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
