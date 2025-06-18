<?php

namespace App\Exports;

use App\Models\Pedido;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

class PedidosExport implements \Maatwebsite\Excel\Concerns\FromCollection, \Maatwebsite\Excel\Concerns\WithHeadings
{
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data['pedidos'] ?? collect();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->data->map(function ($pedido) {
            return [
                'ID Pedido' => $pedido->id,
                'Cliente' => $pedido->cliente->nombre ?? 'N/A',
                'Plato' => $pedido->plato->nombre ?? 'N/A',
                'Cantidad' => $pedido->cantidad,
                'Total' => $pedido->total,
                'Fecha' => $pedido->created_at->format('d/m/Y'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID Pedido',
            'Cliente',
            'Plato',
            'Cantidad',
            'Total',
            'Fecha',
        ];
    }
}
