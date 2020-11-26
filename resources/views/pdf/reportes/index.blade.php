@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="mb-3 card text-white card-body" style="background-color: #034964">
            <h6 class="text-white card-title text-center">COMPARACION DE RATIOS FINANCIEROS POR</h6>
            <h6 class="card-title text-center" style="color: #ff1d37">"PROMEDIO POR SECTOR"</h6>
            <form action="" method="POST">
                @csrf
                <div class="form-group">
                    <label for="">seleccione giro empresarial</label>
                    <select name="giroEmpresa" id="" class="form-control">

                   <option value="">periodo</option>

                    </select>
                </div>


                <div>
                    <button class="btn btn-primary">calcular</button>
                </div>
            </form>

        </div>
      </div>



</div>
@endsection
