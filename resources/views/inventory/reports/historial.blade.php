

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('assets/inventario/bootstrap.min.css')}}">


</head>
<body>
    <p class="text-center">HISTORIAL INVENTARIO PRODUCTO</p>
    <table class="table table-condensed table-hover table-striped"  id="bootstrap-data-table_length">
        <thead>
          <tr>
            <th>#</th>
           <th>Producto</th>
           <th>Id Registro</th>
           <th>Stock Anterior</th>
           <th>Stock Actual</th>
           <th>Fecha</th>


          </tr>
        </thead>
        <tbody>
            @foreach ($history as $key => $item)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->code}}</td>
                <td>{{$item->lastStock}}</td>
                <td>{{$item->actualStock}}</td>
                <td>{{$item->created_at}}</td>


            </tr>
            @endforeach
      </tbody>
    </table>
</body>
</html>
