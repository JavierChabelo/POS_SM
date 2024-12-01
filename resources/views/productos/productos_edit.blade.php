@extends("maestra")
@section("titulo", "Editar producto")
@section("contenido")
    <div class="row">
        <div class="col-12">
            <h1>Editar producto</h1>
            <form method="POST" action="{{route("productos.update", [$producto])}}">
                @method("PUT")
                @csrf
                <div class="form-group">
                    <label class="label">Código de barras</label>
                    <input required value="{{$producto->codigo_barras}}" autocomplete="off" name="codigo_barras"
                           class="form-control"
                           type="number" placeholder="Código de barras">
                        </div>
                <div class="form-group">
                    <label class="label">Descripción</label>
                    <input required value="{{$producto->descripcion}}" autocomplete="off" name="descripcion"
                           class="form-control"
                           type="text" placeholder="Descripción">
                </div>
                <div class="form-group">
                    <label class="label">Precio de compra</label>
                    <input required value="{{$producto->precio_compra}}" autocomplete="off" name="precio_compra"
                           class="form-control"
                           type="number" step="0.01" placeholder="Precio de compra">
                        </div>
                <div class="form-group">
                    <label class="label">Precio de venta</label>
                    <input required value="{{$producto->precio_venta}}" autocomplete="off" name="precio_venta"
                           class="form-control"
                           type="number" step="0.01" placeholder="Precio de venta">
                        </div>
                <div class="form-group">
                    <label class="label">Existencia</label>
                    <input required value="{{$producto->existencia}}" autocomplete="off" name="existencia"
                           class="form-control"
                           type="number" placeholder="Existencia" min="0" step="1">
                        </div>
                @include("notificacion")
                <button class="btn btn-success">Guardar</button>
                <a class="btn btn-primary" href="{{route("productos.index")}}">Volver</a>
            </form>
        </div>
    </div>
@endsection