@extends('inventory.template')
@include('alerts.dataTable')
@section('content')
<div class="row">
    @include('alerts.alerts')
</div>

 {{-- <!-- modal crear catalogo -->
 <div id="modal" class="modal fade" role="dialog">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Crear Empresa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <form action="" method="POST">
            @csrf
        <div class="modal-body">
            <div class="form-group">

              <input name="nombre" type="text" class="form-control" placeholder="Ingrese Nombre" required>
            </div>
            <div class="form-group">

               <label for="giro" class="form-label">Giro Empresarial</label>

              </div>
        </div>
        <div class="modal-footer" style="align-content: center">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

            <button class="btn btn-primary" type="submit">Guardar</button>
        </form>

        </div>
    </div>
    </div>
</div>
 <!-- FIN modal crear empresa --> --}}


 {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal">
    <i class="fa fa-plus" aria-hidden="true"></i>
  </button> --}}


<div class="row">
    <div class="btn-group pull-right">
        <a href="{{route('add_product')}}" class="btn btn-default"><i class="fa fa-plus"></i> Nuevo Producto</a>
    </div>
</div>


     <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Listado de Productos</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-lg-12">
                  <br>
                  <div class="card">

                      <div class="card-body">

                            <table class="table table-condensed table-hover table-striped"  id="bootstrap-data-table_length">
                              <thead class="thead-light">
                              <tr>
                                <th>#</th>
                                <th class="text-center">Código</th>
                                <th class="text-center">Imagen</th>
                                <th>Modelo </th>
                                <th>Producto </th>
                                <th>Categoria </th>
                                <th class="text-center">Estado</th>
                                <th class="text-center">Stock</th>

                                <th></th>

                              </tr>
                            </thead>
                            <tbody>

                               @foreach ($products as $key => $item)
                               <tr>
                                <th scope="row">{{$key+1}}</th>
                                <td>{{$item->code}}</td>
                                <td class="text-center">
                                   @if ($item->img == null)
                                   <img src="{{asset('assets/inventario/product.png')}}" alt="Product Image" class="img-rounded" width="60">
                                   @else
                                   <img src="{{asset($item->img)}}" alt="Product Image" class="img-rounded" width="60">
                                   @endif
                                </td>
                                <td class="text-center">{{$item->model}}</td>
                                <td> {{$item->product}}</td>
                                <td>{{$item->category}}</td>
                                <td class="text-center">
                                    @if ($item->state == true)
                                    <span class="label label-success">ACTIVO</span>
                                    @else
                                    <span class="label label-danger">INACTIVO</span>
                                    @endif

                                </td>
                                <td class="text-center">{{$item->stock}}</td>



                                <td>
                                <div class="btn-group pull-right">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Acciones <span class="fa fa-caret-down"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{route('edit_product',$item->id)}}"><i class="fa fa-edit"></i> Editar</a></li>

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
@include('inventory.modal')
