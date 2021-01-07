<!-- Button trigger modal -->

@foreach ($students as $key => $value)
    <!-- Modal -->
    <div class="modal fade" id="delete-{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Eliminar asignación</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST" action="{{route('studenthistories.destroy', $value->id) }}">
                @csrf
                <input type="hidden" name="_method" value="delete" />
                <div class="modal-body">
                    <p>¿Desea eliminar la asignación del estudiante {{$value->name}} {{$value->lastname}}?</p>
                </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit"" class="btn btn-danger">Eliminar</button>
                  </div>
            </form>
          </div>
        </div>
      </div>
@endforeach

