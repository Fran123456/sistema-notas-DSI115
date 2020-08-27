
@include('alerts.dataTable')
<!--bootstrap-data-table_length-->

<h5 class="text-center">Grados asociados al año escolar {{$year->year}}</h5>
<table class="table" id="">
    <thead>
        <tr>
          <th width="40" scope="col">#</th>
          <th scope="col">Grado</th>
          <th scope="col">Turno</th>
          <th scope="col">Docente</th>
          <th scope="col">Capacidad</th>
          <th scope="col"># Materias</th>
          <th scope="col"># Alumnos</th>
          <th width="80" scope="col">Agregar materia</th>
          <th width="80" scope="col">Editar</th>
          <th width="80" scope="col">Eliminar</th>
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
                <td> 0 </td>
                <td> 0 </td>
                <td> 
                   <a href="" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i></a>  
                </td>
                <td>
                    <a href="" class="btn btn-warning"><i class="fa fa-edit" aria-hidden="true"></i></a>
                </td>
                <td>
                  <a href="" class="btn btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>  </td>
               </td>
           </tr>
      @endforeach
  </tbody>
</table>
