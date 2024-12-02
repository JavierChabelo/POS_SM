@extends("maestra")
@section("titulo", "compra")
@section("contenido")
<div class="container">
    <h1>Registrar Compra</h1>
    <form action="{{ route('compras.store') }}" method="POST">
        @csrf

        <div class="row mb-4">
            <!-- Proveedor -->
            <div class="col-md-4">
                <label for="proveedor_id" class="form-label">Proveedor</label>
                <select id="proveedor_id" name="proveedor_id" class="form-select" required>
                    <option value="">Seleccione un proveedor</option>
                    @foreach($proveedores as $proveedor)
                        <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Producto -->
            <div class="col-md-4">
                <label for="producto_id" class="form-label">Producto</label>
                <select id="producto_id" name="producto_id" class="form-select" required>
                    <option value="">Seleccione un producto</option>
                    @foreach($productos as $producto)
                        <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Cantidad -->
            <div class="col-md-4">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="number" id="cantidad" name="cantidad" class="form-control" min="1" required>
            </div>
        </div>

        <!-- Botón Agregar -->
        <div class="text-center mb-4">
            <button type="submit" class="btn btn-primary">Agregar</button>
        </div>
    </form>

    <!-- Lista de compra -->
    <h2>Lista de compra Agregadas</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Proveedor</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Fecha</th>
                <th>Monto</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($compraslist as $compra)
                <tr>
                    <td>{{ $compra->proveedor->nombre }}</td>
                    <td>{{ $compra->producto->nombre }}</td>
                    <td>{{ $compra->cantidad }}</td>
                    <td>{{ $compra->fecha }}</td>
                    <td>{{ $compra->monto }}</td>
                    <td>
                        <!-- Opcional: Añadir botones para editar o eliminar -->
                        <a href="{{ route('compra.edit', $compra->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('compra.destroy', $compra->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
