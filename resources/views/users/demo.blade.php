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
        <li class="breadcrumb-item active" aria-current="page">*</li>
      </ol>
    </nav>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <p>
      <h5>Nombre: {{ Auth::user()->name  }}</h5>
      <h5>Rol: {{ Auth::user()->roles()->first()->name  }}</h5>
    </p>
    {{ json_encode(Auth::user()) }}
  </div>
</div>



@endsection
