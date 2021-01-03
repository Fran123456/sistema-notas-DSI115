@extends('inventory.template')
@section('content')
<h3><i class='fa fa-edit'></i> Agregar nuevo producto</h3>
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
      <div class="col-md-9">
        {{-- formulario --}}
      <div class="box">
       <div class="box-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="codigo">Codigo</label>
                    <input type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label for="codigo">Codigo</label>
                    <input type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label for="codigo">Codigo</label>
                    <input type="text">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="codigo">Codigo</label>
                    <input type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label for="codigo">Codigo</label>
                    <input type="text" class="form-control">
                </div>
            </div>

        </div>
       </div>
      </div>
      </div>
</div>
@endsection
