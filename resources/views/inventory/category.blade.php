@extends('inventory.template')
@section('content')
@include('alerts.dataTable')
<div class="row">
    <div class="btn-group pull-right">

        <button  class="btn btn-default" data-toggle="modal" data-target="#crear"><i class="fa fa-plus"></i> Crear Categoria</button>
    </div>
</div>
<br>


     <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Listado de Categorias</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-lg-12">
                  <br>
                  <div class="card">

                      <div class="card-body">

                        <table class="table table-condensed table-hover table-striped"  id="bootstrap-data-table_length">
                            <thead>
                              <tr>
                                <th>#</th>
                               <th>Nombre</th>
                               <th>Descripcion</th>

                              </tr>
                            </thead>
                            <tbody>

                               @foreach ($categories as $key => $item)
                               <tr>
                                <th scope="row">{{$key+1}}</th>
                                <td>{{$item->name}}</td>
                                <td>{{$item->description}}</td>
                                <td>
                                <div class="btn-group pull-right">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Acciones <span class="fa fa-caret-down"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#" data-toggle="modal" data-target="#editar-{{$item->id}}"><i class="fa fa-edit"></i> Editar</a></li>

                                        <li><a href="#" data-toggle="modal" data-target="#eliminar-{{$item->id}}"><i class="fa fa-trash"></i> Borrar</a></li>
                                     </ul>


                                </div><!-- /btn-group -->
                                </td>
                              </tr>
                               @endforeach


                          </tbody>
                        </table>
                    </div>
                  </div>
                </div>
              </div>
        </div>
     </div>

@endsection
@include('inventory.modalCategory')
