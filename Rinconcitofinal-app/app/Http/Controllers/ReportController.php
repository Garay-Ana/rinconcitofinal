<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Plato;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PedidosExport;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index()
    {
        $data = $this->getReportData(request());

        return view('reports.index', $data);
    }

    public function generatePdf(Request $request)
    {
        $data = $this->getReportData($request);

        // Añadir la hora de generación para mostrar en el PDF
        $generatedAt = now()->format('d/m/Y H:i');

        // Ensure data is passed as an array with keys
        $pdf = PDF::loadView('reports.pdf', [
            'pedidos' => $data['pedidos'] ?? [],
            'totalVentas' => $data['totalVentas'] ?? 0,
            'totalPedidos' => $data['totalPedidos'] ?? 0,
            'startDate' => $data['startDate'] ?? null,
            'endDate' => $data['endDate'] ?? null,
            'generatedAt' => $generatedAt,
        ]);
        return $pdf->download('reporte_financiero_consumo.pdf');
    }

    // Método generateExcel eliminado para deshabilitar exportación a Excel

    private function getReportData(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = Pedido::query();

        if ($startDate) {
            $query->whereDate('created_at', '>=', $startDate);
        }
        if ($endDate) {
            $query->whereDate('created_at', '<=', $endDate);
        }

        $query->whereHas('plato', function ($q) {
            $q->where('user_id', Auth::id());
        });

        $pedidos = $query->with('plato', 'cliente')->get();

        // Calcular total por pedido y total general de ventas
        $totalVentas = 0;
        foreach ($pedidos as $pedido) {
            $precio = $pedido->plato->precio ?? 0;
            $cantidad = $pedido->cantidad ?? 1;
            $pedido->totalValor = $precio * $cantidad;
            $totalVentas += $pedido->totalValor;
        }

        $totalPedidos = $pedidos->count();

        return [
            'pedidos' => $pedidos,
            'totalVentas' => $totalVentas,
            'totalPedidos' => $totalPedidos,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ];
    }
}
