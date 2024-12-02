@extends("maestra")
@section("titulo", "Lista de Compras")
@section("contenido")
<div class="container">
    <h1>Lista de Compras</h1>
    <a href="{{ route('compras.create') }}" class="btn btn-success mb-3">Agregar Nueva Compra</a>

    <!-- Mostrar mensajes de éxito y error -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @include('notificacion')

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Número de Compra</th>
                    <th>Proveedor</th>
                    <th>Fecha</th>
                    <th>Monto Total</th>
                    <th>Detalles</th>

                </tr>
            </thead>
            <tbody>
                @foreach($compraslist as $compra)
                    <tr>
                        <td>{{ $compra->id }}</td>
                        <td>{{ $compra->proveedor->nombre }}</td>
                        <td>{{ \Carbon\Carbon::parse($compra->fecha)->format('d/m/Y') }}</td>
                        <td>${{ number_format($compra->monto, 2) }}</td>

                        <td>
                            <div class="mb-3">
                                <a href="{{ route('compras.detalles', $compra->id) }}" class="btn btn-primary">Ver Detalles</a>
                            </div>
                            <div id="detalles-{{ $compra->id }}" class="collapse mt-2">
                                <table class="table table-sm table-bordered mt-2">
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
                                                <td>{{ $detalle->costo_venta }}</td>
                                                <td>{{ $detalle->precio_venta }}</td>
                                                <td>{{ $detalle->total }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
