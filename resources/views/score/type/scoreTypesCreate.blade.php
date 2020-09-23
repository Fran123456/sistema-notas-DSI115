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
        <li class="breadcrumb-item"><a href="{{ route('gradesTeacher',$teacher->id) }}">
          Administración de docente - Año escolar {{Help::getSchoolYear()->year}}
        </a></li>

        <li class="breadcrumb-item"><a href="{{ route('typesSubjectTeacher',[$grade->id,$teacher->id]) }}">Materias
        </a></li>

        <li class="breadcrumb-item active" aria-current="page">Porcentajes de {{$subject->name}}</li>
      </ol> 
    </nav>
  </div>
</div>


  
  <div class="row">
   <div class="col-lg-12">

      <div class="card">
        <div class="card-header"><strong>Porcentajes de notas para la materia de {{$subject->name}}
          del grado: {{Help::ordinal($grade->degree)}} {{$grade->section}} - {{Help::turn($grade->turn)}}</strong></div>

        <div class="card-body card-block">
          <div class="row">
  
                <div class="col-md-3">
                  <div class="form-group">
                   <label>Porcentaje %</label>
                    <input type="number" min="0" required=""  class="form-control" name="percentage" >
                   </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                   <label>Fecha</label>
                    <input type="date" required="" class="form-control" name="date" >
                   </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                   <label>Actividad</label>
                    <input required="" type="text" class="form-control" name="activity" >
                   </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                   <label>Descripción</label>
                   <textarea required="" rows="3" class="form-control"></textarea>
                   </div>
                </div>
                <input type="" value="{{$period->id}}" name="period">

                <div class="col-md-12">
                  <div class="form-group">
                        <button type="submit" class="btn btn-info mb-1" name="button"><i class="fa fa-plus" aria-hidden="true"></i></button>
                  </div>
               </div>


            <div class="col-md-12">
              <h5 class="text-center"><strong>Consolidado de % de notas</strong></h5>
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">%</th>
                    <th scope="col">Last</th>
                    <th scope="col">Handle</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>


        
      </div>
    </div>
    </div>
  </div>
  </form>

  @endsection
