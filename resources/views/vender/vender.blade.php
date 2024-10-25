@extends("maestra")
@section("titulo", "Realizar venta")
@section("contenido")
    <div class="row">
        <div class="col-12">
            <h1>Nueva venta <i class="fa fa-cart-plus"></i></h1>
            @include("notificacion")
            <div class="row">
                <div class="col-12 col-md-6">
                    <form action="{{route("terminarOCancelarVenta")}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="id_cliente">Cliente</label>
                            <select required class="form-control" name="id_cliente" id="id_cliente">
                                @foreach($clientes as $cliente)
                                    <option value="{{$cliente->id}}">{{$cliente->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        @if(session("productos") !== null)
                            <div class="form-group">
                                <button name="accion" value="terminar" type="submit" class="btn btn-success">Terminar
                                    venta
                                </button>
                                <button name="accion" value="cancelar" type="submit" class="btn btn-danger">Cancelar
                                    venta
                                </button>
                            </div>
                        @endif
                    </form>
                </div>
                <div class="col-12 col-md-6">
                    <form action="{{route("agregarProductoVenta")}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="id_producto">Producto</label>
                            <select required class="form-control" name="id_producto" id="id_producto">
                                @foreach($productos as $producto)
                                    <option value="{{$producto->id}}">{{$producto->descripcion}} - ${{number_format($producto->precio_venta, 2)}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Agregar Producto</button>
                    </form>
                </div>
            </div>
            @if(session("productos") !== null)
                <h2>Total: ${{number_format($total, 2)}}</h2>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Código de barras</th>
                            <th>Descripción</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Quitar</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach(session("productos") as $producto)
                            <tr>
                                <td>{{$producto->codigo_barras}}</td>
                                <td>{{$producto->descripcion}}</td>
                                <td>${{number_format($producto->precio_venta, 2)}}</td>
                                <td>{{$producto->cantidad}}</td>
                                <td>
                                    <form action="{{route("quitarProductoDeVenta")}}" method="post">
                                        @method("delete")
                                        @csrf
                                        <input type="hidden" name="indice" value="{{$loop->index}}">
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
            @else
                <h2>Aquí aparecerán los productos de la venta
                    <br>
                    Selecciona un producto y presiona "Agregar Producto"</h2>
            @endif
        </div>
    </div>
@endsection