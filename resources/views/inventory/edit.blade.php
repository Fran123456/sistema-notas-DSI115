@extends('inventory.template')
@section('content')
<style>
	.form-group input:required~label::after {
		content: "* ";
		color: red;
		font-weight: bold;
	}
</style>
<div class="container mt-4">

<h3><i class='fa fa-edit'></i> Editar Producto</h3>
<div class="row">
    <div class="col-md-3">

        <!-- Profile Image -->
        <div class="box box-primary">
          <div class="box-body box-profile">
          <div id="load_img">
            <img class=" img-responsive" src="https://picsum.photos/200" >
            </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->


      </div>
      <!-- /.col -->
      <div class="col-md-8">
        {{-- formulario --}}
      <div class="box">
       <div class="box-body">
       <form action="{{route('edit_product_save',$product[0]->id)}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="codigo" class="form-label">Nombre</label><label style="color: red"> *</label>
                    <input type="text" class="form-control" required name="productName" value="{{$product[0]->product}}">
                </div>
                <div class="form-group">
                    <label for="codigo">Codigo</label><label style="color: red"> *</label>
                    <input type="text" class="form-control" required name="code" value="{{$product[0]->code}}">
                </div>

            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="codigo">Stock</label><label style="color: red"> *</label>
                    <input type="number" class="form-control" required name="stock" value="{{$product[0]->stock}}">
                </div>
                <div class="form-group">
                    <label for="codigo">Modelo</label>
                    <input type="text" class="form-control" required name="model" value="{{$product[0]->model}}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">estado</label><label style="color: red"> *</label>
                   <select  class="form-control" name="state" required>
                       @if ($product[0]->state == true)
                       <option value="1" selected>Activo</option>
                       <option value="0">Inactivo</option>
                       @else
                       <option value="1">Activo</option>
                       <option value="0" selected>Inactivo</option>
                       @endif

                   </select>
                </div>

            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Categoria</label><label style="color: red"> *</label>
                   <select  class="form-control" name="category" required>
                    @foreach ($categories as $item)
                    @if ($product[0]->category_id == $item->id)
                    <option value="{{$item->id}}" selected>{{$item->name}}</option>
                    @endif
                    <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                   </select>
                </div>

            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="exampleFormControlFile1">Imagen Producto</label>
                    <input type="file" class="form-control-file" id="exampleFormControlFile1" accept="image/*" name="imagen">
                </div>

            </div>
            <div class="col-md-6">
                <div class="form-group">
                   <button type="submit" class="btn btn-success">Guardar <i class="fa fa-edit"></i></button>
                </div>

            </div>

        </div>
       </form>
       </div>
      </div>
      </div>
</div>
@endsection
