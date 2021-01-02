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
              <div class="col-md-4">
                <div class="card">
                      <div class="card-body">
                        This is some text within a card body.
                      </div>
                    </div>
              </div>
            </div>



          </div>
    </div>
  </div>
</div>




@endsection
