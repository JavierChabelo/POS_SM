@extends("maestra")
@section("titulo", "Editar Compra")
@section("contenido")
<div class="container">
    <h1>Editar Compra - #{{ $compra->numero_compra }}</h1>
    <a href="{{ route('compras.index') }}" class="btn btn-primary mb-2">Volver al Listado de Compras</a>
    @include("notificacion")

    <form action="{{ route('compras.update', $compra->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Proveedor -->
        <div class="form-group">
            <label for="proveedor_id">Proveedor</label>
            <select id="proveedor_id" name="proveedor_id" class="form-control" required>
                <option value="">Seleccione un proveedor</option>
                @foreach($proveedores as $proveedor)
                    <option value="{{ $proveedor->id }}" {{ $compra->proveedor_id == $proveedor->id ? 'selected' : '' }}>
                        {{ $proveedor->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Número de Compra -->
        <div class="form-group">
            <label for="numero_compra">Número de Compra</label>
            <input type="text" id="numero_compra" name="numero_compra" class="form-control" value="{{ old('numero_compra', $compra->numero_compra) }}" required>
            @error('numero_compra')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Monto -->
        <div class="form-group">
            <label for="monto">Monto</label>
            <input type="number" id="monto" name="monto" class="form-control" value="{{ old('monto', $compra->monto) }}" step="0.01" required>
            @error('monto')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Fecha -->
        <div class="form-group">
            <label for="fecha">Fecha</label>
            <input type="date" id="fecha" name="fecha" class="form-control" value="{{ old('fecha', $compra->fecha) }}" required>
            @error('fecha')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Botones -->
        <button type="submit" class="btn btn-success">Actualizar Compra</button>
    </form>
</div>
@endsection

