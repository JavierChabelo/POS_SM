@extends("maestra")
@section("titulo", "Editar proveedor")
@section("contenido")
<div class="row">
    <div class="col-12">
        <h1>Editar proveedor</h1>
        <form method="POST" action="{{route("proveedores.update", [$proveedores])}}">
            @method("PUT")
            @csrf
            <div class="form-group">
                <label class="label">Nombre</label>
                <input required value="{{$proveedores->nombre}}" autocomplete="off" name="Nombre"
                class="form-control"
                 type="text" placeholder="Nombre" pattern="[A-Za-z] {1,30}" title="Solo se permiten letras">
            </div>
            <div class="form-group">
                <label class="label">Teléfono</label>
                <input required value="{{$proveedores->telefono}}" autocomplete="off" name="telefono"
                       class="form-control"
                       type="text" placeholder="Telefono">
            </div>
            <div class="form-group">
                <label class="label">Calle</label>
                <input required value="{{$proveedores->calle}}" autocomplete="off" name="direccion"
                       class="form-control"
                       type="text" placeholder="Calle">
            </div>
            <div class="form-group">
                <label class="label">Colonia</label>
                <input required value="{{$proveedores->colonia}}" autocomplete="off" name="direccion"
                       class="form-control"
                       type="text" placeholder="Colonia">
            </div>
            <div class="form-group">
                <label class="label">Nombre de contacto</label>
                <input required value="{{$proveedores->nombre_contacto}}" autocomplete="off" name="nombre_contacto"
                       class="form-control"
                       type="text" placeholder="Nombre de contacto">
            </div>
            <div class="form-group">
                <label class="label">Apellido de contacto</label>
                <input required value="{{$proveedores->apellido_contacto}}" autocomplete="off" name=apellido_contacto
                       class="form-control"
                       type="text" placeholder="Apellido de contacto">
            </div>
            <div class="form-group">
                <label class="label">Comentarios</label>
                <input required value="{{$proveedores->comentarios}}" autocomplete="off" name=comentarios
                       class="form-control"
                       type="text" placeholder="Comentarios">
            </div>

            @include("notificacion")
            <button class="btn btn-success">Guardar</button>
            <a class="btn btn-primary" href="{{route("proveedores.index")}}">Volver</a>
        </form>
    </div>
</div>
@endsection
