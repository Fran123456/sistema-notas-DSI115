@extends('layouts.app')
@section('content')


<div class="row">
  @include('alerts.alerts')
</div>
<style media="screen">
  .pa{
    padding-top: 35px;
  }
</style>

<div class="row">
  <div class="col-md-12">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuarios</a></li>
        <li class="breadcrumb-item active" aria-current="page">Usuario</li>
      </ol>
    </nav>
  </div>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="card">
        <div class="card-header"><strong>Información del usuario </strong></div>
        <div class="card-body card-block">
          <div class="row">
            <div class="col-md-2 col-xs-12">
              <p class="text-center">Foto actual</p>
              <img height="200" width="200" src="{{ asset('images/users/'.$user->photo) }}">
            </div>
            <div class="col-md-10 col-xs-12">
                 <p>
                  <h5>Nombre: <strong> {{$user->name}}</strong></h5>
                  <h5>Rol: <strong> {{Auth::user()->roles()->first()->name}}</strong></h5>
                  <h5>Correo: <strong> {{$user->email}}</strong></h5>
                  <h5>Fecha de creación: <strong> {{$created_at}}</strong></h5>
                </p>
            </div>
          </div>

        </div>
    </div>
  </div>
</div>




@endsection
