<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte Financiero y de Consumo</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            line-height: 1.5;
            color: #333;
            margin: 20px;
        }

        h1 {
            font-size: 18px;
            color: #222;
            margin-bottom: 10px;
            border-bottom: 2px solid #7f1d1d;
            padding-bottom: 5px;
        }

        h3 {
            font-size: 15px;
            color: #7f1d1d;
            margin-top: 30px;
            margin-bottom: 10px;
        }

        .summary {
            padding: 10px;
            background-color: #fef3c7;
            border-left: 4px solid #d97706;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            padding: 8px;
            border: 1px solid #ccc;
        }

        th {
            background-color: #f2f2f2;
            text-align: left;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #fcfcfc;
        }

        .footer {
            margin-top: 40px;
            font-size: 11px;
            text-align: center;
            color: #999;
        }

        .currency {
            color: green;
            font-weight: bold;
        }

    </style>
</head>
<body>
    <h1>Reporte Financiero y de Consumo</h1>
    <p><strong>Desde:</strong> {{ $startDate ?? 'N/A' }} &nbsp;&nbsp; <strong>Hasta:</strong> {{ $endDate ?? 'N/A' }}</p>

    <h3>Resumen de Ventas</h3>
    <div class="summary">
        <p><strong>Total de pedidos:</strong> {{ $totalPedidos ?? 0 }}</p>
        <p><strong>Total de ventas:</strong> <span class="currency">${{ number_format($totalVentas ?? 0, 0, ',', '.') }}</span></p>
    </div>

    <h3>Total Vendido por Plato</h3>
    <table>
        <thead>
            <tr>
                <th>Plato</th>
                <th>Cantidad Total</th>
                <th>Total Vendido</th>
            </tr>
        </thead>
        <tbody>
            @foreach($totalesPorPlato as $plato)
                <tr>
                    <td>{{ $plato['nombre'] }}</td>
                    <td>{{ $plato['cantidad_total'] }}</td>
                    <td class="currency">${{ number_format($plato['total_valor'], 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Pedidos Completos</h3>
    <table>
        <thead>
            <tr>
                <th>ID Pedido</th>
                <th>Cliente</th>
                <th>Plato</th>
                <th>Cantidad</th>
                <th>Total</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pedidos as $pedido)
                <tr>
                    <td>{{ $pedido->id }}</td>
                    <td>{{ $pedido->cliente->nombre ?? 'N/A' }}</td>
                    <td>{{ $pedido->plato->nombre ?? 'N/A' }}</td>
                    <td>{{ $pedido->cantidad }}</td>
                    <td class="currency">${{ number_format($pedido->totalCalculado ?? 0, 0, ',', '.') }}</td>
                    <td>{{ $pedido->created_at->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Generado automáticamente por Rinconcito - {{ $generatedAt ?? now()->format('d/m/Y H:i') }}
    </div>
</body>
</html>
