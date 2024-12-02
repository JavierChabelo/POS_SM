@extends('maestra')
@section('titulo', 'Crear Subcategoría')
@section('contenido')
<div class="row">
    <div class="col-12">
        <h1>Crear Nueva Subcategoría</h1>
        <a href="{{ route('subcategorias.index') }}" class="btn btn-primary mb-2">Volver</a>
        
        @include('notificacion')

        <form action="{{ route('subcategorias.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nombre_subcategoria">Nombre Subcategoría</label>
                <input type="text" name="nombre_subcategoria" id="nombre_subcategoria" 
                 class="form-control" value="{{ old('nombre_subcategoria') }}" required maxlength="255">
                @error('nombre_subcategoria')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="imagen">Imagen (opcional)</label>
                <input type="file" name="imagen" id="imagen" class="form-control" accept="image/*">
                @error('imagen')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Crear Subcategoría</button>
        </form>
    </div>
</div>
@endsection
