<?php

namespace App\Http\Controllers;

use App\Proveedor;
use App\Servicio; // Importar el modelo Servicio
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
         // Obtener todos los proveedores junto con el servicio relacionado
        $proveedores = Proveedor::with('servicio')->where('estado', true)->get();
        return view('proveedores.proveedor_index', compact('proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Obtener todos los servicios para el dropdown
        $servicios = Servicio::all();
        return view('proveedores.proveedor_create', compact('servicios'));
        //return view("proveedores.proveedor_create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            //'nombre' => 'required|string|max:20|regex:/^[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+$/',
            'nombre' => 'required|string|max:20|regex:/^[A-Za-z\xC0-\xFF\s]+$/',
            'telefono' => 'required|digits:10',
            'calle' => 'required|string|max:50',
            'colonia' => 'required|string|max:50',
            'nombre_contacto' => 'required|string|max:30|regex:/^[A-Za-z\xC0-\xFF\s]+$/',
            'apellido_contacto' => 'required|string|max:30|regex:/^[A-Za-z\xC0-\xFF\s]+$/',
            //'nombre_contacto' => 'required|string|max:30|regex:/^[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+$/',
            //'apellido_contacto' => 'required|string|max:30|regex:/^[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+$/',
            'comentarios' => 'nullable|string|max:255',
            'servicio_id' => 'required|exists:servicio,id',
        ]);
    
         // Crear y guardar el proveedor
         Proveedor::create($request->all());
        //$proveedores = new Proveedor($request->input());
        //$proveedores->saveOrFail();
        //return redirect()->route("proveedores.proveedor_create")->with("mensaje", "Proveedor guardado");
        return redirect()->route("proveedores.index")->with("mensaje", "Proveedor guardado exitosamente");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Proveedor  $proveedores
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Proveedores $proveedores
     * @return \Illuminate\Http\Response
     */
    public function edit(Proveedor $proveedor)
    {
        // Obtener todos los servicios para el dropdown // Mostrar la vista para editar un proveedor
        $servicios = Servicio::all();
        return view('proveedores.proveedor_edit', compact('proveedor', 'servicios'));
         //return view('proveedores.proveedor_edit', compact('proveedor'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Proveedor $proveedores
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proveedor $proveedor)
    {
        // Validación de campos
        $request->validate([
            'nombre' => 'required|string|max:20|regex:/^[A-Za-z\xC0-\xFF\s]+$/',
            'telefono' => 'required|digits:10',
            'calle' => 'required|string|max:50',
            'colonia' => 'required|string|max:50',
            'nombre_contacto' => 'required|string|max:30|regex:/^[A-Za-z\xC0-\xFF\s]+$/',
            'apellido_contacto' => 'required|string|max:30|regex:/^[A-Za-z\xC0-\xFF\s]+$/',
            'comentarios' => 'nullable|string|max:255',
            'servicio_id' => 'required|exists:servicio,id',
        ]); 
        
        // Actualizar el proveedor con los datos del formulario
        $proveedor->update($request->all());

        //$proveedores->fill($request->input());
        //$proveedores->saveOrFail();
        //return redirect()->route("proveedores.proveedor_index")->with("mensaje", "Porveedor actualizado");
        return redirect()->route("proveedores.index")->with("mensaje", "Proveedor actualizado");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Proveedor $proveedores
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proveedor $proveedor)
    {
        //
        //$proveedores->delete();
        //return redirect()->route("proveedor_index")->with("mensaje", "Proveedor eliminado");
        $proveedor->update(['estado' => false]);

        return redirect()->route("proveedores.index")->with("mensaje", "Proveedor eliminado");

    }
}
