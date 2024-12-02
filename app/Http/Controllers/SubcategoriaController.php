<?php

namespace App\Http\Controllers;

use App\Subcategoria;
//use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class SubcategoriaController extends Controller
{
    public function index()
    {
        $subcategorias = Subcategoria::where('estado', true)->get();
        return view('Subcategorias.subcategoria_index', compact('subcategorias'));
    }

    public function create()
    {
        return view('Subcategorias.subcategoria_create');
    }

    public function store(Request $request)
    {
       // Validar los campos del formulario
       $request->validate([
        'nombre_subcategoria' => 'required|string|max:255',
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
      $subcategoria = new Subcategoria();
      $subcategoria->nombre_subcategoria = $request->input('nombre_subcategoria');
      $subcategoria->imagen = $imagePath;
      $subcategoria->save();

     // Redirigir a la vista de índice de categorías con un mensaje de éxito
     return redirect()->route('subcategorias.index')->with('success', 'Subcategoría creada exitosamente');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $subcategoria = Subcategoria::findOrFail($id);
        return view('Subcategorias.subcategoria_edit', compact('subcategoria'));
    }

    public function update(Request $request, $id)
    {
        // Validar los datos recibidos
        $request->validate([
            'nombre_subcategoria' => 'required|string|max:255|unique:subcategoria,nombre_subcategoria,' . $id,
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        // Encontrar la categoría que se va a actualizar
        $subcategoria = Subcategoria::findOrFail($id);
    
       // Si hay una imagen, actualizarla
       if ($request->hasFile('imagen')) {
        $imagePath = $request->file('imagen')->store('images', 'public');
        $subcategoria->imagen = $imagePath;
       }
    
        // Actualizar los datos de la categoría
       $subcategoria->nombre_subcategoria = $request->input('nombre_subcategoria');
       $subcategoria->save();
    
        return redirect()->route('subcategorias.index')->with('success', 'Subcategoría actualizada exitosamente');
    }

    public function destroy($id)
    {
        $subcategoria = Subcategoria::findOrFail($id);
        $subcategoria->update(['estado' => false]);

        return redirect()->route('subcategorias.index')->with('mensaje', 'Subcategoría desactivada');
    }
}
