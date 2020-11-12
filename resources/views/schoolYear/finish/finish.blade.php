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
          <li class="breadcrumb-item active" aria-current="page">Finalizar</li>
        </ol>
      </nav>
    </div>
  </div>


  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header"><strong>Finalizar un año escolar</strong></div>
        <div class="card-body card-block">
          <div class="row">

            <div class="col-md-12">
            @if (count($periods2) > 0)
                <h4>Para poder finalizar año escolar deben haber finalizado los periodos escolares.</h4>
            @else
              <a class="btn btn-info mb-1"  href="{!! route('finishProcess', $year->id) !!}"><i class="fa fa-check" aria-hidden="true"></i></a>
            
            @endif
            </div>

            <div class="col-md-6">
              <table class="table">
                  <thead class="thead-dark">
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Fecha inicio</th>
                      <th scope="col">Fecha finalización</th>
                      <th scope="col">Finalizado</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($periods as $key => $value)
                      <tr>
                        <th scope="row">{{$value->nperiodo}}</th>
                        <th >{{$value->start_date}}</th>
                        <th >{{$value->end_date}}</th>
                          <th>@if ($value->finish == true)
                            Finalizado
                          @else
                            En curso
                          @endif</th>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
            </div>

          </div>
          </div>
      </div>
    </div>
  </div>


  @endsection
