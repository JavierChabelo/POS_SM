<?php
 ?>
<?php

namespace App\Http\Controllers;

use App\Producto;
use App\Proveedor;
use App\Compra;
use App\DetalleCompra;
use App\Categoria;
use App\Subcategoria;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

use function Psy\debug;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$productos = Producto::where('estado', true)->get(); // Solo productos activos
        //$productos = Producto::with('categoria', 'subcategoria')->where('estado', true)->get();
        debug();
        $productos = Producto::with('categoria', 'subcategoria')->where('estado', true)->get();
        return view('productos.productos_index', compact('productos'));
        
        //return view("productos.productos_index", ["productos" => Producto::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         // Traemos las categorías y subcategorías activas
        $categorias = Categoria::where('estado', true)->get();
        $subcategorias = Subcategoria::where('estado', true)->get();

        // Verificar si hay datos en las consultas (opcional, para debugging)
        Log::info('Categorías obtenidas: ' . $categorias);
        Log::info('Subcategorías obtenidas: ' . $subcategorias);

        return view("productos.productos_create", compact('categorias', 'subcategorias'));

        //return view("productos.productos_create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        // Validación de campos
        $request->validate([
            'nombre' => 'required|string|max:255',
            //'descripcion' => 'required|string|max:255',
            'precio_compra' => 'required|numeric',
            'precio_venta' => 'required|numeric',
            'existencia' => 'required|integer',
            'categoria_id' => 'required|exists:categoria,id',
            'subcategoria_id' => 'nullable|exists:subcategoria,id',
            'comentario' => 'nullable|string|max:255',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Verificar los datos recibidos
        Log::info('Datos recibidos para almacenar el producto:', $request->all());

        // Crear producto sin imagen inicialmente
        $producto = new Producto($request->except('imagen'));
        // Si hay imagen, la guardamos
        if ($request->hasFile('imagen')) {
             $imagePath = $request->file('imagen')->store('imagenes_productos', 'public');
             $producto->imagen_url = $imagePath;
        }

        $producto->save();

         // Verificar si el producto se guardó correctamente
        Log::info('Producto guardado: ', $producto->toArray());
        return redirect()->route("productos.index")->with("mensaje", "Producto guardado exitosamente");
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Producto $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Producto $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        // Traemos las categorías y subcategorías activas
        $categorias = Categoria::where('estado', true)->get();
        $subcategorias = Subcategoria::where('estado', true)->get();
        return view("productos.productos_edit", compact('producto', 'categorias', 'subcategorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Producto $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        // Validación de campos
        $request->validate([
            'nombre' => 'required|string|max:255',
            //'descripcion' => 'required|string|max:255',
            'precio_compra' => 'required|numeric',
            'precio_venta' => 'required|numeric',
            'existencia' => 'required|integer',
            'categoria_id' => 'required|exists:categoria,id',
            'subcategoria_id' => 'nullable|exists:subcategoria,id',
            'comentario' => 'nullable|string|max:255',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Actualizar producto con los datos del formulario, sin modificar la imagen
        $producto->fill($request->except('imagen'));
        // Si hay imagen, la actualizamos
        if ($request->hasFile('imagen')) {
            $imagePath = $request->file('imagen')->store('imagenes_productos', 'public');
            $producto->imagen_url = $imagePath;
        }
        $producto->save(); // Guardar cambios
        return redirect()->route("productos.index")->with("mensaje", "Producto actualizado exitosamente");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Producto $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        // Desactivar producto en lugar de eliminar
        $producto->update(['estado' => false]); // Cambia el estado a inactivo
        return redirect()->route("productos.index")->with("mensaje", "Producto desactivado");
    }
}
