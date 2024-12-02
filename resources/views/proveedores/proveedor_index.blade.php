{{-- resources/views/proveedores/index.blade.php --}}
{{--@extends('layouts.app')--}}
@extends("maestra")
@section("titulo", "Proveedores")
@section("contenido")
<div class="row">
    <div class="col-12">
        <h1>Proveedores <i class="fa fa-box"></i></h1>
        <a href="{{ route('proveedores.create') }}" class="btn btn-success mb-2">Agregar</a>
        @include("notificacion")
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Calle</th>
                        <th>Colonia</th>
                        <th>Nombre de contacto</th>
                        <th>Apellido de contacto</th>
                        <th>Servicio</th> <!-- Nueva columna para el servicio -->
                        <th>Comentarios</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($proveedores as $proveedor)
                        <tr>
                            <td>{{ $proveedor->nombre }}</td>
                            <td>{{ $proveedor->telefono }}</td>
                            <td>{{ $proveedor->calle }}</td>
                            <td>{{ $proveedor->colonia }}</td>
                            <td>{{ $proveedor->nombre_contacto }}</td>
                            <td>{{ $proveedor->apellido_contacto }}</td>
                            <td>{{$proveedor->servicio->nombre_servicio ?? 'N/A'}}</td> <!-- Mostrar el servicio -->
                            <td>{{ $proveedor->comentarios }}</td>
                            <td>
                                <a class="btn btn-warning" href="{{ route('proveedores.edit', $proveedor) }}">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>
                            <td>
                                <form action="{{ route('proveedores.destroy', $proveedor) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
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
