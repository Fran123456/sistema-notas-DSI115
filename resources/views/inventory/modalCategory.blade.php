

@foreach ($categories as $item)
<div id="eliminar-{{$item->id}}" class="modal fade" role="dialog">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title text-center" style="color: red">Eliminar Categoria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>

        <div class="modal-body">
            <p class="text-center text-primary" style="color: red">¿REALMENTE DESEA ELIMINAR ESTA CATEGORIA?</p>
            <div class="modal-body">

                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" name="name" required value="{{$item->name}}" class="form-control" disabled>
                </div>
                <div class="form-group">
                    <label for="name">Descripcion</label>
                    <input type="text" name="description" required value="{{$item->description}}" class="form-control" disabled>
                </div>
            </div>

        </div>
        <div class="modal-footer" style="align-content: center">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

            <a class="btn btn-danger" href="{{route('categoty_delete_item',$item->id)}}">Eliminar <i class="fa fa-trash"></i></a>

        </div>
    </div>
    </div>
</div>
@endforeach

@foreach ($categories as $item)
<div id="editar-{{$item->id}}" class="modal fade" role="dialog">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLabel">Editar Categoria <i class="fa fa-edit"></i></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
    <form action="{{route('category_update',$item->id)}}" method="POST">
        @csrf
        <div class="modal-body">

            <div class="form-group">
                <label for="name">Nombre</label><label style="color: red"> *</label>
                <input type="text" name="name" required value="{{$item->name}}" class="form-control">
            </div>
            <div class="form-group">
                <label for="name">Descripcion</label>
                <input type="text" name="description"  value="{{$item->description}}" class="form-control">
            </div>
        </div>
        <div class="modal-footer" style="align-content: center">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button class="btn btn-success" type="submit">Guardar </button>
        </div>
    </form>
    </div>
    </div>
</div>
@endforeach

<div id="crear" class="modal fade" role="dialog">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLabel">Crear Categoria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
    <form action="{{route('category_store')}}" method="POST">
        @csrf
        <div class="modal-body">

            <div class="form-group">
                <label for="name">Nombre</label><label style="color: red"> *</label>
                <input type="text" name="name" required class="form-control">
            </div>
            <div class="form-group">
                <label for="name">Descripcion</label>
                <input type="text" name="description"  class="form-control">
            </div>
        </div>
        <div class="modal-footer" style="align-content: center">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button class="btn btn-primary" type="submit">Crear</button>
        </div>
    </form>
    </div>
    </div>
</div>

