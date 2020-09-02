
@include('alerts.dataTable')
<!--bootstrap-data-table_length-->
<h5 class="text-center">Materias agregadas</h5>
<table class="table" id="">
    <thead>
        <tr>
          <th width="40" scope="col">#</th>
          <th scope="col">Materia</th>
          <th scope="col">Docente</th>
          <th width="80" scope="col">Eliminar</th>
       </tr>
  </thead>
  <tbody>
         @foreach ($subjectsGrade as $key => $subject)
            <tr>
                <th scope="row">{{$key+1}}</th>
                <td>{{$subject->name}}  </td>
                <td>{{Help::getTeacher($subject->pivot->user_id) }} </td>
                <td>
                  <a href="{{ route('deleteSubjectsDegree', $subject->pivot->id) }}" class="btn btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>  </td>
               </td>
           </tr>
      @endforeach
  </tbody>
</table>
