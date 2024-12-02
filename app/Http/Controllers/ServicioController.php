<?php

namespace App\Http\Controllers;

use App\Servicio;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    public function index()
    {
        // Obtener todos los servicios
        $servicios = Servicio::all();
        return view('servicio.index', compact('servicios'));
    }

    public function create()
    {
        // Mostrar formulario de creación de servicios
        return view('servicio.create');
    }

    public function store(Request $request)
    {
        // Validar y almacenar un nuevo servicio
        $request->validate([
            'nombre_servicio' => 'required|string|max:255',
        ]);

        Servicio::create($request->all());

        return redirect()->route('servicios.index')->with('success', 'Servicio creado exitosamente');
    }

    public function edit(Servicio $servicio)
    {
        // Mostrar formulario para editar un servicio
        return view('servicio.edit', compact('servicio'));
    }

    public function update(Request $request, Servicio $servicio)
    {
        // Validar y actualizar un servicio
        $request->validate([
            'nombre_servicio' => 'required|string|max:255',
        ]);

        $servicio->update($request->all());

        return redirect()->route('servicios.index')->with('success', 'Servicio actualizado exitosamente');
    }

    public function destroy(Servicio $servicio)
    {
        // Eliminar un servicio
        $servicio->delete();
        return redirect()->route('servicios.index')->with('mensaje', 'Servicio eliminado');
    }
}
