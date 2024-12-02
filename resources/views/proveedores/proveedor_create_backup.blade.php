@extends("maestra")
@section("titulo", "Agregar proveedor")
@section("contenido")
    <div class="row">
        <div class="col-12">
            <h1>Agregar proveedor</h1>
            <form method="POST" action="{{route("proveedores.store")}}">
                @csrf
                <div class="form-group">
                    <label class="label">Nombre</label>
                    <input required autocomplete="off" name="nombre" class="form-control"
                    type="text" placeholder="Nombre">
                </div>
                <div class="form-group">
                    <label class="label">Teléfono</label>
                    <input required autocomplete="off" name="telefono" class="form-control"
                           type="text" placeholder="Teléfono">
                </div>
                <div class="form-group">
                    <label class="label">calle</label>
                    <input required autocomplete="off" name="calle" class="form-control"
                           type="text" placeholder="Calle">
                </div>
                <div class="form-group">
                    <label class="label">colonia</label>
                    <input required autocomplete="off" name="colonia" class="form-control"
                           type="text" placeholder="Colonia">
                </div>
                <div class="form-group">
                    <label class="label">Nombre de contacto </label>
                    <input required autocomplete="off" name="nombre_contacto" class="form-control"
                           type="text" placeholder="Nombre de conctacto">
                </div>
                <div class="form-group">
                    <label class="label">Apellido de contacto</label>
                    <input required autocomplete="off" name="apellido_contacto" class="form-control"
                           type="text" placeholder="Apellido de contacto">
                </div>
                <div class="form-group">
                    <label class="label">Comentarios</label>
                    <input required autocomplete="off" name="comentarios" class="form-control"
                           type="text" placeholder="Comentarios">
                </div>

                @include("notificacion")
                <button class="btn btn-success">Guardar</button>
                <a class="btn btn-primary" href="{{route("proveedores.index")}}">Volver al listado</a>
            </form>
        </div>
    </div>
@endsection
