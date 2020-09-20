@extends('layouts.app')
@section('content')





<strong class="card-title">Control de Asistencia Escolar: {{$now}}</strong>

<div class="row">

    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
          <strong class="card-title"> {{Help::ordinal($degree->degree)}} {{$degree->section}} - {{Help::turn($degree->turn)}} </strong>
          <strong></strong>

        </div>
        <div>

        </div>

          <div class="card-body">

            <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th width="40" scope="col">#</th>
                    <th scope="col" class="text-center" width="40">Nombre</th>
                    <th scope="col"  class="text-center"  width="40">Asistencia</th>



                  </tr>
                </thead>


                <tbody>

                    @foreach ($students as $key=> $item)

                    <tr style="font-size: 90%">
                       @foreach ($std as $value)
                       @if ($item->student_id == $value->id)
                       <form action="{{route('saveAttendanceRecord')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                       <input type="hidden" value="{{$now}}" name="date[]">
                       <input type="hidden" value="{{$item->id}}" name="studenthistory[]">
                       <th scope="row">{{$key+1}}</th>
                       <td class="text-center">
                        <input type="hidden" value="{{$item->student_id}}" name="student_id[]">
                           {{$value->name}}  {{$value->lastname}}
                      </td>
                       <td><select name="asistencia[]" class="form-control" style="font-size: 90%">
                        <option value="1">ASISTIO</option>
                        <option value="2">NO ASISTIO</option>
                        <option value="3">FALTA CON PERMISO</option>
                        </select>
                       </td>


                       @endif

                       @endforeach

                    </tr>
                    @endforeach


              </tbody>



            </table>
            <button class="btn btn-primary" type="submit" >GUARDAR ASISTENCIA   <i class="fa fa-check-circle"></i></button>
        </form>



        </div>
      </div>
    </div>

  </div>



@endsection
