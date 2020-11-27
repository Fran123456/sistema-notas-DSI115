@extends('layouts.app')
@section('content')

@include('alerts.dataTable')

<div class="row">
  @include('alerts.alerts')
</div>
  


<div class="row">
  <div class="col-md-12">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('years.index') }}">Años escolares</a></li>
        <li class="breadcrumb-item"><a href="{{ route('teacher-grade',$schoolYear->id) }}">Crear grado, docente para año escolar</a></li>
        <li class="breadcrumb-item active" aria-current="page">BREADCUMB POR CORREGIR</li>
      </ol>
    </nav>
  </div>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="card">
        <br>
        <div class="text-center"><h3>Asignar alumnos</h3></div>                
      <div class="card-body">
        <form method="POST" action="{{route('asignStudent')}}"  enctype="multipart/form-data">
            @csrf            
                
                <input hidden value="{{$schoolYear->id}}" name="schoolYear">
                <input hidden value="{{$degree->id}}" name="degree">
                                                                     
                <select multiple required name="students[]" class="form-control">
                  @foreach($aprobados as $key => $value) 
                        <option value="{{$value->student_id}}">{{$value->name}} {{$value->lastname}}</option>
                  @endforeach  
                  @foreach($reprobados as $key => $value) 
                        <option value="{{$value->student_id}}">{{$value->name}} {{$value->lastname}}</option>
                  @endforeach  
                </select>
            <button class="btn btn-primary" type="submit" >Guardar cambios  <i class="fa fa-check-circle"></i></button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
