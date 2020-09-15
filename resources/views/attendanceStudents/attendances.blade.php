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
        <li class="breadcrumb-item active" aria-current="page">Asistencias</li>
      </ol>
    </nav>
  </div>
</div>

<div class="row">
    @foreach($userAsignedDegree as $degree)
                      <div class="col-sm-6">
                      <!--col-lg 3 col-md-3 col-sm-12 col-xs-12-->
                        <div class="card-body">
                          <div class="card" style="width: auto;">
                            <div class="card-body">
                              <!--<h5 class="card-title">-->
                                <div class="table-responsive">
                                  <table class="table table-borderless">
                                    <tr>
                                      <td><strong>Grado</strong></td>
                                      <td>{{$degree->degree->degree}} {{$degree->degree->section}} </td>
                                    </tr>
                                  </table>
                                </div>
                              <!--</h5>-->
                                <div class="table-responsive">
                                  <table class="table">
                                    <thead>
                                      <tr>
                                        <th width="150" scope="col">Fecha</th>
                                        <th width="150" scope="col">Asistencia</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($attendanceDates as $key => $value)
                                        @if($value->degree_id == $degree->id )
                                          <tr>
                                            <td>{{$value->attendance_date}}</td>
                                            <td>{{$value->asistencia}}</td>
                                          </tr>
                                        @endif
                                      @endforeach
                                    </tbody>
                                  </table>
                                </div>
                            </div>
                          </div>
                        </div>
                      </div>
    @endforeach
</div>


@endsection
