@foreach ($students as $item)
<div id="eliminar-{{$item->id}}" class="modal fade" role="dialog">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLabel">Eliminar {{$item->id}} </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>

        <div class="modal-body">
            <p class="text-center text-primary">REALMENTE DESEA ELIMINAR ESTA EMPRESA?</p>
            <p class="text-center text-danger">Al eliminar esta empresa se eliminara el catalogo de cuentas asociado</p>
        </div>
        <div class="modal-footer" style="align-content: center">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

            <a class="btn btn-danger" href="">Eliminar</a>

        </div>
    </div>
    </div>
</div>
@endforeach
