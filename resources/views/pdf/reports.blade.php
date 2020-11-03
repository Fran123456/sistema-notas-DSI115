<!DOCTYPE html>
<html lanf="eng">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>

<strong>Reporte de asistencia</strong><br><br>	            
  <strong>Nombre del alumno: </strong>{{$student->name}} {{$student->lastname}}<br><br>
  
	<table class="table">

		<thead>
			<tr>
				<th>Fecha</th>
				<th>Asistencia</th>
			</tr>
		</thead>

		<tbody>
<!--  
	
	A editar diseno
	
  -->
          @foreach ($history as $key => $value)

          	<tr>
          		<td>{{$value->attendance_date}}</td>
          		<td>         	
                  @if ($value->active==0)
                   NO ASISTIO
                  @else
                  @if ($value->active==1)
                   ASISTIO
                  @else
                   FALTA CON PERMISO
                  @endif
                 @endif
          		</td>

          	</tr>

          @endforeach


		</tbody>

	</table>


</body>
</html>


