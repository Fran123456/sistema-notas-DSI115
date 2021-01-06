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
        <li class="breadcrumb-item"><a href="{{ route('showStudentsDegreeYear',$degreeSchoolYear->id) }}">Estudiantes</a></li>
        <li class="breadcrumb-item active" aria-current="page">Asignar</li>
      </ol>
    </nav>
  </div>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="card">
        <div class="text-center"> <br> <h3>Asignar alumnos</h3></div>
      <div class="card-body">

        <h4>{{Help::ordinal($degree->degree)}} {{$degree->section}}   {{Help::turn($degree->turn)}}</h4>
        <h6>Capacidad del salon: {{$degreeSchoolYear->capacity}}</h6>
        <h6>Docente: {{Help::getTeacher($degreeSchoolYear->user_id)}}</h6>
        <h6>Alumnos por inscribir: {{count($aprobados) + count($reprobados)}}</h6>
        <h6>Alumnos inscritos: {{count($inscritos)}}</h6>
        <h6>Numero de cupos: {{  $degreeSchoolYear->capacity - count($inscritos)}}</h6>
        <hr>
        <form method="POST" action="{{route('asignStudent')}}"  enctype="multipart/form-data">
            @csrf
                <div class="row">
                  <div class="col-md-6">
                      <label>Agregar alumnos:</label>
                    <input hidden value="{{$schoolYear->id}}" name="schoolYear">
                    <input hidden value="{{$degree->id}}" name="degree">
                    <select id="student" size="20"  multiple required name="students[]" class="form-control">
                      @foreach($aprobados as $key => $value)
                            <option selected value="{{$value->student_id}}">{{$value->name}} {{$value->lastname}} ({{$value->student_id}}) </option>
                      @endforeach
                      @foreach($reprobados as $key => $value)
                            <option selected value="{{$value->student_id}}">{{$value->name}} {{$value->lastname}} ({{$value->student_id}}) </option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label>Más cupos si la capacidad de alumnos excede la capacidad del salón:</label> <br>
                    <small>*SE SUGIRIO LA CAPACIDAD PARA HABILITAR DEPENDIENDO LOS ALUMNOS A INSCRIBIR, SI NO DESE ABRIR MÁS CUPOS AGREGUE EL VALOR DE CERO</small>
                    <br>
                    <div class="" id="add">
                     <div id="pad">
                         <label><strong>alumnos seleccionados: {{ count($aprobados) + count($reprobados) }}</strong> </label>
                         <label for="">{{ count($aprobados) + count($reprobados) -  $degreeSchoolYear->capacity + count($inscritos)}}</label>
                     </div>
                    </div>
                    <input id="cupos" class="form-control" type="number" min="0" name="capacity" value="{{ count($aprobados) + count($reprobados) -  $degreeSchoolYear->capacity + count($inscritos)}}">

                    <input type="hidden" name="degreeCapaId" value="{{$degreeSchoolYear->id}}">
                    <br>
                    <button class="btn btn-primary" type="submit" >Guardar cambios  <i class="fa fa-check-circle"></i></button>
                  </div>
                </div>

        </form>
      </div>
    </div>
  </div>
</div>
<br>


<script type="text/javascript">
var capacidad = {{$degreeSchoolYear->capacity}} //definida al inicio
var cupos =$("#cupos").val() ;
let $select = $('#student');
let selecteds = [];
var alumnos = 0;
// Buscamos los option seleccionados
$select.children(':selected').each((idx, el) => {
  alumnos++;
  // Obtenemos los atributos que necesitamos
  selecteds.push({
    id: el.id,
    value: el.value
  });
});


if(capacidad == alumnos){
  $("#cupos").val(0);
}else if(capacidad < alumnos)
  $("#cupos").val(alumnos - capacidad  +{{count($inscritos)}});
else{
  $("#cupos").val(0);
}



$select.on('change', () => {
  var cupos =$("#cupos").val();
let selecteds = [];
var alumnos = 0;
// Buscamos los option seleccionados
$select.children(':selected').each((idx, el) => {
  alumnos++;
  // Obtenemos los atributos que necesitamos
  selecteds.push({
    id: el.id,
    value: el.value
  });
});

//
if(capacidad == alumnos){
  $("#cupos").val(0);
}else if(capacidad < alumnos)
  $("#cupos").val(alumnos - capacidad + {{count($inscritos)}});
else{
  $("#cupos").val(0);
}


var htmlx = '<div id="pad">'+
    '<label><strong>alumnos seleccionados: '+  alumnos  +' </strong> </label>' +
'</div>';
$('#pad').remove();
$('#add').append(htmlx);

});
</script>


@endsection
