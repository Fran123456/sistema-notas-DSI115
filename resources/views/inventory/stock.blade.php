@extends('inventory.template')
@section('content')
@include('alerts.dataTable')
@include('alerts.alerts')



     <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Reducir Stock</h3>
          <p><small>*Seleccione el producto del cual reducira el stock general, para generar el historial y actualizar el inventario</small></p>
        </div>
        <div class="box-body">
            <form action="{{route('product_history_save')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="">Seleccione</label><label style="color: red"> *</label>
                    <select name="product"  class="form-control" required>
                        @foreach ($products as $item)
                        <option value="{{$item->id}}">{{$item->name}} --- <b>Stock Actual: {{$item->stock}}</b></option>
                        @endforeach
                    </select>
                   </div>
                   <div class="form-group">
                    <label for="">Razon para reducir el inventario</label><label style="color: red"> *</label>
                   <input type="text" class="form-control" placeholder="ejemplo: Se usara el producto para uso domestico" name="reason" required>
                   </div>
                   <div class="form-group">
                    <label for="">Cantidad </label><label style="color: red"> *</label>
                   <input type="number" class="form-control" placeholder="Esta cantidad se reducira del stock del producto seleccionado" required name="quantity">
                   </div>
                   <div class="form-group">
                    <label for="">Persona Responsable </label><label style="color: red"> *</label>
                   <input type="text" class="form-control" placeholder="Nombre de Responsable del movimiento del inventario" required name="responsable">
                   </div>
                   <div class="form-group">
                    <p>CODIGO AUTO GENERADO: <b><u>{{$code}}</u></b></p>
                    <p style="text-transform: uppercase">se usara este codigo para identificar el movimiento en el historial de productos</p>
                   </div>
                   <div class="form-group">

                    <input type="hidden" name="code" value="{{$code}}">
                    {{-- <button  class="btn btn-success" data-toggle="modal" data-target="#stock"> <i class="fa fa-check-circle"></i> Reducir Inventario</button> --}}
                   <button class="btn btn-success" type="submit">Generar Historial <i class="fa fa-check-circle"></i></button>
                   </div>
            </form>
        </div>
     </div>

@endsection
@include('inventory.modalStock')
