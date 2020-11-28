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
          <li class="breadcrumb-item active" aria-current="page">Editar estudiante</li>
        </ol>
      </nav>
    </div>
  </div>

  <form method="post" action="{{route('student_update', $student->id)}}" enctype="multipart/form-data">
  @csrf
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header"><strong>Editar estudiante - periodo: {{$actually->year}}</strong></div>


        <div class="card-body card-block">
          <div class="row">
            <div class="col-md-12">
              <h4>Información del alumno</h4>
              <hr>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label  class=" form-control-label">Nombre</label>
                <input type="text"  name="name" required value="{{$student->name}}"  class="form-control">
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label  class=" form-control-label">Apellido</label>
                <input type="text" name="lastname" required value="{{$student->lastname}}"  class="form-control">
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <label  class=" form-control-label">Edad</label>
                <input type="number" min="1" name="age" required value="{{$student->age}}"  class="form-control">
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <label  class=" form-control-label">Género</label>
                 <select class="form-control" name="gender">
                  @if($student->gender == 'M')
                   <option value="M" selected>Masculino</option>
                   <option value="F">Femenino</option>
                   @else
                  <option value="F" selected>Femenino</option>
                  <option value="M">Masculino</option>
                  @endif
                 </select>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label  class=" form-control-label">Teléfono</label>
                   <input type="tel" min="1" name="phone" required value="{{$student->phone}}"  class="form-control">
              </div>
            </div>            
            <div class="col-md-2">
              <div class="form-group">
                <label  class=" form-control-label">Grado escolar</label>
                  <select class="form-control" name="degree">
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


            <div class="col-md-2">
              <div class="form-group">
                <label  class=" form-control-label">Estado</label>
                <select class="form-control" name="status">
                  @foreach (Help::getTypeStudent() as $key => $value)
                    <option value="{{$value[0]}}">{{$value[1]}}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="col-md-5">
              <div class="form-group">
                <label  class=" form-control-label">Dirección</label>
                   <input type="text" name="address" required value="{{$student->address}}"  class="form-control">
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
                <input type="text" name="parent_name" required value="{{$student->parent_name}}"  class="form-control">
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label  class=" form-control-label">DUI</label>
                <input type="text" name="parent_DUI" required value="{{$student->parent_DUI}}"  class="form-control">
              </div>
            </div>

          </div>

          <div class="row form-group">
            <div class="col-12 col-md-12 col-sx-12">
              <div class="">
                <button type="submit" class="btn btn-warning mb-1" name="button"><i class="fa fa-edit" aria-hidden="true"></i></button>
              </div>
            </div>
          </div>

          </div>
      </div>
    </div>
  </div>

  </form>

  @endsection
