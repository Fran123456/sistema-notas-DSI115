@foreach ($products as $item)
<div id="eliminar-{{$item->id}}" class="modal fade" role="dialog">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLabel">Eliminar Producto {{$item->id}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>

        <div class="modal-body">
            <p class="text-center text-primary" style="color: red">¿REALMENTE DESEA ELIMINAR ESTA PRODUCTO?</p>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="codigo" class="form-label">Nombre</label><label style="color: red"> *</label>
            <input type="text" class="form-control" required name="productName" value="{{$item->product}}" disabled>
        </div>
        <div class="form-group">
            <label for="codigo">Codigo</label><label style="color: red"> *</label>
            <input type="text" class="form-control" required name="code" value="{{$item->code}}" disabled>
        </div>

    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="codigo">Stock</label><label style="color: red"> *</label>
            <input type="number" class="form-control" required name="stock" value="{{$item->stock}}" disabled>
        </div>
        <div class="form-group">
            <label for="codigo">Modelo</label>
            <input type="text" class="form-control"required name="model" value="{{$item->model}}" disabled>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="">estado</label><label style="color: red"> *</label>
           <select  class="form-control" name="state" required disabled>
               @if ($item->state == true)
               <option value="1" selected>Activo</option>
               <option value="0">Inactivo</option>
               @else
               <option value="1">Activo</option>
               <option value="0" selected>Inactivo</option>
               @endif

           </select>
        </div>

    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="">Categoria</label><label style="color: red"> *</label>
           <select  class="form-control" name="category" required disabled>
           <option value="">{{$item->category}}</option>
           </select>
        </div>

    </div>



</div>
        </div>
        <div class="modal-footer" style="align-content: center">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

            <a class="btn btn-danger" href="{{route('product_delete_item',$item->id)}}">Eliminar <i class="fa fa-trash"></i></a>

        </div>
    </div>
    </div>
</div>
@endforeach








