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
        <li class="breadcrumb-item"><a href="{{ route('years.index') }}">Años escolares</a></li>
        <li class="breadcrumb-item"><a href="{{ route('teacher-grade',$schoolYear->id) }}">
          {{Help::ordinal($degree->degree)}} {{$degree->section}} {{ Help::turn($degree->turn)}} {{$schoolYear->year}} -
          Capacidad: {{$year->capacity}}
        </a></li>
        <li class="breadcrumb-item active" aria-current="page">Agrega materias a un grado escolar</li>
      </ol>
    </nav>
  </div>
</div>


<div class="row">
  <div class="col-lg-12">
    <div class="card">
        <div class="card-header"><strong>Crear materias para: {{Help::ordinal($degree->degree)}} {{$degree->section}} {{ Help::turn($degree->turn)}} {{$schoolYear->year}} </strong></div>
        <div class="card-body card-block">
        @if($schoolYear->finish == 0)
          @if (count($subjects)>0)
            <form method="post" action="{{ route('saveSubjectsDegree') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-md-3">
                  <div class="form-group">
                    <label  class=" form-control-label">Materia</label>
                    <select class="form-control" name="subject_id">
                      @foreach ($subjects as $key => $value)
                        <option value="{{$value->id}}">{{$value->name}}</option>
                      @endforeach
                    </select>
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="form-group">
                    <label  class=" form-control-label">Docente encargado</label>
                    <select class="form-control" name="user_id">
                      @foreach ($teachers as $key => $value)
                        <option value="{{$value->id}}">{{$value->name}}</option>
                      @endforeach
                    </select>
                  </div>
              </div>

              <input type="hidden" name="school_year_id" value="{{$schoolYear->id}}">
              <input type="hidden" name="degree_id" value="{{$degree->id}}">

            </div>

            <div class="row form-group">
                <div class="col-12 col-md-12 col-sx-12">
                  <div class="">
                  <button type="submit" class="btn btn-info mb-1" name="button"><i class="fa fa-plus" aria-hidden="true"></i></button>
                </div>
              </div>
            </div>
            </form>
              @else
                <h5 class="text-center">Ya no hay materias para distribuir</h5>
              @endif
            @else
              <h5 class="text-center"><strong>Año {{$schoolYear->year}} finalizado</strong></h5>
            @endif

        </div>

        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              @if (count($subjectsGrade)>0)
               @include('schoolYear.div.subjectTable')
               @else
                <div class="text-center">
                  <br>
                <h4>No hay materias asignadas por el momento</h4>
                <br>
                </div>
              @endif

            </div>
          </div>
        </div>
    </div>
  </div>
</div>




@endsection
