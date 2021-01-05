<html>
<head>
	<meta charset="UTF-8">
	<title></title>
	<style>
    .table, .thead, .tr, .th, .td{
      width: 100%;
      border-collapse: collapse;
      border: 1px solid;
      text-align: left;

    }
	</style>
</head>
<body>



<strong>REPORTE DE CONDUCTA POR GRADO</strong><br><br>	
  <strong>Grado: {{Help::ordinal($degree->degree)}}</strong><br>
  <strong>Sección: {{$degree->section}}</strong><br>
  <strong>Turno: {{Help::turn($degree->turn)}}</strong><br>
  <strong>Periodo: {{$period->nperiodo}}</strong><br>
  <strong>Año: {{$schoolYear->year}}</strong><br>

  <br><br>
  <table class="table">
    <tr class="tr">
      <th class="th">Apellidos</th>
      <th class="th">Nombres</th>
      <th class="th">Conducta</th>
    </tr>
  @foreach($students as $s)
  @foreach($behavior as $b)
  @if($s->id == $b->student_id)
    <tr class="tr">
      <td class="td">{{$s->lastname}}</td>
      <td class="td">{{$s->name}}</td>
      <td class="td">{{$b->indicator->name}}</td>
    </tr>
  @endif  
  @endforeach  
  @endforeach
  </table>

</html>