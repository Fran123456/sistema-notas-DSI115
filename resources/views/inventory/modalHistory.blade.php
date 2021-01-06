@foreach ($history as $item)
<div id="detail-{{$item->id}}" class="modal fade" role="dialog">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLabel">Detalle Movimiento  {{$item->code}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="">Codigo Historial</label>
                <input type="text" value="{{$item->code}}" disabled class="form-control">
            </div>
            <div class="form-group">
                <label for="">Responsable</label>
                <input type="text" value="{{$item->responsable}}" disabled class="form-control">
            </div>
            <div class="form-group">
                <label for="">Razon</label>
                <input type="text" value="{{$item->reason}}" disabled class="form-control">
            </div>
            <div class="form-group">
                <label for="">Stock Anterior</label>
                <input type="text" value="{{$item->lastStock}}" disabled class="form-control">
            </div>
            <div class="form-group">
                <label for="">Stock Actual</label>
                <input type="text" value="{{$item->actualStock}}" disabled class="form-control">
            </div>
            <div class="form-group">
                <label for="">Producto</label>
                <input type="text" value="{{$item->name}}" disabled class="form-control">
            </div>
            <div class="form-group">
                <label for="">Codigo Producto</label>
                <input type="text" value="{{$item->codigoProducto}}" disabled class="form-control">
            </div>
            <div class="form-group">
                <label for="">Fecha Movimiento</label>
                <input type="text" value="{{$item->created_at}}" disabled class="form-control">
            </div>

        </div>
        <div class="modal-footer" style="align-content: center">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

        </div>
    </div>
    </div>
</div>
@endforeach
