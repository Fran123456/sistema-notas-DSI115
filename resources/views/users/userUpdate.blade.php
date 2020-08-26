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
        <li class="breadcrumb-item active" aria-current="page">Actualizar usuario</li>
      </ol>
    </nav>
  </div>
</div>


<form method="post" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
@csrf
@method('PUT')
<div class="row">
  <div class="col-lg-12">
    <div class="card">
        <div class="card-header"><strong>Edita el usuario {{ $user->name}} </strong></div>
        <div class="card-body card-block">

           <div class="form-group">
            <label  class=" form-control-label">Nombre</label>
              <input type="text" name="name" value="{{$user->name}}" required  class="form-control">
           </div>

           <div class="form-group">
                <label  class=" form-control-label">Correo </label>
                <input type="email" readonly="" name="email" value="{{$user->email}}" required  class="form-control">
           </div>


           <div class="row">

             <div class="col-md-3">
              <p>Foto actual</p>
              <img height="200" width="200" src="{{ asset('images/users/'.$user->photo) }}">
               </div>

              <div class="col-md-4">
               <div class="form-group">
                  <label  class=" form-control-label">Roles</label>
                  <select class="form-control" name="role">
                  @foreach ($roles as $role)
                   @if (Auth::user()->roles()->first()->id  == $role->id)
                     <option selected="" value="{{$role->id}}">{{$role->name}}</option>
                   @else
                     <option value="{{$role->id}}">{{$role->name}}</option>
                   @endif
                  @endforeach
                 </select>
               </div>
             </div>

             <div class="col-md-5">
               <div class="form-group">
                     <label  class=" form-control-label">Foto de perfil</label>
                     <input  type="file" id="file-multiple-input" accept="image/*" name="photo"  class="form-control-file">
                   </div>
                   <div class="form-group">

                    <label for="file-multiple-input" class="form-control-label">Actualizar Hoja de Vida en formato PDF</label>
                    <input type="file" accept="application/pdf" name="pdf" class="form-control-file" >
                  </div>
                 <ul>
                     @if ( is_null($user->curriculum) )
                     <li>
                        <label for="">Sin Hoja de Vida Anexada</label>
                     </li>
                     @else
                     <li>
                        <label for="">Hoja de Vida Actual</label>
                     </li>
                     <li class="list-group-item">
                        <a target="_blank" href="{{asset('files/cv/'.$user->curriculum)}}">{{$user->curriculum}}</a>
                      </li>
                     @endif

                 </ul>

             </div>

             <div class="col-md-12">
              <br>
               <button type="submit" class="btn btn-info mb-1" name="button"><i class="fa fa-plus" aria-hidden="true"></i></button>
             </div>
           </div>

        </div>
    </div>
  </div>
</div>
</form>



@endsection
