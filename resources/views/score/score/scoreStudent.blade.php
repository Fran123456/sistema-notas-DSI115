@extends('layouts.app')
@section('content')
<style type="text/css">
  .card-header {
    padding: .75rem 1.25rem;
    margin-bottom: 0;
    color: inherit;
    background-color: #9e9e9e1f;
    border-bottom: 1px solid rgba(26,54,126,0.125);
}

.card2 {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #2196f330;
    background-clip: border-box;
    border: 1px solid rgba(26,54,126,0.125);
    border-radius: .25rem;
}

.card-body {
    flex: 1 1 auto;
    padding: 1.25rem;
    padding-top: 1rem;
    padding-right: 1.25rem;
    padding-bottom: 0.1rem;
    padding-left: 1.25rem;
}
</style>
@include('alerts.dataTable')

<div class="row">
  @include('alerts.alerts')
</div>

<div class="row">
  <div class="col-md-12">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item">
          <a href="{{ route('showStudentsDegreeTeacher', [$teacher, $degree->id]) }}">
          Alumnos del {{Help::ordinal($degree->id)}} {{$degree->section}}
          {{Help::turn($degree->turn)}}</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Notas de {{$student->name}}
         -  Periodo: {{$period->nperiodo}}
          {{$year->year}}
        </li>
      </ol>
    </nav>
  </div>
</div>

@if ($look == 1)
<form method="get" action="" enctype="multipart/form-data">
  <div class="row ">
      <div class="col-md-4">
         <div class="form-group">
           <input placeholder="Nombre alumno" class="form-control" type="text" name="student" value="">
         </div>
       </div>
       <div class="mb-1">
          <button type="submit" class="btn btn-info mb-1" ><i class="fa fa-search" aria-hidden="true"></i></button>
       </div>
    </div>
  </form>
@endif


<div class="row">
  <div class="col-lg-12">
    <div class="card">
       <div class="card-header">
        <strong class="card-title">{{$student->name}} - Periodo: {{$period->nperiodo}}
          {{$year->year}} - {{Help::ordinal($degree->id)}} {{$degree->section}}
          {{Help::turn($degree->turn)}}</strong>
       </div>
        <div class="card-body">
            @foreach ($degrees as $key => $element) <!--INICIO AQUI SE IMPRIMEN LAS MATERIAS-->
            <div class="card2">
              <div class="card-body">
                <h5 class="card-title">{{$element->subject->name}} -
                  Docente: {{$element->docente->name}}
                </h5>
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  @php
                    $con =0;
                    $notaff = 0;
                  @endphp
                  <form method="get" action="{{ route('updateScores') }}" enctype="multipart/form-data">
                   <table class="table text-center table-sm table-bordered">
                      <thead class="thead-light">
                        <tr>
                          @foreach ($types as $type) <!--NOTAS-->
                           @if ($type->subject_id==$element->subject->id)
                           <th data-toggle="tooltip" data-placement="top"
                           title="{{$type->score_types->activity}}">
                            {{number_format($type->score_types->percentage,2)}}%
                           </th>
                           @php
                             $con++;
                           @endphp
                           @endif
                          @endforeach <!--NOTAS-->
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          @foreach ($types as $type) <!--NOTAS-->
                           @if ($type->subject_id==$element->subject->id)
                             @php
                               $notaff = ($type->score * ($type->score_types->percentage/100)  )  + $notaff;
                             @endphp
                           <th scope="row">
                            <input type="number" min="0.00" max="10.00" step="0.01" class="form-control" name="{{$type->id}}"
                            value="{{number_format($type->score,2)}}">
                           </th>
                           @endif
                          @endforeach <!--NOTAS-->
                          @if ($con>0)
                          <th scope="row">
                            <button data-toggle="tooltip" data-placement="top" title="Click para guardar" type="submit" class="btn btn-info mb-1" ><i class="fa fa-save" aria-hidden="true"></i></button>
                          </th>
                          @endif
                        </tr>
                      </tbody>
                    </table>

                    @if ($con>0)
                      <h5>Calificación global: <span class="badge badge-secondary">{{number_format($notaff,2)}}</span>
                        @if ($notaff >= 6)
                          <i class="fa fa-smile" aria-hidden="true"></i>
                        @else
                          <i class="fa fa-frown" aria-hidden="true"></i>
                        @endif
                      </h5>

                    @endif


                    <!--HIDENS-->
                      <input type="hidden" value="{{$element->subject->id}}" name="subject">
                      <input type="hidden" value="{{$student->id}}" name="student">
                      <input type="hidden" value="{{$degree->id}}" name="degree">
                      <input type="hidden" value="{{$period->id}}" name="period">
                     <!--HIDENS-->
                    </form>

                </li>
              </ul>
            </div>
            <br>
            @endforeach <!--INICIO AQUI SE IMPRIMEN LAS MATERIAS-->
      </div>
    </div>
  </div>
</div>

@endsection
