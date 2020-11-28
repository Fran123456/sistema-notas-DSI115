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
          <li class="breadcrumb-item"><a href="{{ route('students.index') }}">Estudiantes</a></li>
          <li class="breadcrumb-item active" aria-current="page">Crear un nuevo estudiante</li>
        </ol>
      </nav>
    </div>
  </div>

  <form method="post" action="{{ route('studentCreate') }}" enctype="multipart/form-data">
  @csrf
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header"><strong>Crear un nuevo estudiante - periodo: {{$actually->year}}</strong></div>

        <div class="card-body card-block">
          <div class="row">
            <div class="col-md-12">
              <h4>Información del alumno</h4>
              <hr>
            </div>

            <input type="hidden" name="school_year_id" value="{{$actually->id}}">

            <div class="col-md-5">
              <div class="form-group">
                <label  class=" form-control-label">Nombre</label>
                <input type="text"  name="name" required  class="form-control">
              </div>
            </div>

            <div class="col-md-5">
              <div class="form-group">
                <label  class=" form-control-label">Apellido</label>
                <input type="text" name="lastname" required  class="form-control">
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <label  class=" form-control-label">Edad</label>
                <input type="number" min="1" name="age" required  class="form-control">
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <label  class=" form-control-label">Genero</label>
                 <select class="form-control" name="gender">
                   <option value="M">Masculino</option>
                   <option value="F">Femenino</option>
                 </select>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label  class=" form-control-label">Telefono</label>
                   <input type="tel" min="1" name="phone" required  class="form-control">
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label  class=" form-control-label">Grado escolar</label>
                  <select class="form-control" name="degree_id">
                    @foreach ($degrees as $key => $value)
                      @if($value->turn == 'm')
                      <option value="{{$value->id}}">{{Help::ordinal($value->degree)}} {{$value->section}} Matutino</option>
                      @else
                      <option value="{{$value->id}}">{{Help::ordinal($value->degree)}} {{$value->section}} Vespertino</option>
                      @endif
                    @endforeach
                  </select>
              </div>
            </div>


            <div class="col-md-3">
              <div class="form-group">
                <label  class=" form-control-label">Estado</label>
                <select class="form-control" name="status">
                  @foreach (Help::getTypeStudent() as $key => $value)
                    <option value="{{$value[0]}}">{{$value[1]}}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <label  class=" form-control-label">Dirección</label>
                <textarea name="address" class="form-control" rows="3" cols="80"></textarea>
              </div>
            </div>


            <div class="col-md-12">
              <br>
              <h4>Información de los padres</h4>
              <hr>
            </div>

            <div class="col-md-8">
              <div class="form-group">
                <label  class=" form-control-label">Nombre completo encargado</label>
                <input type="text" name="parent_name" required  class="form-control">
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label  class=" form-control-label">Dui</label>
                <input type="text" name="parent_DUI" required  class="form-control">
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
