
@extends("maestra")
@section("titulo", "Productos")
@section("contenido")
    <div class="row">
        <div class="col-12">
            <h1>Productos <i class="fa fa-box"></i></h1>
            <a href="{{route("productos.create")}}" class="btn btn-success mb-2">Agregar</a>
            <a href="{{route("categorias.index")}}" class="btn btn-info mb-2">Ver Categorías</a>
            <a href="{{route("subcategorias.index")}}" class="btn btn-info mb-2">Ver Subctegorías</a>
            @include("notificacion")
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Precio de compra</th>
                        <th>Precio de venta</th>
                        <th>Existencia</th>
                        <th>Categoría</th>
                        <th>Subcategoría</th>
                        <th>Comentario</th>
                        <th>Imagen</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($productos as $producto)
                        <tr>
                            <td>{{$producto->nombre}}</td>
                            <td>{{$producto->precio_compra}}</td>
                            <td>{{$producto->precio_venta}}</td>
                            <td>{{$producto->existencia}}</td>
                            <td>{{$producto->categoria->nombre_categoria ?? 'N/A'}}</td>
                            <td>{{$producto->subcategoria->nombre_subcategoria ?? 'N/A'}}</td>
                            <td>{{$producto->comentario}}</td>
                            <td>
                                @if($producto->imagen_url)
                                    <img src="{{ asset('storage/' . $producto->imagen_url) }}" alt="Imagen del producto" class="imagen">
                                    @else 
                                    No disponible
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-warning" href="{{route("productos.edit",$producto) }}">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>
                            <td>
                                <form action="{{route("productos.destroy", $producto) }}" method="POST">
                                    @csrf
                                    @method("delete")
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
