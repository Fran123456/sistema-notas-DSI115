@extends('layouts.app')
@section('content')


<style media="screen">
  .pa{
    padding-top: 35px;
  }
</style>

@include('alerts.dataTable')

<div class="row">
  @include('alerts.alerts')
</div>

{{--<div class="row">
  <div class="col-md-12">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('years.index') }}">Años escolares</a></li>
       <li class="breadcrumb-item"><a href="{{ route('teacher-grade',$year_grade->id) }}">Año escolar activo</a></li>


        <li class="breadcrumb-item active" aria-current="page">Editar grado: {{Help::ordinal($degreeSelected->degree)}} {{$degreeSelected->section}} - {{Help::turn($degreeSelected->turn)}}</li>
      </ol>
    </nav>
  </div>
</div> --}}



<form method="POST" action="{{route('behaviors.store')}}" enctype="multipart/form-data">

  @csrf
<div class="row">
  <div class="col-lg-12">
                    <div class="card">
                          <div class="card-header"><strong>Crear Indicador de Conducta</strong></div>

                          <div class="card-body card-block">

                            <div class="form-group">
                                <label  class=" form-control-label">Nombre</label>
                                <br>
                                <small>*requerido</small>
                                <input type="text" name="name" required  class="form-control" placeholder="Ingrese Nombre del Indicador de Conducta , ejem MUY BUENO">
                             </div>

                             <div class="form-group">
                                <label  class=" form-control-label">Codigo</label>
                                <br>
                                <small>*requerido</small>
                                <input type="text" name="code" required  class="form-control" placeholder="Ingrese un codigo del indicador de conducta, ejem MB(MUY BUENO)">
                             </div>
                             <div class="form-group">
                                <label  class=" form-control-label">Descripcion</label>

                                <textarea name="description" id="" cols="30" rows="10" class="form-control"  placeholder="Agregue una Descripcion"></textarea>
                             </div>


                                  <div class="row form-group">
                                    <div class="col-6 col-md-6 col-sx-12">
                                      <div class="">
                                        <button type="submit" class="btn btn-warning mb-1" name="button">Guardar   <i class="fa fa-edit" aria-hidden="true"></i></button>
                                      </div>
                                    </div>
                                </div>
                        </div>
                  </div>
      </div>
</div>
</form>



@endsection
