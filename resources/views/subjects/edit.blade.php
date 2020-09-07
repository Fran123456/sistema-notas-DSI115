@extends('layouts.app')
@section('content')


<style media="screen">
  .pa{
    padding-top: 35px;
  }
</style>
<form method="POST" action="{{route('subjects.update',$subject->id)}}" enctype="multipart/form-data">
    @method('PUT')
  @csrf
<div class="row">
  <div class="col-lg-12">
                    <div class="card">
                          <div class="card-header"><strong>Editar Materia</strong></div>
                          <div class="card-body card-block">

                                <div class="form-group">
                                  <label  class=" form-control-label">Editar Nombre</label>
                                  <br>
                                  <small>*Requerido</small>

                                  <input type="text" name="name" required value="{{$subject->name}}" class="form-control" >
                                </div>
                                <div class="form-group">
                                    <label  class=" form-control-label">Editar Estado</label>



                                    <select name="state" id="state" class="form-control">

                                       @if ($subject->active == 1)
                                       <option value="1" selected>Activo</option>
                                       <option value="0">Inactivo</option>
                                       @else
                                       <option value="1">Activo</option>
                                       <option value="0" selected>Inactivo</option>
                                       @endif
                                    </select>
                                  </div>
                                  <div class="row form-group">
                                    <div class="col-6 col-md-6 col-sx-12">
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
