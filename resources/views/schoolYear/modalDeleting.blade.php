<!-- Modal -->
<div class="modal fade" id="confirmElimination" tabindex="-1" role="dialog" aria-labelledby="processConfirmElimination" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmElimination">Eliminar año escolar {{$backSchoolYear->year}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ¿Está seguro que desea eliminar el año escolar {{$backSchoolYear->year}}? Toda la información relacionada a dicho año será eliminada.
      </div>
      <div class="modal-footer">
        <form action="">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </form>
        <form method="POST" action="{{route('years.destroy', $backSchoolYear->id) }}">
            @csrf
            <input type="hidden" name="_method" value="delete" />
            <button class="btn btn-danger">Eliminar</button>
        </form>
      </div>
    </div>
  </div>
</div>
