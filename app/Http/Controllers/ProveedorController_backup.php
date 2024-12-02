<?php

namespace App\Http\Controllers;

use App\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$proveedores = Proveedor::all();return view('proveedores.index', compact('proveedores'));
        //return view("proveedores.proveedor_index", ["proveedores" => Proveedor::all()]);
        $proveedores = Proveedor::where('estado', true)->get();
        return view('proveedores.proveedor_index', compact('proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("proveedores.proveedor_create");
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
            'nombre' => 'required|string|max:20|regex:/^[A-Za-z\s]+$/',
            'telefono' => 'required|digits:10',
            'calle' => 'required|string|max:50',
            'colonia' => 'required|string|max:50',
            'nombre_contacto' => 'required|string|max:30|regex:/^[A-Za-z\s]+$/',
            'apellido_contacto' => 'required|string|max:30|regex:/^[A-Za-z\s]+$/',
            'comentarios' => 'nullable|string|max:255',
        ]);
    
        $proveedores = new Proveedor($request->input());
        $proveedores->saveOrFail();
        return redirect()->route("proveedor.index")->with("mensaje", "Proveedor guardado");
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
    public function edit(Proveedor $proveedores)
    {
        //
        return view("proveedores.proveedor_edit", ["proveedores" => $proveedores]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Proveedor $proveedores
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proveedor $proveedores)
    {
        //
        $proveedores->fill($request->input());
        $proveedores->saveOrFail();
        return redirect()->route("proveedores.index")->with("mensaje", "Porveedor actualizado");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Proveedor $proveedores
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proveedor $proveedores)
    {
        //
        $proveedores->delete();
        //return redirect()->route("proveedores.index")->with("mensaje", "Proveedor eliminado");
        

    }
}
