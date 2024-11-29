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
                                <option value="{{$cliente->id}}">{{$cliente->nombre}} - Tel. {{$cliente->telefono}}</option>
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
            <div class="col-12 col-md-6">
                <form action="{{route("agregarProductoVenta")}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="codigo">Producto</label>
                        <select id="codigo" required name="codigo" class="form-control" onchange="updateMaxQuantity(this)">
                            <option value="" disabled selected>Seleccione un producto</option>
                            @foreach($productos as $producto)
                                <option value="{{$producto->codigo_barras}}" data-existencia="{{$producto->existencia}}">
                                    {{$producto->descripcion}} - ${{number_format($producto->precio_venta, 2)}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="cantidad">Cantidad</label>
                        <input type="number" id="cantidad" name="cantidad" class="form-control" value="1" min="1" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Agregar producto</button>
                </form>
            </div>
            <script>
                function updateMaxQuantity(select) {
                    const selectedOption = select.options[select.selectedIndex];
                    const existencia = selectedOption.getAttribute('data-existencia');
                    const cantidadInput = document.getElementById('cantidad');
                    
                    // Establecer el valor máximo de cantidad según la existencia del producto
                    cantidadInput.setAttribute('max', existencia);
                    
                    // Si la cantidad actual es mayor que la existencia, ajustarla
                    if (parseInt(cantidadInput.value) > parseInt(existencia)) {
                        cantidadInput.value = existencia;
                    }
                }
            </script>
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
                    Seleccione un producto de la lista</h2>
            @endif
        </div>
    </div>
@endsection