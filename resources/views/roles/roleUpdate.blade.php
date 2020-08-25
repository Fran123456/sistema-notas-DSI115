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
        <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
        <li class="breadcrumb-item active" aria-current="page">Actualizar rol</li>
      </ol>
    </nav>
  </div>
</div>


<form method="post" action="{{ route('roles.update', $role->id) }}" enctype="multipart/form-data">
@csrf
@method('PUT')
<div class="row">
  <div class="col-lg-12">
    <div class="card">
        <div class="card-header"><strong>Edita rol </strong></div>
        <div class="card-body card-block">


           <div class="row">
             <div class="col-md-6">
                <div class="form-group">
                <label  class=" form-control-label">Rol</label>
                  <input type="text" name="name" value="{{$role->name}}" required  class="form-control">
               </div>
             </div>


             <div class="col-md-12">
              
               <button type="submit" class="btn btn-warning mb-1" name="button"><i class="fa fa-edit" aria-hidden="true"></i></button>
             </div>
           </div>

        </div>
    </div>
  </div>
</div>
</form>



@endsection
