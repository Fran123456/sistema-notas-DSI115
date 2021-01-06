@extends('inventory.template')
@section('content')
@include('alerts.dataTable')
@include('alerts.alerts')

     <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Historial </h3>
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
                               <th>Producto</th>
                               <th>Id Registro</th>
                               <th>Stock Anterior</th>
                               <th>Stock Actual</th>
                               <th>Fecha</th>
                               <th>Detalle</th>

                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($history as $key => $item)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->code}}</td>
                                    <td>{{$item->lastStock}}</td>
                                    <td>{{$item->actualStock}}</td>
                                    <td>{{$item->created_at}}</td>
                                    <td>
                                        <button  class="btn btn-primary" data-toggle="modal" data-target="#detail-{{$item->id}}"><i class="fa fa-eye"></i></button>

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
@include('inventory.modalHistory');
