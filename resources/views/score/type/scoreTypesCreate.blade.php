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
          <div class="col-md-12">
              <form method="post" action="{{ route('scoreTypeSave') }}" enctype="multipart/form-data">
                @csrf
                
                    <div class="form-group">                      

                      <div class="form-row">
                          <div class="col-4">
                            <label>Porcentaje %</label>
                            <input type="number" min="0" required=""  class="form-control" name="percentage" >                          
                          </div>                      
                          <div class="col-4">
                            <label>Fecha</label>
                            <input type="date" required="" class="form-control" name="date" >
                          </div>           
                          <div class="col-4">
                            <label for="">Tipo</label>
                              <select name="type" class="form-control" style="font-size: 100%">                      
                              @foreach($types as $type)
                                <option value="{{$type}}">{{$type}}</option>
                              @endforeach                        
                              </select>
                          </div>
                      </div>                                                                                                                        
                                                                                          
                      <div class="form-row">
                          <div class="col-12">
                              <label>Actividad</label>
                              <input required="" type="text" class="form-control" name="activity" >
                          </div>                          
                      </div>
                    </div>
                
                    <label>Descripción</label>
                          <textarea required="" rows="3" class="form-control" name="description"></textarea>
                </div>                      
                  <!--HIDDEN FIELDS-->    
                  <div>
                    <input hidden type="" value="{{$period->id}}" name="period">
                    <input hidden value="{{$year->id}}" name="year">
                    <input hidden value="{{$grade->id}}" name="grade">
                    <input hidden value="{{$teacher->id}}" name="teacher">
                    <input hidden value="{{$subject->id}}" name="subject">
                  </div>                            
                  <!-- -->

                  <div class="col-md-12">
                    <div class="form-group">
                          <button type="submit" class="btn btn-info mb-1" name="button"><i class="fa fa-plus" aria-hidden="true"></i></button>
                    </div>
                  </div>                
              </form>               

              

            <div class="col-md-12">
              <h5 class="text-center"><strong>Consolidado de % de notas</strong></h5>
              <table class="table table-hover">
                <thead>
                  <tr>                    
                    <th scope="col">Tipo</th>
                    <th scope="col">Actividad</th>
                    <th scope="col">%</th>                    
                    <th scope="col">Descripción</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($query as $element)
                    <tr>                      
                      <td>{{$element->type}}</td>
                      <td>{{$element->activity}}</td>
                      <td>{{$element->percentage}}</td>
                      <td>{{$element->description}}</td>                             
                    </tr>          
                  @endforeach        
                </tbody>
              </table>
            </div>
          </div>


        
      </div>
    </div>
  </div>
  

  @endsection
