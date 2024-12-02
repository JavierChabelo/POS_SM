@extends('maestra')
@section('titulo', 'Editar Categoría')
@section('contenido')
<div class="row">
    <div class="col-12">
        <h1>Editar Categoría</h1>
        <a href="{{ route('categorias.index') }}" class="btn btn-primary mb-2">Volver</a>
        
        @include('notificacion')

        <form action="{{ route('categorias.update', $categoria->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nombre_categoria">Nombre Categoría</label>
                <input type="text" name="nombre_categoria" id="nombre_categoria"
                class="form-control" value="{{ old('nombre_categoria', $categoria->nombre_categoria) }}" required maxlength="255">
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
                @if ($categoria->imagen)
                    <div class="mt-2">
                        <img src="{{ asset('storage/'.$categoria->imagen) }}" alt="Imagen" style="width: 150px; height: 150px;">
                    </div>
                @endif
            </div>

            <button type="submit" class="btn btn-success">Actualizar Categoría</button>
        </form>
    </div>
</div>
@endsection


