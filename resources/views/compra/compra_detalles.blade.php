@extends("maestra")
@section("titulo", "Detalles de Compra")
@section("contenido")
<div class="container">
    <h1>Detalles de Compra</h1>
    <a href="{{ route('compras.index') }}" class="btn btn-primary mb-3">Volver a la lista de compras</a>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title fs-3">Proveedor: {{ $compra->proveedor->nombre }}</h5>
            <p class="fs-4"><strong>Nombre de Contacto:</strong> {{ $compra->proveedor->nombre_contacto }} {{ $compra->proveedor->apellido_contacto }}</p>
            <p class="fs-4"><strong>Fecha de Compra:</strong> {{ \Carbon\Carbon::parse($compra->fecha)->format('d/m/Y') }}</p>
            <p class="fs-4"><strong>Monto Total:</strong> ${{ number_format($compra->monto, 2) }}</p>
        </div>
    </div>

    <div class="table-responsive mt-4">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Descripción</th>
                    <th>Cantidad</th>
                    <th>Precio de Compra</th>
                    <th>Precio de Venta</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($compra->detalleCompras as $detalle)
                    <tr>
                        <td>{{ $detalle->producto->nombre }}</td>
                        <td>{{ $detalle->descripcion }}</td>
                        <td>{{ $detalle->cantidad }}</td>
                        <td>${{ number_format($detalle->costo_compra, 2) }}</td> <!-- Precio de compra -->
                        <td>${{ number_format($detalle->precio_venta, 2) }}</td>
                        <td>${{ number_format($detalle->cantidad * $detalle->costo_compra, 2) }}</td> <!-- Total de este detalle -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
