<!DOCTYPE html>
<html lanf="eng">
<head>
	<meta charset="UTF-8">
	<title></title>
	<style>
		.t{
			width: auto;
		    border-collapse: collapse;
			border: 1px solid;
			text-align: left;

		}
		.ta{
			width: 100%;
			border-collapse: collapse;
			border: 1px solid;
			text-align: left;
		}
		.nombre{
			border: 1px solid;
		}
	</style>
</head>
<body>



<strong>REPORTE DE NOTAS POR GRADO</strong><br><br>	
  <strong>Grado: {{Help::ordinal($degree->degree)}}</strong><br>
  <strong>Sección: {{$degree->section}}</strong><br>
  <strong>Turno: {{Help::turn($degree->turn)}}</strong><br>
  <strong>Periodo: {{$period->nperiodo}}</strong><br>
  <strong>Año: {{$schoolYear->year}}</strong><br>

  @foreach($degree->subjects as $key => $value)
  @foreach($subjects as $key2 => $value2)

  	@if($value->id == $value2->id)
  		<br><br><strong>{{$value2->name}}</strong><br>

  		<table class="ta">

  			<thead class="t">
  				<tr class="t">
  					<th class="nombre">Alumno</th>
  					@foreach($activities as $a)
  					@if($a->subject_id == $value2->id)
  					<th class="t">{{$a->activity}}</th>
  					@endif
  					@endforeach
  					<th class="t">Promedio</th>
  				</tr>
  			</thead>

  			
  			
  			@foreach($students as $s)
  			<tr class="t">
  			<td class="nombre">{{$s->name}} {{$s->lastname}}</td>

  			@foreach($notas as $n)
  			@if($n->id == $s->id)
  			@if($n->materia == $value2->name)
  			<td class="t">{{$n->nota}}</td>
  			@endif
  			@endif				
  			@endforeach

  			@foreach($promedios as $p)
  			@if($p->id == $s->id)
  			@if($p->materia == $value2->name)
  			<td class="t">{{$p->promedio}}</td>
  			@endif
  			@endif
  			@endforeach
  			</tr>
  			@endforeach

  		</table>

  	@endif
  @endforeach
  @endforeach



</html>