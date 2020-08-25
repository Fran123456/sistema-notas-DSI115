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
          <li class="breadcrumb-item"><a href="{{ route('degrees.index') }}">Grados</a></li>
          <li class="breadcrumb-item active" aria-current="page">Crear grado</li>
        </ol>
      </nav>
    </div>
  </div>

  <form method="post" action="{{ route('degrees.store') }}" enctype="multipart/form-data">
  @csrf
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header"><strong>Crear un grado</strong></div>

        <div class="card-body card-block">                                    
          <div class="row">
            
            <div class="col-md-3">  
              <div class="form-group">
                <label  class=" form-control-label">Grado</label>
                <input type="number" min="1" max="12" name="degree" required  class="form-control">
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">                     
                <label for="seccion">Seccion</label>
                  <select class="form-control" id="seccion" name="seccion">
                     <option value="A">A</option>
                     <option value="B">B</option>
                     <option value="C">C</option>
                  </select>          
                </div>
             </div>

             <div class="col-md-3">
               <div class="form-group">
                <label for="turn">Turno </label>
                  <select class="form-control" id="turn" name="turn">
                    <option value="m">Turno Matutino </option>
                    <option value="t">Turno Vespertino </option>
                  </select>
                </div>                              
              </div>
              
              <div class="col-md-3">
                <div class="form-group">
                  <label>Estado</label>
                    <select name="active" required="" class="form-control">
                       <option value="1">Activo</option>
                       <option value="0">No activo</option>
                    </select>
                   </div>
               </div>   
         
          </div>

          <div class="row form-group">
            <div class="col-12 col-md-12 col-sx-12">
              <div class="">
                <button type="submit" class="btn btn-info mb-1" name="button"><i class="fa fa-plus" aria-hidden="true"></i></button>
              </div>
            </div>
          </div>

          </div>
      </div>
    </div>
  </div>

  </form>

  @endsection
