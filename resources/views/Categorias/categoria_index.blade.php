@extends('maestra')
@section('titulo', 'Lista de Categorías')
@section('contenido')
<div class="row">
    <div class="col-12">
        <h1>Categorías</h1>
        <a href="{{ route('categorias.create') }}" class="btn btn-success mb-2">Agregar Nueva Categoría</a>
        
        @include('notificacion')

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Imagen</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categorias as $categoria)
                    <tr>
                        <td>{{ $categoria->nombre_categoria }}</td>
                        <td>
                            @if($categoria->imagen)
                                <img src="{{ asset('storage/'.$categoria->imagen) }}" alt="Imagen de {{ $categoria->nombre_categoria }}" class="imagen">
                            @else
                                No Disponible
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-warning" href="{{ route('categorias.edit', $categoria->id) }}"><i class="fa fa-edit"></i></a>
                        </td>
                        <td>
                            <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

