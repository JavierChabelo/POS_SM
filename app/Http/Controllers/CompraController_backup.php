<?php
 ?>
<?php

namespace App\Http\Controllers;
use App\Proveedor;
use App\Compra;
use App\Producto;
use App\DetalleCompra;
use App\Servicio;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    public function index()
    {
       
        $proveedores = Proveedor::all();
        $productos = Producto::all();
        //$compraslist = Compra::with('proveedor')->where('estado', true)->get(); // Obtenemos todas las compras activas
        $compraslist = Compra::with('proveedor', 'detalleCompras.producto')->where('estado', true)->get(); 
        return view('compra.compra_index', compact('compraslist', 'proveedores', 'productos'));
    }


    public function create(Request $request)
    {
        // Obtener proveedores activos para el formulario
        $proveedores = Proveedor::where('estado', true)->get(); // Solo proveedores activos
        $servicios = Servicio::all(); // Obtener todos los servicios disponibles
        $productos = Producto::where('estado', true)->get();   // Solo productos activos
        // Obtener el proveedor seleccionado si existe
      
        $selectedProveedor = null;
        $selectedProducto = null;
        $servicios = [];

        // Verificar si se seleccionó un proveedor para obtener sus servicios
        if ($request->has('proveedor_id')) {
            $selectedProveedor = Proveedor::find($request->input('proveedor_id'));
            if ($selectedProveedor) {
                $servicios = Servicio::where('id', $selectedProveedor->servicio_id)->get();
            }
        }

         // Verificar si se seleccionó un producto para obtener sus detalles
         if ($request->has('producto_id')) {
            $selectedProducto = Producto::find($request->input('producto_id'));
        }

        return view('compra.compra_create', compact('proveedores', 'selectedProveedor','selectedProducto','servicios', 'productos'));
    }

    public function store(Request $request)
{
    // Validación de los campos
    $request->validate([
        'proveedor_id' => 'required|exists:proveedores,id',
        'fecha' => 'required|date',
        'producto.*' => 'required|exists:productos,id',
        'cantidad.*' => 'required|numeric|min:1',
        'precio_compra.*' => 'required|numeric|min:0',
    ]);

    try {
        // Inicializamos la suma del monto total de la compra
        $montoTotal = 0;

        // Calculamos el monto total de la compra
        foreach ($request->cantidad as $index => $cantidad) {
            $precioCompra = $request->precio_compra[$index];
            $montoTotal += $cantidad * $precioCompra;
        }
        $montoTotal = $montoTotal ?? 0;
        dump($montoTotal);
        
        // Crear la compra
        $compra = Compra::create([
            'proveedor_id' => $request->proveedor_id,
            'fecha' => $request->fecha,
            'estado' => true,
            'monto' => $montoTotal
        ]);
        

        // Guardar cada detalle de la compra
        foreach ($request->producto as $index => $productoId) {
            DetalleCompra::create([
                'compra_id' => $compra->id,
                'productos_id' => $productoId,
                'cantidad' => $request->cantidad[$index],
                'precio_venta' => $request->precio_venta[$index],
                'costo_venta' => $request->precio_compra[$index],
                'descripcion' => $request->descripcion[$index] ?? '',
                'total' => $request->cantidad[$index] * $request->precio_compra[$index],
                'estado' => true,
            ]);
        }

        return redirect()->route('compras.index')->with('success', 'Compra creada exitosamente');
    } catch (\Exception $e) {
        return back()->withErrors(['error' => 'Ocurrió un error al guardar la compra: ' . $e->getMessage()]);
    }
}
    

    public function show($id)
    {
        // Mostrar los detalles de una compra
        $compra = Compra::with('detalleCompras.producto', 'proveedor')->findOrFail($id);
        return view('compras.show', compact('compra'));
    }

    public function edit($id)
    {
        // Editar una compra
       $compra = Compra::findOrFail($id);
       $proveedores = Proveedor::where('estado', true)->get(); // Solo proveedores activos
       return view('compras.edit', compact('compra', 'proveedores'));
    }

    public function update(Request $request, $id)
    {
        // Validar y actualizar una compra
        $request->validate([
            'proveedor_id' => 'required|exists:proveedor,id',
            //'numero_compra' => 'required|string|unique:compras,numero_compra,' . $id,
            'monto' => 'required|numeric',
            'fecha' => 'required|date',
        ]);

        $compra = Compra::findOrFail($id);
        $compra->update($request->all());

        return redirect()->route('compras.index')->with('success', 'Compra actualizada exitosamente');
    }

    public function destroy(Compra $compra)
    {
      // Desactiva todos los detalles relacionados
       $compra->detalleCompras()->update(['estado' => false]);

      // Desactiva la compra
       $compra->update(['estado' => false]);

       return redirect()->route('compras.index')->with('mensaje', 'Compra desactivada junto con sus detalles');
    }

    public function activate($id)
    {
        // Reactivar una compra desactivada
        $compra = Compra::findOrFail($id);
        $compra->update(['estado' => true]);
        $compra->detalleCompras()->update(['estado' => true]); // Reactivar detalles relacionados
        return redirect()->route('compras.index')->with('mensaje', 'Compra reactivada');
    }
    
}