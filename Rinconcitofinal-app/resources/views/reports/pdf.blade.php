<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte Financiero y de Consumo</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            line-height: 1.5;
            color: #333;
            margin: 40px;
        }

        h1 {
            font-size: 20px;
            color: #222;
            margin-bottom: 10px;
            border-bottom: 2px solid #7f1d1d;
            padding-bottom: 5px;
        }

        h3 {
            font-size: 16px;
            color: #7f1d1d;
            margin-top: 30px;
            margin-bottom: 10px;
        }

        p {
            margin: 4px 0;
        }

        .summary {
            margin-top: 10px;
            padding: 10px;
            background-color: #fef3c7;
            border-left: 4px solid #d97706;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th {
            background-color: #f2f2f2;
            color: #000;
            font-weight: bold;
            padding: 8px;
            border: 1px solid #ccc;
        }

        td {
            padding: 8px;
            border: 1px solid #ccc;
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
    </style>
</head>
<body>
    <h1>Reporte Financiero y de Consumo</h1>
    <p><strong>Desde:</strong> {{ $startDate ?? 'N/A' }} &nbsp;&nbsp; <strong>Hasta:</strong> {{ $endDate ?? 'N/A' }}</p>

    <h3>Resumen de Ventas</h3>
    <div class="summary">
        <p><strong>Total de pedidos:</strong> {{ $totalPedidos ?? 0 }}</p>
        <p><strong>Total de ventas:</strong> ${{ number_format($totalVentas ?? 0, 0, ',', '.') }}</p>
    </div>

    <h3>Detalle de Pedidos</h3>
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
                <td>${{ number_format($pedido->totalValor, 0, ',', '.') }}</td>
                <td>{{ $pedido->created_at->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Generado automáticamente por Rinconcito - {{ $generatedAt }}
    </div>
</body>
</html>
