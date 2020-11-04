<!DOCTYPE html>
<html lanf="eng">
<head>
	<meta charset="UTF-8">
	<title></title>
	<style>

		.table, .thead, .tr, .th, .td{
			width: 100%;
			border: 1px solid;
		}

	</style>
</head>
<body>

<strong>REPORTE DE ASISTENCIA</strong><br><br>	
  <strong>DATOS DEL ALUMNO</strong><br>	            
  <strong>Nombre: </strong>{{$student->name}} {{$student->lastname}}<br>
  <strong>Grado: </strong>{{Help::ordinal($history->degree->degree)}}<br>
  <strong>Sección: </strong>{{$history->degree->section}}<br>
  <strong>Turno: </strong>{{Help::turn($history->degree->turn)}}<br>
  <strong>Año: </strong>{{$history->year->year}}<br>
  <strong>Periodo: </strong>{{$period->nperiodo}}<br><br>


	<table class="table">

		<thead class="thead">
			<tr class="tr">
				<th class="th">Fecha</th>
				<th class="th">Asistencia</th>
			</tr>
		</thead>

		<tbody>
<!--  
	

	
  -->
          @foreach ($attendance as $key => $value)
          	<tr>
          		<td class="td">{{$value->attendance_date}}</td>
          		<td class="td">         	
                  @if($value->active==0)
                    No asistió
                  @else
                  @if($value->active==1)
                    Asistió
                  @else
                    Falta con permiso
                  @endif
                 @endif
          		</td>

          	</tr>

          @endforeach


		</tbody>

	</table>


</body>
</html>


