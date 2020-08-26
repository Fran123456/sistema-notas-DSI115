@extends('layouts.app')
@section('content')


<style media="screen">
  .pa{
    padding-top: 35px;
  }
</style>
<form method="post" action="{{route('degree_update',$degree->id)}}" enctype="multipart/form-data">
  @csrf
<div class="row">
  <div class="col-lg-12">
                    <div class="card">
                          <div class="card-header"><strong>Editar Grado</strong></div>
                          <div class="card-body card-block">

                                <div class="form-group">
                                  <label  class=" form-control-label">Grado</label>
                                  <input type="text" name="degree" required value="{{$degree->degree}}" class="form-control" >
                                </div>

                                <div class="form-group">
                                  <label  class=" form-control-label">Seccion</label>
                                  <input type="text" name="section" required value="{{$degree->section}}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="turn">Turno </label>
                                    <select class="form-control" id="turn" name="turn">
                                      @if ($degree->turn == 'm')
                                      <option value="m" selected>Turno Matutino </option>
                                      <option value="t">Turno Vespertino </option>
                                      @else
                                      <option value="m" >Turno Matutino </option>
                                      <option value="t" selected>Turno Vespertino </option>
                                      @endif

                                    </select>
                                  </div>
                                  <div class="form-group">
                                    <label for="active">Estado </label>
                                    <select class="form-control" id="active" name="active">
                                      @if ($degree->active == 1)
                                      <option value="1" selected>Activo </option>
                                      <option value="0">Inactivo </option>
                                      @else
                                      <option value="1" >Activo </option>
                                      <option value="0" selected>Inactivo </option>
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
