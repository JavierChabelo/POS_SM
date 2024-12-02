@extends("maestra")
@section("titulo", "Editar proveedor")
@section("contenido")
<div class="row">
    <div class="col-12">
        <h1>Editar proveedor</h1>
        <form method="POST" action="{{ route('proveedores.update', $proveedor->id) }}">
            @method("PUT")
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
                <input required value="{{ old('nombre', $proveedor->nombre) }}" autocomplete="off" name="nombre"
                       class="form-control" type="text" placeholder="Nombre" pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s]{1,30}"
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
                        <option value="{{ $servicio->id }}" {{ $proveedor->servicio_id == $servicio->id ? 'selected' : '' }}>
                            {{ $servicio->nombre_servicio }}
                        </option>
                    @endforeach
                </select>
                @error('servicio_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label class="label">Teléfono</label>
                <input required value="{{ old('telefono', $proveedor->telefono) }}" autocomplete="off" name="telefono"
                       class="form-control" type="text" placeholder="Teléfono" pattern="\d{10}" inputmode="numeric"
                       title="Debe contener exactamente 10 dígitos">
                @error('telefono')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="label">Calle</label>
                <input required value="{{ old('calle', $proveedor->calle) }}" autocomplete="off" name="calle"
                       class="form-control" type="text" placeholder="Calle">
                @error('calle')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="label">Colonia</label>
                <input required value="{{ old('colonia', $proveedor->colonia) }}" autocomplete="off" name="colonia"
                       class="form-control" type="text" placeholder="Colonia">
                @error('colonia')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="label">Nombre de contacto</label>
                <input required value="{{ old('nombre_contacto', $proveedor->nombre_contacto) }}" autocomplete="off"
                       name="nombre_contacto" class="form-control" type="text" placeholder="Nombre de contacto"
                       pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s]{1,30}" title="Solo se permiten letras y espacios. Máximo 30 caracteres.">
                @error('nombre_contacto')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="label">Apellido de contacto</label>
                <input required value="{{ old('apellido_contacto', $proveedor->apellido_contacto) }}" autocomplete="off"
                       name="apellido_contacto" class="form-control" type="text" placeholder="Apellido de contacto"
                       pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s]{1,30}" title="Solo se permiten letras y espacios. Máximo 30 caracteres.">
                @error('apellido_contacto')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="label">Comentarios</label>
                <input value="{{ old('comentarios', $proveedor->comentarios) }}" autocomplete="off" name="comentarios"
                       class="form-control" type="text" placeholder="Comentarios">
                @error('comentarios')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            @include("notificacion")
            <button class="btn btn-success">Guardar</button>
            <a class="btn btn-primary" href="{{ route('proveedores.index') }}">Volver</a>
        </form>
    </div>
</div>
@endsection