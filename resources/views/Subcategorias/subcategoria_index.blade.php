@extends('maestra')
@section('titulo', 'Lista de Subcategorías')
@section('contenido')
<div class="row">
    <div class="col-12">
        <h1>Subcategorías</h1>
        <a href="{{ route('subcategorias.create') }}" class="btn btn-success mb-2">Agregar Nueva Subcategoría</a>
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
                    @foreach($subcategorias as $subcategoria)
                    <tr>
                        <td>{{ $subcategoria->nombre_subcategoria }}</td>
                        <td>
                            @if($subcategoria->imagen)
                                <img src="{{ asset('storage/'.$subcategoria->imagen) }}" alt="Imagen de {{ $subcategoria->nombre_subcategoria }}" class="imagen">
                            @else
                                No Disponible
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-warning" href="{{ route('subcategorias.edit', $subcategoria->id) }}"><i class="fa fa-edit"></i></a>
                        </td>
                        <td>
                            <form action="{{ route('subcategorias.destroy', $subcategoria->id) }}" method="POST">
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
