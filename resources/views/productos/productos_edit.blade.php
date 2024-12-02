
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
                    <label class="label">Nombre</label>
                    <input required value="{{$producto->nombre}}" autocomplete="off" name="nombre"
                           class="form-control"
                           type="text" placeholder="Nombre del producto">
                </div>
                
                <div class="form-group">
                    <label for="precio_compra">Precio de Compra</label>
                    <input type="number" name="precio_compra" id="precio_compra" class="form-control" 
                           value="{{ old('precio_compra', $producto->precio_compra) }}" required min="0" step="0.01">
                    @error('precio_compra')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="precio_venta">Precio de Venta</label>
                    <input type="number" name="precio_venta" id="precio_venta" class="form-control" 
                           value="{{ old('precio_venta', $producto->precio_venta) }}" required min="0" step="0.01">
                    @error('precio_venta')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="existencia">Existencia</label>
                    <input type="number" name="existencia" id="existencia" class="form-control" 
                           value="{{ old('existencia', $producto->existencia) }}" required min="0" step="1">
                    @error('existencia')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="label">Categoría</label>
                    <select name="categoria_id" class="form-control" required>
                        <option value="">Seleccione una categoría</option>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ $producto->categoria_id == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nombre_categoria }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="label">Subcategoría</label>
                    <select name="subcategoria_id" class="form-control">
                        <option value="">Seleccione una subcategoría (opcional)</option>
                        @foreach($subcategorias as $subcategoria)
                            <option value="{{ $subcategoria->id }}" {{ $producto->subcategoria_id == $subcategoria->id ? 'selected' : '' }}>
                                {{ $subcategoria->nombre_subcategoria }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="label">Imagen del Producto</label>
                    <input type="file" name="imagen" class="form-control" accept="image/*">
                    @if($producto->imagen_url)
                        <img src="{{ asset('storage/' . $producto->imagen_url) }}" alt="Imagen del producto" width="100">
                    @endif
                </div>

                <div class="form-group">
                    <label for="comentario">Comentario</label>
                    <input type="text" name="comentario" id="comentario" class="form-control" value="{{ old('comentario', $producto->comentario) }}">
                    @error('comentario')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                
                @include("notificacion")
                <button class="btn btn-success">Guardar</button>
                <a class="btn btn-primary" href="{{route("productos.index")}}">Volver</a>
            </form>
        </div>
    </div>
@endsection
