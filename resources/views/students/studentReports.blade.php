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
            <li class="breadcrumb-item active" aria-current="page">Reportes</li>
          </ol>
        </nav>
      </div>
    </div>

    <div class="row">

      <div class="col-sm-12">                   
        <div class="card-body">                          
          <div class="card">
            <div class="card-body">
               <strong class="card-title">Reportes de asistencia del alumno {{$student->name}} {{$student->lastname}} </strong>
            </div>
         </div>
      
       <div class="card">
        <div class="card-body">                               
           
           <strong>Descargar en formato PDF</strong><br><br>
              <div class="row">
                <div class="col-md-3">                
                     <a href="{{ route('attendance.pdf',[$student->id,1])}}" class="btn btn-info">Periodo 1</a>                   
                </div>
                     <div class="col-md-3">                
                     <a href="#" class="btn btn-info">Periodo 2</a>                   
                </div>
                     <div class="col-md-3">                
                     <a href="#" class="btn btn-info">Periodo 3</a>                   
                </div>
                

                
             </div>
          </form>                                                                

        </div>
      </div>
    </div>
   </div>
</div>

@endsection
