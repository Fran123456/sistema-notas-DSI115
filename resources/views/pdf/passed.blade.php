<!DOCTYPE html>
<html lanf="eng">
<head>
	<meta charset="UTF-8">
	<title></title>
	<style>

		.table, .thead, .tr, .th, .td{
			width: 100%;
		      border-collapse: collapse;
			border: 1px solid;
		}

	</style>
</head>
<body>



<strong>REPORTE DE ALUMNOS APROBADOS</strong><br><br>	
  <strong>Grado: {{Help::ordinal($degree->degree)}}</strong><br>
  <strong>Sección: {{$degree->section}}</strong><br>
  <strong>Turno: {{Help::turn($degree->turn)}}</strong><br>
  <strong>Año: {{$schoolYear->year}}</strong><br>
  <strong>Docente: {{$teacher->name}}</strong><br><br>

	<table class="table">
		<thead class="thead">
			<tr class="tr">
				<th class="th">Apellidos</th>
				<th class="th">Nombres</th>
				<th class="th">Materias Aprobadas</th>
				<th class="th">Promedio Final</th>
			</tr>
		</thead>
		<tbody>
		@foreach($students as $st => $value2)
		@foreach($notas as $n => $value)
			@if($value2->id == $value->id)
			@if($value->promedio >4.5)
			<tr>
				<td class="td">{{$value->apellido}}</td>
				<td class="td">{{$value->nombre}}</td>
				<td class="td">{{$value->materia}}</td>    
       			<td class="td">{{round($value->promedio,0)}}</td>
       		</tr>
		</tbody>
			@endif
			@endif
		@endforeach
		@endforeach
</html>


