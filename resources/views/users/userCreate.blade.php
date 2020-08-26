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
        <li class="breadcrumb-item active" aria-current="page">Crear usuario</li>
      </ol>
    </nav>
  </div>
</div>

<form method="post" action="{{ route('users.store') }}" enctype="multipart/form-data">
@csrf
<div class="row">
  <div class="col-lg-12">
    <div class="card">
        <div class="card-header"><strong>Crear un nuevo usuario </strong></div>
        <div class="card-body card-block">

           <div class="row">
             <div class="col-md-6">
                 <div class="form-group">
                  <label  class=" form-control-label">Nombre</label>
                    <input type="text" name="name" value="{{old('name')}}" required  class="form-control">
                 </div>
             </div>
             <div class="col-md-6">
                 <div class="form-group">
                      <label  class=" form-control-label">Correo </label>
                      <input type="email" name="email" value="{{old('email')}}" required  class="form-control">
                 </div>
             </div>
           </div>


           <div class="row">
             <div class="col-md-6">
                 <div class="form-group">
                  <label  class=" form-control-label">Telefono</label>
                    <input type="number" min="0" name="phone" value="{{old('name')}}" required  class="form-control">
                 </div>
             </div>
             <div class="col-md-6">
                 <div class="form-group">
                      <label  class=" form-control-label">Dirección </label>
                      <input type="text" name="address" value="{{old('email')}}" required  class="form-control">
                 </div>
             </div>
           </div>

           <div class="row">
             <div class="col-md-6">
               <div class="form-group">
                 <label  class=" form-control-label">Contraseña </label>
                 <input type="password" name="password" value="{{old('password')}}" required  class="form-control">
               </div>
             </div>
             <div class="col-md-6">
               <div class="form-group">
                  <label  class=" form-control-label">Roles</label>
                  <select class="form-control" name="role">
                  @foreach ($roles as $role)
                    <option value="{{$role->id}}">{{$role->name}}</option>
                  @endforeach
                 </select>
               </div>
             </div>
           </div>

          <div class="row">

            <div class="col-md-6">

            <div class="form-group">
             <label for="file-multiple-input" class=" form-control-label">Foto de perfil</label>
             <input  type="file" id="file-multiple-input" accept="image/*" name="photo"  class="form-control-file">
           </div>
           <div class="form-group">

            <label for="file-multiple-input" class="form-control-label">Agregar Hoja de Vida en formato PDF</label>
            <input type="file" accept="application/pdf" name="pdf" class="form-control-file" >
          </div>

            </div>

            <div class="col-md-6">

            <div class="form-group">
             <label for="file-multiple-input" class=" form-control-label">Currículum</label>
             <input  type="file" id="file-multiple-input" accept="application/pdf" name="cv"  class="form-control-file">
           </div>

            </div>

          </div>


         

          

            <div class="row form-group">
               <div class="col-12 col-md-12 col-sx-12">
                 <div class="">
                 <button type="submit" class="btn btn-info mb-1" name="button"><i class="fa fa-plus" aria-hidden="true"></i></button>
               </div>
              </div>
            </div>
        </div>
    </div>
  </div>
</div>
</form>



@endsection
