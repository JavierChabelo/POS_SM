@extends('maestra')
@section('titulo', 'Crear Categoría')
@section('contenido')
<div class="row">
    <div class="col-12">
        <h1>Crear Nueva Categoría</h1>
        <a href="{{ route('categorias.index') }}" class="btn btn-primary mb-2">Volver</a>
        
        @include('notificacion')

        <form action="{{ route('categorias.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nombre_categoria">Nombre Categoría</label>
                <input type="text" name="nombre_categoria" id="nombre_categoria" 
                 class="form-control" value="{{ old('nombre_categoria') }}" required maxlength="255">
                @error('nombre_categoria')
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

            <button type="submit" class="btn btn-success">Crear Categoría</button>
        </form>
    </div>
</div>
@endsection


