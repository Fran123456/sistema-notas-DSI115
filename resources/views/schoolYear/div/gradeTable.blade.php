
@include('alerts.dataTable')
<!--bootstrap-data-table_length-->

<h6 class="text-center">Grados asociados al año escolar {{$year->year}}</h6>
<table class="table" id="">
    <thead>
        <tr>
          <th width="40" scope="col">#</th>
          <th scope="col">Grado</th>
          <th scope="col">Turno</th>
          <th scope="col">Docente</th>
          <th scope="col">Capacidad</th>
       </tr>
  </thead>
  <tbody>
         @foreach ($degreesTeacher->degrees as $key => $degree)
            <tr>
                <th scope="row">{{$key+1}}</th>
                <td>{{Help::ordinal($degree->degree)}} {{$degree->section}} </td>
                <td>{{Help::turn($degree->turn)}}  </td>
                <td>{{$degree->teacher[0]->name}}  </td>
                <td>{{$degree->pivot->capacity}}  </td>
           </tr>
      @endforeach
  </tbody>
</table>
