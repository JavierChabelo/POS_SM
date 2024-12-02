@extends("maestra")
@section("titulo", "Agregar proveedor")
@section("contenido")
    <div class="row">
        <div class="col-12">
            <h1>Agregar proveedor</h1>
            <form method="POST" action="{{route("proveedores.store")}}">
                @csrf
                <!-- Errorr -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <!-- Nombre -->
                <div class="form-group">
                    <label class="label">Nombre de la tienda del proveedor</label>
                    <input required autocomplete="off" name="nombre"class="form-control" type="text" 
                    value="{{ old('nombre') }}" placeholder="Nombre" pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s]{1,30}"
                     title="Solo se permiten letras y espacios. Máximo 30 caracteres.">
                     @error('nombre')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Servicio -->
                <div class="form-group">
                    <label class="label">Servicio</label>
                    <select name="servicio_id" class="form-control" required>
                        <option value="">Seleccione un servicio</option>
                        @foreach($servicios as $servicio)
                            <option value="{{ $servicio->id }}">{{ $servicio->nombre_servicio }}</option>
                        @endforeach
                    </select>
                    @error('servicio_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Telefono -->
                <div class="form-group">
                    <label class="label">Teléfono</label>
                    <input required autocomplete="off" name="telefono" class="form-control" type="text"
                           value="{{ old('telefono') }}" placeholder="Teléfono" pattern="\d{10}"
                           inputmode="numeric" title="Debe contener exactamente 10 dígitos">
                    @error('telefono')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Calle -->
                <div class="form-group">
                    <label class="label">Calle</label>
                    <input required autocomplete="off" name="calle" class="form-control"type="text" 
                     value="{{ old('calle') }}" placeholder="Calle">
                     @error('calle')
                        <div class="text-danger">{{ $message }}</div>
                     @enderror
                </div>
                <!-- Colonia -->
                <div class="form-group">
                    <label class="label">Colonia</label>
                    <input required autocomplete="off" name="colonia" class="form-control" type="text"
                           value="{{ old('colonia') }}" placeholder="Colonia">
                    @error('colonia')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Nombre Contacto -->
                <div class="form-group">
                    <label class="label">Nombre de contacto</label>
                    <input required autocomplete="off" name="nombre_contacto" class="form-control" type="text"
                           value="{{ old('nombre_contacto') }}" placeholder="Nombre de contacto" 
                           pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s]{1,30}" title="Solo se permiten letras y espacios. Máximo 30 caracteres.">
                    @error('nombre_contacto')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Apellido Contacto -->
                <div class="form-group">
                    <label class="label">Apellido de contacto</label>
                    <input required autocomplete="off" name="apellido_contacto" class="form-control" type="text"
                           value="{{ old('apellido_contacto') }}" placeholder="Apellido de contacto" 
                           pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s]{1,30}" title="Solo se permiten letras y espacios. Máximo 30 caracteres.">
                    @error('apellido_contacto')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Comentarios -->
               <div class="form-group">
                    <label class="label">Comentarios</label>
                    <input autocomplete="off" name="comentarios" class="form-control" type="text"
                           value="{{ old('comentarios') }}" placeholder="Comentarios">
                    @error('comentarios')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                @include("notificacion")
                <button class="btn btn-success">Guardar</button>
                <a class="btn btn-primary" href="{{route("proveedores.index")}}">Volver al listado</a>
            </form>
        </div>
    </div>
@endsection
