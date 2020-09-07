@extends('layouts.app')
@section('content')
@include('alerts.dataTable')

<style media="screen">
.bg-success {
  background-color: #3ac47d52 !important;
}
</style>

<div class="row">
  @include('alerts.alerts')
</div>

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
        <li class="breadcrumb-item active" aria-current="page">Eliminar grado escolar</li>
      </ol>
    </nav>
  </div>
</div>



<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
        <strong class="card-title">Eliminar el grado {{Help::ordinal($degree->degree)}} {{$degree->section}} {{ Help::turn($degree->turn)}}</strong>
      </div>
        <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                @include('schoolYear.div.SubjectDeleteTable')
              </div>
              <div class="col-md-6">
                <h6> <strong>Grado:</strong> {{Help::ordinal($degree->degree)}} {{$degree->section}} {{ Help::turn($degree->turn)}} {{$schoolYear->year}} -
                  Capacidad: {{$year->capacity}}</h6>
                <h6><strong># materias:</strong> {{count($subjectsGrade)}} </h6>
                <br>
                Si desea eliminar el grado escolar, tener en cuenta que se eliminaran las
                asignaciones de materia -> docente y a su vez la distribución de los alumnos para dicho
                grado escolar.
                <br><br>

                <a href="" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
              </div>
            </div>
      </div>
    </div>
  </div>
</div>



@endsection
