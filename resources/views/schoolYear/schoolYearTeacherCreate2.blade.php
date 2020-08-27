@extends('layouts.app')
@section('content')


<div class="row">
  @include('alerts.alerts')
</div>
<style media="screen">
  .pa{
    padding-top: 35px;
  }

  .modal-backdrop {
    position: unset;
    top: 0;
    left: 0;
    z-index: 1040;
    width: 100vw;
    height: 100vh;
    background-color: #000;
}
</style>

<div class="row">
  <div class="col-md-12">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('years.index') }}">Años escolares</a></li>
        <li class="breadcrumb-item active" aria-current="page">Crear grado, docente para año escolar</li>
      </ol>
    </nav>
  </div>
</div>

<form method="post" action="{{ route('storeYearTeacher') }}" enctype="multipart/form-data">
@csrf
<div class="row">
  <div class="col-lg-12">
    <div class="card">
        <div class="card-header"><strong>Crear salones y docentes para año escolar </strong></div>
        <div class="card-body card-block">

          <div class="row">
            <div class="col-md-12">
              <h6> <strong>Fecha de finalización: </strong> {{Help::dateFormatter($year->end_date)}}</h6>
              <h6> <strong>Fecha de inicio: </strong> {{Help::dateFormatter($year->start_date)}} </h6>
              <h6> <strong>Año: </strong> {{$year->year}}</h6>
              <h6> <strong>Estado: </strong> {{Help::status($year->active)}}</h6>
            </div>
            <br>
          </div>

          <hr>

          <div class="row">

            <div class="col-md-5">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                   <label>Docente</label>
                   <select name="user_id" required="" class="form-control">
                     @foreach ($teachers as $key => $value)
                         <option value="{{$value->id}}">{{$value->name}}</option>
                     @endforeach
                   </select>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                   <label>Grado</label>
                   <select name="degree_id" required="" class="form-control">
                     @foreach ($degrees as $key => $value)
                         <option value="{{$value->id}}">{{Help::ordinal($value->degree)}} {{$value->section}} - {{Help::turn($value->turn)}}</option>
                     @endforeach
                   </select>
                  </div>
                </div>

                <input type="hidden" name="school_year_id" value="{{$year->id}}">

                <div class="col-md-6">
                    <div class="form-group">
                     <label  class="">Capacidad del salon</label>
                       <input type="number" min="1" max="100" name="capacity" value="{{old('capacity')}}" required  class="form-control">
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


            <div class="col-md-7">
              <div class="col-md-12">
                @include('schoolYear.div.gradeTable')
              </div>
            </div>

          </div>
        </div>
    </div>
  </div>
</div>
</form>



@endsection
