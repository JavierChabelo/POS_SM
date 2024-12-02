<?php

namespace App\Http\Controllers;

use App\Categoria;
//use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::where('estado', true)->get();
        return view('Categorias.categoria_index', compact('categorias'));
    }

    public function create()
    {
        return view('Categorias.categoria_create');
    }

    public function store(Request $request)
{
    // Validar los campos del formulario
    $request->validate([
        'nombre_categoria' => 'required|string|max:255',
        'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Aquí puedes colocar el Log para inspeccionar los datos recibidos
    Log::info($request->all()); // Registra toda la información enviada en la solicitud
    Log::info($request->file('imagen')); // Registra detalles del archivo (si se subió uno)

    // Si se ha subido un archivo de imagen, guárdalo en la carpeta 'public/images'
    if ($request->hasFile('imagen')) {
        $imagePath = $request->file('imagen')->store('images', 'public');
    } else {
        $imagePath = null; // Si no se sube imagen, se guarda como null
    }

    // Crear y guardar la categoría en la base de datos
    $categoria = new Categoria();
    $categoria->nombre_categoria = $request->input('nombre_categoria');
    $categoria->imagen = $imagePath;
    $categoria->save();

    // Redirigir a la vista de índice de categorías con un mensaje de éxito
    return redirect()->route('categorias.index')->with('success', 'Categoría creada exitosamente');
}

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('Categorias.categoria_edit', compact('categoria'));
    }

    public function update(Request $request, $id)
    {
        // Validar los datos recibidos
        $request->validate([
            'nombre_categoria' => 'required|string|max:255|unique:categoria,nombre_categoria,' . $id,
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        // Encontrar la categoría que se va a actualizar
        $categoria = Categoria::findOrFail($id);
    
       // Si hay una imagen, actualizarla
       if ($request->hasFile('imagen')) {
        $imagePath = $request->file('imagen')->store('images', 'public');
        $categoria->imagen = $imagePath;
       }
    
        // Actualizar los datos de la categoría
       $categoria->nombre_categoria = $request->input('nombre_categoria');
       $categoria->save();
    
        return redirect()->route('categorias.index')->with('success', 'Categoría actualizada exitosamente');
    }

    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->update(['estado' => false]);

        return redirect()->route('categorias.index')->with('mensaje', 'Categoría desactivada');
    }
}
