@extends('inventory.template')
@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="box" style="background-color:#898a89">
            <p class="text-center">REPORTES DE HISTORIAL DE ARTICULOS</p>
            <div class="box-body">
                <div class="form-group">
                    <label for="">Producto</label><label style="color: red">*</label>
                    <select name="product" class="form-control" required>
                        <option value="">pr1</option>
                        <option value="">pr2</option>
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
                   <button class="btn btn-primary">Descargar <i class="fa fa-file-download"></i></button>
                </div>
            </div>

        </div>
    </div>
    <div class="col-md-6">
        <div class="row-md-6">
            <div class="box" style="background-color: #898a89">
                <div class="box-body">
                    <div class="form-group">
                        <label for="">Seleccione Estado</label><label style="color: red">*</label>
                        <select name="product" class="form-control" required>
                            <option value="">activo</option>
                            <option value="">inactivo</option>
                        </select>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                           <button class="btn btn-primary">Descargar <i class="fa fa-file-download"></i></button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="row-md-6">
            <div class="box" style="background-color: #898a89">
                <div class="box-body">
                    <div class="form-group">
                        <label for="">Seleccione Categoria</label><label style="color: red">*</label>
                        <select name="product" class="form-control" required>
                            <option value="">cat1</option>
                            <option value="">cat2</option>
                        </select>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                           <button class="btn btn-primary">Descargar <i class="fa fa-file-download"></i></button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

  @endsection
