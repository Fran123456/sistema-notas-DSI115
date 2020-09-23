@extends('layouts.app')
@section('content')





<strong class="card-title"></strong>

<div class="row">

    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">         

          <strong class="card-title">        </strong>
        </div>
        <div>

        </div>

          <div class="card-body">
          <form method="post" action="{{route('updateAttendance')}}"  enctype="multipart/form-data">
          <input name="_method" type="hidden" value="PATCH">            
            @csrf
            <table class="table">
                <thead>
                  <tr>
                    <th width="40" scope="col">#</th>
                    <th width="100" scope="col">Nombre</th>
                    <th width="100" scope="col">Apellido</th>
                    <th width="150" scope="col">Registro</th>
                  </tr>
                </thead>
                <input hidden value="{{$attendanceDate}}" name="date">
                <input hidden value="{{$activeYear->id}}" name="activeYear">
                <input hidden value="{{$degree->id}}" name="degree">
                <tbody>
                @foreach($attendance as $key => $value)
                    <tr>
                        <td>{{$key+1}}</td>
                        <input type="hidden" value="{{$value->id}}" name="student_id[]">
                        <td>{{$value->name}}</td>
                        <td>{{$value->lastname}}</td>                        
                        <td>
                            <select name="asistencia[]" class="form-control" style="font-size: 90%">
                                @if ($value->active==0)
                                    <option value="1">ASISTIO</option>
                                    <option selected="selected" value="0">NO ASISTIO</option>
                                    <option value="2">FALTA CON PERMISO</option>
                                @else
                                    @if ($value->active==1)
                                        <option selected="selected" value="1">ASISTIO</option>
                                        <option value="0">NO ASISTIO</option>
                                        <option value="2">FALTA CON PERMISO</option>
                                    @else
                                        <option value="1">ASISTIO</option>
                                        <option value="0">NO ASISTIO</option>
                                        <option selected="selected" value="2">FALTA CON PERMISO</option>
                                    @endif
                                @endif
                            </select>
                        </td>
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
