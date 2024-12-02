
@extends("maestra")
@section("titulo", "Agregar producto")
@section("contenido")
    <div class="row">
        <div class="col-12">
            <h1>Agregar producto</h1>
            <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if ($errors->any())
                 <div class="alert alert-danger">
                   <ul>
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                   </ul>
                 </div>
                @endif

                <div class="form-group">
                    <label class="label">Nombre</label>
                    <input required autocomplete="off" name="nombre" class="form-control"
                           type="text" placeholder="Nombre del producto">
                    @error('nombre')
                           <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="precio_compra">Precio de Compra</label>
                    <input type="number" name="precio_compra" id="precio_compra" class="form-control" 
                           value="{{ old('precio_compra') }}" required min="0" step="0.01">
                    @error('precio_compra')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="precio_venta">Precio de Venta</label>
                    <input type="number" name="precio_venta" id="precio_venta" class="form-control" 
                           value="{{ old('precio_venta') }}" required min="0" step="0.01">
                    @error('precio_venta')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="existencia">Existencia</label>
                    <input type="number" name="existencia" id="existencia" class="form-control" 
                          value="{{ old('existencia') }}" required min="0" step="1">
                    @error('existencia')
                     <div class="text-danger">{{ $message }}</div>
                     @enderror
                </div>

               <!-- Categoría -->
               <div class="form-group">
                 <label for="categoria_id">Categoría</label>
                 <select name="categoria_id" id="categoria_id" class="form-select" required>
                    <option value="">Seleccione una categoría</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nombre_categoria }}</option>
                    @endforeach
                 </select>
                   @error('categoria_id')
                    <div class="text-danger">{{ $message }}</div>
                   @enderror
               </div>

                <!-- Subcategoría -->
                <div class="form-group">
                    <label for="subcategoria_id">Subcategoría (opcional)</label>
                    <select name="subcategoria_id" id="subcategoria_id" class="form-select">
                        <option value="">Seleccione una subcategoría</option>
                        @foreach ($subcategorias as $subcategoria)
                            <option value="{{ $subcategoria->id }}">{{ $subcategoria->nombre_subcategoria }}</option>
                        @endforeach
                    </select>
                    @error('subcategoria_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="label">Imagen del Producto</label>
                    <input type="file" name="imagen" class="form-control" accept="image/*">
                </div>
                <div class="form-group">
                    <label for="comentario">Comentario</label>
                    <input type="text" name="comentario" id="comentario" class="form-control" value="{{ old('comentario') }}">
                    @error('comentario')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                @include("notificacion")
                <button class="btn btn-success">Guardar</button>
                <a class="btn btn-primary" href="{{route("productos.index")}}">Volver al listado</a>
            </form>
        </div>
    </div>
@endsection
