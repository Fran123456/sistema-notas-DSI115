@extends('layouts.app')
@section('content')
@include('alerts.dataTable')
<div class="row">
    <div class="col-md-12">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('gradesTeacher',Auth::user()->id) }}">Administración de docente - Año escolar {{Help::getSchoolYear()->year}}</a></li>
          <li class="breadcrumb-item"><a href="{{ route('behaviors-all',$degree->id) }}">Registros de Indicadores de Conducta</a></li>
          <li class="breadcrumb-item active" aria-current="page">Registrar Datos</li>
        </ol>
      </nav>
    </div>
  </div>

<div class="row">

    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
         <!-- <strong class="card-title"> {{Help::ordinal($degree->degree)}} {{$degree->section}} - {{Help::turn($degree->turn)}}. <br>PERIODO EN CURSO DEL AÑO ESCOLAR: PERIODO  </strong> -->


          <strong class="card-title">
            ASIGNACION DE INDICADORES DE CONDUCTA PARA: {{Help::ordinal($degree->degree)}} {{$degree->section}} - {{Help::turn($degree->turn)}}
            <br>PERIODO EN CURSO DEL AÑO ESCOLAR: PERIODO {{$activePeriod[0]->nperiodo}} <br>
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

                       <form action="{{route('behaviors-register-save')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="school_period_id[]" value="{{$activePeriod[0]->id}}">
                        <input type="hidden" name="school_year_id[]" value="{{$activeYear[0]->id}}">
                        <input type="hidden" name="degree_id[]" value="{{$degree->id}}">
                       <th scope="row">{{$key+1}}</th>
                       <td class="text-center">
                        <input type="hidden" value="{{$item->id}}" name="student_id[]">
                           {{$item->name}}
                      </td>
                      <td class="text-center"> {{$item->lastname}}  </td>
                       <td><select name="behavior_indicator_id[]" class="form-control" style="font-size: 90%">
                       @foreach ($indicadores as $value)
                       <option value="{{$value->id}}">{{$value->name}}  ({{$value->code}})</option>
                       @endforeach
                        </select>
                       </td>

                    </tr>
                    @endforeach
              </tbody>
            </table>
            <button class="btn btn-primary" type="submit" >GUARDAR    <i class="fa fa-check-circle"></i></button>
        </form>



        </div>
      </div>
    </div>

  </div>



@endsection
