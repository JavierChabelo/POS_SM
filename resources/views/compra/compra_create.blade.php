@extends("maestra")
@section("titulo", "Nueva Orden de Compra")
@section("contenido")
<div class="container">
    <h1>Nueva orden de compra</h1>
    <p>Todos los campos marcados con * son obligatorios</p>
    
     <!-- Mostrar mensajes de éxito y error -->
     @if(session('success'))
     <div class="alert alert-success">
         {{ session('success') }}
     </div>
 @endif

 @if($errors->any())
     <div class="alert alert-danger">
         <ul>
             @foreach($errors->all() as $error)
                 <li>{{ $error }}</li>
             @endforeach
         </ul>
     </div>
 @endif

    <!-- Formulario para seleccionar proveedor -->
    <form action="{{ route('compras.create') }}" method="GET">
        @csrf

        <!-- Proveedores -->
        <div class="col-md-4">
            <label for="proveedor_id" class="form-label">Proveedor *</label>
            <select id="proveedor_id" name="proveedor_id" class="form-select" onchange="this.form.submit()" required>
                <option value="">Seleccione un proveedor</option>
                @foreach($proveedores as $proveedor)
                    <option value="{{ $proveedor->id }}" {{ isset($selectedProveedor) && $selectedProveedor->id == $proveedor->id ? 'selected' : '' }}>
                        {{ $proveedor->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>

    <!-- Formulario principal para la orden de compra -->
    <form action="{{ route('compras.store') }}" method="POST">
        @csrf

        <input type="hidden" name="proveedor_id" value="{{ isset($selectedProveedor) ? $selectedProveedor->id : '' }}">
        <!-- Datos generales -->
        <div class="row mb-4">
            <!-- Fecha -->
            <div class="col-md-3">
                <label for="fecha" class="form-label">Fecha *</label>
                <input type="date" id="fecha" name="fecha" class="form-control" value="{{ date('Y-m-d') }}" required>
            </div>

            <!-- Nombre de contacto -->
            <div class="col-md-4 mb-3">
                <label for="nombre_contacto" class="form-label">Nombre de contacto *</label>
                <input type="text" id="nombre_contacto" name="nombre_contacto" class="form-control"
                       value="{{ isset($selectedProveedor) ? $selectedProveedor->nombre_contacto . ' ' . $selectedProveedor->apellido_contacto : '' }}"
                       readonly>
            </div>
        </div>

        <!-- Tabla de productos/servicios -->
        <div class="table-responsive">
            <table class="table table-bordered" id="itemsTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Servicio</th>
                        <th>Producto</th>
                        <th>Descripción</th>
                        <th>Cantidad</th>
                        <th>Precio de Compra</th>
                        <th>Precio de Venta</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody id="itemsBody">
                    <tr>
                        <td>1</td>
                        <td>
                            <input type="text" name="servicio[]" class="form-control" 
                                   value="{{ isset($selectedProveedor) ? $selectedProveedor->servicio->nombre_servicio : '' }}" readonly>
                        </td>
                        <td>
                            <select name="producto[]" class="form-select producto-select" required>
                                <option value="">Seleccione un producto</option>
                                @foreach($productos as $producto)
                                    <option value="{{ $producto->id }}" data-precio-compra="{{ $producto->precio_compra }}" data-precio-venta="{{ $producto->precio_venta }}">
                                        {{ $producto->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="text" name="descripcion[]" class="form-control" placeholder="Descripción del item">
                        </td>
                        <td>
                            <input type="number" name="cantidad[]" class="form-control cantidad" min="1" value="1">
                        </td>
                        <td>
                            <input type="text" name="precio_compra[]" class="form-control precio-compra" readonly>
                        </td>
                        <td>
                            <input type="text" name="precio_venta[]" class="form-control precio-venta" readonly>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-remove-item">Eliminar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <button type="button" id="addItemBtn" class="btn btn-primary mb-3">Agregar otro item</button>
        </div>

        <!-- Resumen de la compra -->
        <div class="row mb-4">
            <div class="col-md-4 offset-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Resumen</h5>
                        <div class="d-flex justify-content-between">
                            <p>Total</p>
                            <p id="totalCompra">0.00</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Botones -->
        <div class="text-end">
            <button type="submit" class="btn btn-success">Guardar</button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let itemIndex = 1;

        // Agregar nuevo item a la tabla
        document.getElementById('addItemBtn').addEventListener('click', function () {
            itemIndex++;
            let newRow = `
                <tr>
                    <td>${itemIndex}</td>
                    <td>
                        <input type="text" name="servicio[]" class="form-control" 
                               value="{{ isset($selectedProveedor) ? $selectedProveedor->servicio->nombre_servicio : '' }}" readonly>
                    </td>
                    <td>
                        <select name="producto[]" class="form-select producto-select" required>
                            <option value="">Seleccione un producto</option>
                            @foreach($productos as $producto)
                                <option value="{{ $producto->id }}" data-precio-compra="{{ $producto->precio_compra }}" data-precio-venta="{{ $producto->precio_venta }}">
                                    {{ $producto->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="text" name="descripcion[]" class="form-control" placeholder="Descripción del item">
                    </td>
                    <td>
                        <input type="number" name="cantidad[]" class="form-control cantidad" min="1" value="1">
                    </td>
                    <td>
                        <input type="text" name="precio_compra[]" class="form-control precio-compra" readonly>
                    </td>
                    <td>
                        <input type="text" name="precio_venta[]" class="form-control precio-venta" readonly>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger btn-remove-item">Eliminar</button>
                    </td>
                </tr>
            `;
            document.getElementById('itemsBody').insertAdjacentHTML('beforeend', newRow);
        });

        // Asignar precios automáticamente cuando se selecciona un producto
        document.getElementById('itemsBody').addEventListener('change', function (e) {
            if (e.target.classList.contains('producto-select')) {
                let selectedOption = e.target.options[e.target.selectedIndex];
                let precioCompra = parseFloat(selectedOption.getAttribute('data-precio-compra')) || 0;
                let precioVenta = parseFloat(selectedOption.getAttribute('data-precio-venta')) || 0;

                let row = e.target.closest('tr');
                row.querySelector('.precio-compra').value = precioCompra.toFixed(2);
                row.querySelector('.precio-venta').value = precioVenta.toFixed(2);
                
                // Actualizar el total automáticamente cuando se selecciona un producto
                calcularTotal();
            }
        });

        // Eliminar item de la tabla
        document.getElementById('itemsBody').addEventListener('click', function (e) {
            if (e.target.classList.contains('btn-remove-item')) {
                e.target.closest('tr').remove();
                calcularTotal();
            }
        });

        // Calcular total automáticamente
        document.getElementById('itemsBody').addEventListener('input', function () {
            calcularTotal();
        });

        function calcularTotal() {
            let total = 0;
            document.querySelectorAll('#itemsBody tr').forEach(function (row) {
                let cantidad = parseFloat(row.querySelector('.cantidad').value) || 0;
                let precioCompra = parseFloat(row.querySelector('.precio-compra').value) || 0;
                total += cantidad * precioCompra;
            });
            document.getElementById('totalCompra').textContent = total.toFixed(2);
        }
    });
</script>
@endsection
