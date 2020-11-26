<!-- Button trigger modal -->

@foreach ($students as $key => $value)
    <!-- Modal -->
    <div class="modal fade" id="periodos-{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Alumno: {{$value->name}} {{$value->lastname}}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{route('report-admin')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="usuario_id" value="{{$value->id}}">
                    <div class="form-group">
                        <label for="periodo_id">Seleccione Periodo</label>
                      <select name="periodo_id" class="form-control" required>
                         @foreach ($periodos as $item)
                         <option value="{{$item->id}}">PERIODO {{$item->nperiodo}}</option>
                         @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit"" class="btn btn-success">Descargar <i class="fa fa-download"></i></button>
                  </div>
            </form>
          </div>
        </div>
      </div>
@endforeach

