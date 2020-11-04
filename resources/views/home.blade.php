@extends('layouts.app')

@section('content')

<div class="row">

@php
    $act1 = array( 
           array(
             'Actividades','act 1',10
           ),
           array(
             'Actividades','act 2',10
           ),
           array(
             'Actividades','act 3',20
           ),
           array(
             'Actitud','actitud',20
           ),
           array(
             'Prueba Objetiva','Examen',40
           ),
         );
$faker  = Faker\Factory::create();
$d = $faker->dateTimeBetween($startDate = '-7 months', $endDate = 'now', $timezone = null);
print_r($d->format('Y-m-d'));
@endphp





                <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="progress-box progress-1">
                                    <h4 class="por-title">Visits</h4>
                                    <div class="por-txt">96,930 Users (40%)</div>
                                    <div class="progress mb-2" style="height: 5px;">
                                        <div class="progress-bar bg-flat-color-1" role="progressbar" style="width: 40%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="progress-box progress-2">
                                    <h4 class="por-title">Bounces Rate</h4>
                                    <div class="por-txt">3,220 Users (24%)</div>
                                    <div class="progress mb-2" style="height: 5px;">
                                        <div class="progress-bar bg-flat-color-2" role="progressbar" style="width: 24%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>

                            </div> <!-- /.card-body -->
                        </div>
                </div>

                <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="progress-box progress-1">
                                    <h4 class="por-title">Visits</h4>
                                    <div class="por-txt">96,930 Users (40%)</div>
                                    <div class="progress mb-2" style="height: 5px;">
                                        <div class="progress-bar bg-flat-color-1" role="progressbar" style="width: 40%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="progress-box progress-2">
                                    <h4 class="por-title">Bounce Rate</h4>
                                    <div class="por-txt">3,220 Users (24%)</div>
                                    <div class="progress mb-2" style="height: 5px;">
                                        <div class="progress-bar bg-flat-color-2" role="progressbar" style="width: 24%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>

                            </div> <!-- /.card-body -->
                        </div>
                </div>

                <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="progress-box progress-1">
                                    <h4 class="por-title">Visits</h4>
                                    <div class="por-txt">96,930 Users (40%)</div>
                                    <div class="progress mb-2" style="height: 5px;">
                                        <div class="progress-bar bg-flat-color-1" role="progressbar" style="width: 40%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="progress-box progress-2">
                                    <h4 class="por-title">Bounce Rate</h4>
                                    <div class="por-txt">3,220 Users (24%)</div>
                                    <div class="progress mb-2" style="height: 5px;">
                                        <div class="progress-bar bg-flat-color-2" role="progressbar" style="width: 24%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>

                            </div> <!-- /.card-body -->
                        </div>
                </div>
    </div>

@endsection

@section('script')
  


@endsection
