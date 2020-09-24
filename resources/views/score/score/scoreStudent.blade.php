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
            @foreach ($degrees as $key => $element)
            <div class="card2">
              <div class="card-body">
                <h5 class="card-title">{{$element->subject->name}} - 
                  Docente: {{$element->docente->name}}
                </h5>
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  
                  <form method="get" action="{{ route('updateScores') }}" enctype="multipart/form-data">
                   <table class="table text-center table-sm table-bordered">
                      <thead class="thead-light">
                        <tr>
                          @php
                            $con =0;
                          @endphp
                          @foreach ($types as $type)
                           @if ($type->subject_id==$element->subject->id)
                           <th data-toggle="tooltip" data-placement="top" 
                           title="{{$type->score_types->activity}}">
                            {{$type->score_types->percentage}}%
                           </th>
                           @php
                             $con++;
                           @endphp
                           @endif
                          @endforeach
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          @foreach ($types as $type)
                           @if ($type->subject_id==$element->subject->id)
                           <th scope="row">
                            <input type="number" class="form-control" name="{{$type->id}}" 
                            value="{{$type->score}}">
                           </th>
                           @endif
                          @endforeach
                          @if ($con>0)
                          <th scope="row">
                            <button type="submit" class="btn btn-info mb-1" ><i class="fa fa-plus" aria-hidden="true"></i></button>
                          </th>
                          @endif
                          
                        </tr>
                      </tbody>
                    </table>

                    <!--HIDENS-->
                      <input type="{{$element->subject->id}}" name="subject">
                     <!--HIDENS--> 
                    </form>
                   
                </li>
              </ul>
            </div>
            <br>
            @endforeach
      </div>
    </div>
  </div>
</div>

@endsection
