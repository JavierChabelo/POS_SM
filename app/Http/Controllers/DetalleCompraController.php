<?php

namespace App\Http\Controllers;

use App\DetalleCompra;
use App\Compra;
use App\Producto;
use Illuminate\Http\Request;

class DetalleCompraController extends Controller
{
    public function index($compraId)
    {
        // Obtener todos los detalles de una compra especifica
        $compra = Compra::findOrFail($compraId);
        $detalles = DetalleCompra::with('producto')->where('compra_id', $compraId)->get();

        return view('detalle_compra.index', compact('compra', 'detalles'));
    }

    public function create($compraId)
    {
        // Mostrar formulario para crear un detalle de compra
        $compra = Compra::findOrFail($compraId);
        $productos = Producto::where('estado', true)->get();

        return view('detalle_compra.create', compact('compra', 'productos'));
    }

    public function store(Request $request, $compraId)
    {
        // Validar y almacenar un nuevo detalle de compra
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
            'precio_venta' => 'required|numeric|min:0',
            'costo_venta' => 'required|numeric|min:0',
        ]);

        $compra = Compra::findOrFail($compraId);

        $detalle = new DetalleCompra($request->all());
        $detalle->compra_id = $compra->id;
        $detalle->total = $detalle->cantidad * $detalle->precio_venta;
        $detalle->saveOrFail();

        return redirect()->route('detalle_compra.index', $compraId)->with('success', 'Detalle de compra agregado exitosamente');
    }

    public function edit($id)
    {
        // Mostrar formulario para editar un detalle de compra
        $detalle = DetalleCompra::findOrFail($id);
        $productos = Producto::where('estado', true)->get();

        return view('detalle_compra.edit', compact('detalle', 'productos'));
    }

    public function update(Request $request, $id)
    {
        // Validar y actualizar un detalle de compra existente
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
            'precio_venta' => 'required|numeric|min:0',
            'costo_venta' => 'required|numeric|min:0',
        ]);

        $detalle = DetalleCompra::findOrFail($id);
        $detalle->fill($request->all());
        $detalle->total = $detalle->cantidad * $detalle->precio_venta;
        $detalle->saveOrFail();

        return redirect()->route('detalle_compra.index', $detalle->compra_id)->with('success', 'Detalle de compra actualizado exitosamente');
    }

    public function destroy($id)
    {
        // Desactivar un detalle de compra
        $detalle = DetalleCompra::findOrFail($id);
        $detalle->update(['estado' => false]);

        return redirect()->route('detalle_compra.index', $detalle->compra_id)->with('mensaje', 'Detalle de compra desactivado');
    }
}
