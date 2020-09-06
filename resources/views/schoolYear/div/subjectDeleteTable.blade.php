
@include('alerts.dataTable')
@if (count($subjectsGrade)>0)
  <table class="table" id="">
      <thead>
          <tr>
            <th width="40" scope="col">#</th>
            <th scope="col">Materia</th>
            <th scope="col">Docente</th>
         </tr>
    </thead>
    <tbody>
           @foreach ($subjectsGrade as $key => $subject)
              <tr>
                  <th scope="row">{{$key+1}}</th>
                  <td>{{$subject->name}}  </td>
                  <td>{{Help::getTeacher($subject->pivot->user_id) }} </td>
             </tr>
        @endforeach
    </tbody>
  </table>
@else
  <br>
  <h4 class="text-center">No hay materias para el grado seleccionado</h4>
@endif
<!--bootstrap-data-table_length-->
