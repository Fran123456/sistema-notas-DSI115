

<div id="accordion">
@foreach ($degreesTeacher->degrees as $key => $degree)
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne{{$key}}" aria-expanded="true" aria-controls="collapseOne">

          <h5>{{Help::ordinal($degree->degree)}} {{$degree->section}} Turno  {{Help::turn($degree->turn)}} </h5>
        </button>
      </h5>
    </div>

    <div id="collapseOne{{$key}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        <h5 class="card-title"> Docente a cargo: {{$degree->teacher[0]->name}}</h5>
        <p class="card-text">Capacidad del salon: {{$degree->pivot->capacity}}</p>
      </div>
    </div>
  </div>
@endforeach
</div>







