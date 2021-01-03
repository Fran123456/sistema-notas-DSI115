@extends('inventory.template')
@section('content')
<div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
          <strong class="card-title">Alumnos</strong>
        </div>
          <div class="card-body">
              <table class="table table-dark" id="bootstrap-data-table_length">
                <thead class="thead-light">
                    <tr>
                        <th class="text-center">Código</th>
                        <th class="text-center">Imagen</th>
                        <th>Modelo </th>
                        <th>Producto </th>
                        <th>Fabricante </th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Stock</th>
                        <th class="text-right">Precio</th>
                        <th></th>

                      </tr>

                </thead>
                <tbody>
                   @foreach ($students as $key => $value)

                    <tr>
                        <th scope="row">{{$key+1}}</th>
                        <td class="text-center">9123456</td>
                        <td class="text-center">
                            h
                         </td>

                         <td> MÁQUINAS DE ORDEÑAR</td>
                         <td>Lenovo</td>
                         <td class="text-center">
                             <span class="label label-success">Activo</span>
                         </td>
                         <td class="text-center">444</td>
                         <td class="text-right">40.00</td>


                         <td>
                         <div class="btn-group pull-right">
                                 <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Acciones <span class="fa fa-caret-down"></span></button>
                             <ul class="dropdown-menu">
                                                                     <li><a href="edit_product.php?id=141"><i class="fa fa-edit"></i> Editar</a></li>
                                 <li><a href="#" data-toggle="modal" data-target="#barcodeModal" data-id="141" data-product_code="9123456" data-product_name=" MÁQUINAS DE ORDEÑAR"><i class="fa fa-barcode"></i> Código de barra</a></li>
                                                                     <li><a href="#" onclick="eliminar('141')"><i class="fa fa-trash"></i> Borrar</a></li>
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
@endsection
