@extends('layouts.app')
@section('content')


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
       <li class="breadcrumb-item"><a href="{{ route('teacher-grade',$year_grade->school_year_id) }}">Año escolar activo</a></li>


        <li class="breadcrumb-item active" aria-current="page">Editar grado: {{Help::ordinal($degreeSelected->degree)}} {{$degreeSelected->section}} - {{Help::turn($degreeSelected->turn)}}</li>
      </ol>
    </nav>
  </div>
</div>



<form method="POST" action="{{route('save_editYear_grade',$year_grade->id)}}" enctype="multipart/form-data">

  @csrf
<div class="row">
  <div class="col-lg-12">
                    <div class="card">
                          <div class="card-header"><strong>Editar Grado </strong></div>
                          <div class="card-body card-block">
                                <input type="hidden" name="school_year_id" value="{{$year_grade->school_year_id}}">
                                <div class="form-group">
                                  <label  class=" form-control-label">Editar Grado</label>
                                  <br>
                                  <small>*Solo se muestran los grados que no han sido asignado aun a este año escolar</small>
                                 <select name="degree" id="" class="form-control">
                                 <option value="{{$degreeSelected->id}}" selected>{{Help::ordinal($degreeSelected->degree)}} {{$degreeSelected->section}} - {{Help::turn($degreeSelected->turn)}}</option>
                                    @foreach ($availableDegrees as $item)
                                        <option value="{{$item->id}}">{{Help::ordinal($item->degree)}} {{$item->section}} - {{Help::turn($item->turn)}}</option>
                                    @endforeach
                                 </select>

                                </div>
                                <div class="form-group">
                                    <label  class=" form-control-label">Editar Docente</label>
                                    <br>
                                   <select name="teacher" id="" class="form-control">
                                      @foreach ($teachers as $item)
                                          @if ($item->id == $year_grade->user_id  )
                                              <option value="{{$item->id}}" selected>{{$item->name}}</option>
                                          @else
                                          <option value="{{$item->id}}">{{$item->name}}</option>
                                          @endif
                                      @endforeach
                                   </select>
                                  </div>
                                  <div class="form-group">
                                    <label  class=" form-control-label">Editar Capacidad</label>
                                    <br>
                                    <small>*Requerido</small>

                                    <input type="text" name="capacity" required value="{{$year_grade->capacity}}" class="form-control" >
                                  </div>
                                  <div class="row form-group">
                                    <div class="col-6 col-md-6 col-sx-12">
                                      <div class="">
                                        <button type="submit" class="btn btn-warning mb-1" name="button"><i class="fa fa-edit" aria-hidden="true"></i></button>
                                      </div>
                                    </div>
                                </div>




                        </div>
                  </div>
      </div>
</div>
</form>



@endsection
