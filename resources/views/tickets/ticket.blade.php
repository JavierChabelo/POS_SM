<!DOCTYPE html>
<html>
<head>
    <title>Ticket de Venta #{{ $venta->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 300px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }
        .ticket-header {
            margin-bottom: 20px;
        }
        .ticket-body {
            text-align: left;
        }
        .ticket-footer {
            margin-top: 20px;
            border-top: 1px solid #000;
            padding-top: 10px;
        }
        .product-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }
        .total {
            font-weight: bold;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="ticket-header">
        <h2>Ticket de Venta</h2>
        <p>{{ $venta->created_at->format('d/m/Y H:i:s') }}</p>
        <p>Cliente: {{ $venta->cliente->nombre }}</p>
    </div>

    <div class="ticket-body">
        @foreach($venta->productos as $producto)
            <div class="product-row">
                <span>
                    {{ $producto->cantidad }}x {{ $producto->descripcion }}
                </span>
                <span>
                    ${{ number_format($producto->cantidad * $producto->precio, 2) }}
                </span>
            </div>
        @endforeach
    </div>

    <div class="ticket-footer">
        <div class="total">
            Total: ${{ number_format($total, 2) }}
        </div>
        <p>Gracias por su compra</p>
    </div>
</body>
</html>