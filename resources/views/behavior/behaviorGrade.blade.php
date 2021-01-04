@extends('layouts.app')
@section('content')




<div class="row">
  @include('alerts.alerts')
</div>

<div class="row">
    <div class="col-md-12">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('years.index') }}">Años escolares</a></li>
          <li class="breadcrumb-item"><a href="{!! route('periods-index', $year) !!}">Periodos Escolares</a></li>
          <li class="breadcrumb-item active" aria-current="page">Conducta por periodo: {{$p->nperiodo}} - {{$p->year->year}}</li>
        </ol>
      </nav>
    </div>
  </div>


<div class="row">
  <div class="col-lg-12">
      <div class="card">
        <div class="card-header"><strong>Resumen de conducta por grado para el periodo: {{$p->nperiodo}} - {{$p->year->year}}  </strong></div>
          <div class="card-body card-block">

            <div class="row">
              @foreach ($finish as $key => $element)
                <div class="col-md-6">
                <div class="card">
                      <div class="card-body">
                        @php
                          $c =0;
                        @endphp
                       @foreach ($element as $key2 => $element2)
                        @if ($key2 == 0)
                           <h5><strong>{{$element2['grade']}}</strong></h5><br>
                          @endif  
                        {{$element2['behavior']}} <strong>{{$element2['behavior_code']}}</strong>    <span class="badge badge-secondary">{{$element2['count']}}</span> <br>
                        @php
                          $c+=$element2['count']
                        @endphp
                       @endforeach
                       Total alumnos <span class="badge badge-success">{{$c}}</span><br><br>
                       <strong>Reporte de conducta:</strong>
                      <a href="{{ route('period-behavior.pdf', [$element2['gradeId'], $p->nperiodo, $p->year]) }}" class="btn btn-dark"><i class="fa fa-clipboard-list" aria-hidden="true"></i></a>            
                      </div>
                    </div><br>
                    
              </div>
              <br><br>
              @endforeach
             
            </div>



          </div>
    </div>
  </div>
</div>




@endsection
