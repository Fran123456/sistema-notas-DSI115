<!DOCTYPE html>
<html lanf="eng">
<head>
	<meta charset="UTF-8">
	<title></title>
	<style>

		.table, .thead, .tr, .th, .td{
			width: 100%;
			border: 1px solid;
      border-collapse: collapse;
      text-align: center;
		}

	</style>
</head>
<body>

  <strong>DETALLE DE ASISTENCIAS POR ALUMNO</strong><br>
  <strong>Grado: </strong>{{ Help::ordinal($degree->degree)}} {{$degree->section}}<br>
  <strong>Periodo: </strong>{{$period->nperiodo}}<br>
  <strong>Año: </strong>{{$schoolYear->year}}<br><br>
  <table class="table">
		<thead class="thead">
			<tr class="tr">
				<th class="th">Apellidos</th>
				<th class="th">Nombres</th>
				<th class="th">Asistencias</th>
				<th class="th">Faltas</th>
                <th class="th">Permisos</th>
			</tr>
		</thead>
		<tbody>
		@foreach($attendances as $attendance)
        <tr>
            <td class="td">{{$attendance->lastname}}</td>
            <td class="td">{{$attendance->name}}</td>
            <td class="td">{{$attendance->asistencias}}</td>    
            <td class="td">{{$attendance->faltas}}</td>
            <td class="td">{{$attendance->permisos}}</td>
        </tr>
		@endforeach
        </tbody>
    </table>
</body>
</html>