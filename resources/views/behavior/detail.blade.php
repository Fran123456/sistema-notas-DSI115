@extends('layouts.app')
@section('content')
@include('alerts.dataTable')
<strong class="card-title"></strong>

<div class="row">

    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
         <!-- <strong class="card-title"> {{Help::ordinal($degree->degree)}} {{$degree->section}} - {{Help::turn($degree->turn)}}. <br>PERIODO EN CURSO DEL AÑO ESCOLAR: PERIODO  </strong> -->


          <strong class="card-title">
            ASIGNACION DE INDICADORES DE CONDUCTA PARA: {{Help::ordinal($degree->degree)}} {{$degree->section}} - {{Help::turn($degree->turn)}}
            <br>PERIODO EN CURSO DEL AÑO ESCOLAR: PERIODO {{$periodo->nperiodo}} <br>
           </strong>
        </div>
        <div>

        </div>

          <div class="card-body">

            <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th width="40" scope="col">#</th>
                    <th scope="col" class="text-center" width="40">Nombre</th>
                    <th scope="col" class="text-center" width="40">Apellido</th>
                    <th scope="col"  class="text-center"  width="40">Conducta</th>



                  </tr>
                </thead>


                <tbody>
                    @foreach ($students as $key=> $item)
                    <tr style="font-size: 90%">


                        @csrf

                       <th scope="row">{{$key+1}}</th>
                       <td class="text-center">    {{$item->nombre}}      </td>
                       <td class="text-center"> {{$item->lastname}}  </td>
                       <td class="text-center">{{$item->name}} ({{$item->code}})</td>

                    </tr>
                    @endforeach
              </tbody>
            </table>

        </div>
      </div>
    </div>

  </div>



@endsection
