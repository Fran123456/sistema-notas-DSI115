@extends('layouts.app')
@section('content')


<div class="row">
    @include('alerts.alerts')
  </div>

  <div class="row">
  <div class="col-md-12">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Cambiar Contraseña</li>
      </ol>
    </nav>
  </div>
</div>

<form method="post" action="{{route('savePassword',$user->id)}}" enctype="multipart/form-data">
    @csrf
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
            <div class="card-header">Cambiar Contraseña:&nbsp; <strong>{{Auth::user()->name}}</strong>
            </div>
            <div class="card-body card-block">

               <div class="form-group">
                <label  class=" form-control-label">Contraseña Actual</label>
                  <input type="password" name="currentPassword"  required  class="form-control"  placeholder="Ingrese Contraseña Actual">
               </div>

               <div class="form-group">
                    <label  class=" form-control-label">Contraseña Nueva </label>
                    <input type="password" name="newPassword"  required  class="form-control" placeholder="Ingrese Nueva Contraseña">
               </div>
               <div class="form-group">
                <label  class=" form-control-label">Confirmar Contraseña Nueva </label>
                <input type="password" name="repeatPassword"  required  class="form-control" placeholder="Repita Nueva Contraseña">
             </div>

                <div class="row form-group">
                   <div class="col-12 col-md-12 col-sx-12">
                     <div class="">
                     <button type="submit" class="btn btn-info mb-1" name="button">Guardar</button>
                   </div>
                  </div>
                </div>
            </div>
        </div>
      </div>
    </div>
    </form>


@endsection

