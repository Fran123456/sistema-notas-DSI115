<div id="stock" class="modal fade" role="dialog">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLabel">Reducir Stock</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <p>CODIGO GENERADO: <b><u>{{$code}}</u></b></p>

            <p style="text-transform: uppercase">se usara este codigo para identificar el movimiento en el historial de productos</p>

        </div>
        <div class="modal-footer" style="align-content: center">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button class="btn btn-success" type="submit">Generar Historial</button>
        </div>
    </div>
    </div>
</div>
