@extends('inventory.template')
@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="box" style="background-color:#898a89">
            <p class="text-center">REPORTES DE HISTORIAL DE ARTICULOS</p>
            <form action="{{route('report_history')}}" method="POST">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label for="">Producto</label><label style="color: red">*</label>
                        <select name="product" class="form-control" required>
                            @foreach ($products as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="">Fecha Inicio</label><label style="color: red">*</label>
                        <input type="date" name="starDate" class="form-control" required>
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="">Fecha Final</label><label style="color: red">*</label>
                        <input type="date" name="endDate"  class="form-control" required>
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group">
                       <button class="btn btn-primary" type="submit">Descargar <i class="fa fa-file-download"></i></button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <div class="col-md-6">
        <div class="row-md-6">
            <div class="box" style="background-color: #898a89">
                <p class="text-center">REPORTES DE ARTICULOS POR ESTADO</p>
                <div class="box-body">
                   <form action="{{route('report_state')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Seleccione Estado</label><label style="color: red">*</label>
                        <select name="state" class="form-control" required>
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                           <button class="btn btn-primary" type="submit">Descargar <i class="fa fa-file-download"></i></button>
                        </div>
                    </div>
                   </form>

                </div>
            </div>
        </div>
        <div class="row-md-6">
            <div class="box" style="background-color: #898a89">
                <p class="text-center">REPORTES  DE ARTICULOS POR CATEGORIA</p>
                <div class="box-body">
                    <form action="{{route('report_category')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Seleccione Categoria</label><label style="color: red">*</label>
                            <select name="category" class="form-control" required>
                                @foreach ($categories as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                               <button class="btn btn-primary" type="submit">Descargar <i class="fa fa-file-download"></i></button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

  @endsection
