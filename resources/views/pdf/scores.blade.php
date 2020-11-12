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

<strong>Reporte de notas</strong><br>  <br>
  <strong>Nombre: </strong>{{$student->name}} {{$student->lastname}}<br>
  <strong>Grado: </strong>{{Help::ordinal($history->degree->degree)}}<br>
  <strong>Sección: </strong>{{$history->degree->section}}<br>
  <strong>Turno: </strong>{{Help::turn($history->degree->turn)}}<br>
  <strong>Año: </strong>{{$history->year->year}}<br><br>



  @foreach ($periods as $key => $value)
    
    <strong>{{Help::periods($value->nperiodo)}}</strong><br><br>

     @foreach ($history->degree->subjects as $key2 => $value2)

      @php
        $notaTotal = 0;
        $coll = 0;
      @endphp

       <table class="table">
          <thead>
            <tr class="tr">
              @foreach($scores as $ss => $notas)
                @if($value->id == $notas->school_period_id)  
                  @if($notas->subject_id == $value2->id) 
                    @php
                   $coll = 1 + $coll;
                   @endphp
                    @endif
                  @endif
                @endforeach  
              <th class="th" colspan={{$coll+1}}>  
                <strong>{{$value2->name}}</strong>
              </th>
            </tr>
              <tr class="tr">
               @foreach($scores as $s => $notas)
                @if($value->id == $notas->school_period_id)  
                  @if($notas->subject_id == $value2->id) 
                    <th class="th">
                      {{$notas->score_types->activity}}
                    </th>
                    @endif
                  @endif
                @endforeach  

                    <th class="th">Nota total</th>
                </tr>  
            </thead>

            <tbody>
              <tr class="tr">
                @foreach($scores as $s => $notas)
                  @if($value->id == $notas->school_period_id)  
                    @if($notas->subject_id == $value2->id) 
                      <td class="td">{{$notas->score}}</td>
                           
                    @php
                      $notaTotal =  $notaTotal + ($notas->score * ($notas->score_types->percentage*0.01));

                    @endphp

                    @endif
                  @endif
                @endforeach  
                      <td class="td">{{$notaTotal}}</td>
              </tr>
            </tbody>
          </table>  
                  
      @endforeach
    <br>
  @endforeach
</body>
</html>


