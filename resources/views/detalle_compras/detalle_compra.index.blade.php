@extends("maestra")
@section("titulo", "Detalles de la Compra")
@section("contenido")
<div class="container">
    <h1>Detalles de la Compra - #{{ $compra->numero_compra }}</h1>
    <a href="{{ route('compras.index') }}" class="btn btn-primary mb-2">Volver a Compras</a>
    @include("notificacion")

    <form action="{{ route('detalle_compra.store', $compra->id) }}" method="POST">
        @csrf
        <div class="row mb-4">
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
            <div class="col-md-3">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="number" id="cantidad" name="cantidad" class="form-control" min="1" required>
            </div>

            <!-- Precio Venta -->
            <div class="col-md-3">
                <label for="precio_venta" class="form-label">Precio de Venta</label>
                <input type="number" id="precio_venta" name="precio_venta" class="form-control" step="0.01" required>
            </div>

            <!-- Botón Agregar -->
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-success">Agregar</button>
            </div>
        </div>
    </form>

    <h2>Detalles de la Compra</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Venta</th>
                <th>Costo Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($detalles as $detalle)
                <tr>
                    <td>{{ $detalle->producto->nombre }}</td>
                    <td>{{ $detalle->cantidad }}</td>
                    <td>{{ $detalle->precio_venta }}</td>
                    <td>{{ $detalle->total }}</td>
                    <td>
                        <a href="{{ route('detalle_compra.edit', $detalle->id) }}" class="btn btn-warning btn-sm">
                            <i class="fa fa-edit"></i> Editar
                        </a>
                        <form action="{{ route('detalle_compra.destroy', $detalle->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fa fa-trash"></i> Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
