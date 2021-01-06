<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('assets/inventario/bootstrap.min.css')}}">


</head>
<body>
    <p class="text-center">LISTADO PRODUCTOS CLASIFICADOS POR CATEGORIA</p>
    <table class="table table-condensed table-hover table-striped"  id="bootstrap-data-table_length">
        <thead class="thead-light">
        <tr>
          <th>#</th>
          <th class="text-center">Código</th>

          <th>Modelo </th>
          <th>Producto </th>
          <th>Categoria </th>
          <th class="text-center">Estado</th>
          <th class="text-center">Stock</th>



        </tr>
      </thead>
      <tbody>

         @foreach ($products as $key => $item)
         <tr>
          <th scope="row">{{$key+1}}</th>
          <td>{{$item->code}}</td>

          <td class="text-center">{{$item->model}}</td>
          <td> {{$item->product}}</td>
          <td>{{$item->category}}</td>
          <td class="text-center">
              @if ($item->state == true)
              ACTIVO
              @else
              INACTIVO
              @endif

          </td>
          <td class="text-center">{{$item->stock}}</td>




        </tr>
         @endforeach


    </tbody>
    </table>
</body>
</html>
