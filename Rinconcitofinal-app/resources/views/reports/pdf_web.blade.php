<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-rojomuy leading-tight">
            Reporte Financiero y de Consumo (Vista Web)
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <!-- Filtros -->
        <div class="mb-6 bg-beigemuy p-4 rounded-lg shadow">
            <p class="text-sm text-gray-600">
                <strong>Desde:</strong> {{ $startDate ?? 'N/A' }} 
                &nbsp;|&nbsp; 
                <strong>Hasta:</strong> {{ $endDate ?? 'N/A' }}
            </p>
        </div>

        <!-- Resumen de ventas -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Resumen de Pedidos</h3>
                <p class="text-gray-600">Total de pedidos: <strong>{{ $totalPedidos ?? 0 }}</strong></p>
                <p class="text-gray-600">Total de ventas: <strong>${{ number_format($totalVentas ?? 0, 0, ',', '.') }}</strong></p>
            </div>
        </div>

        <!-- Tabla de pedidos -->
        <div class="bg-white shadow rounded-xl overflow-x-auto">
            <h3 class="text-lg font-semibold text-gray-700 p-4 border-b">Detalle de Pedidos</h3>
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left font-medium">ID Pedido</th>
                        <th class="px-6 py-3 text-left font-medium">Cliente</th>
                        <th class="px-6 py-3 text-left font-medium">Plato</th>
                        <th class="px-6 py-3 text-left font-medium">Cantidad</th>
                        <th class="px-6 py-3 text-left font-medium">Total</th>
                        <th class="px-6 py-3 text-left font-medium">Fecha</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($pedidos as $pedido)
                        <tr>
                            <td class="px-6 py-4">{{ $pedido->id }}</td>
                            <td class="px-6 py-4">{{ $pedido->cliente->nombre ?? 'N/A' }}</td>
                            <td class="px-6 py-4">{{ $pedido->plato->nombre ?? 'N/A' }}</td>
                            <td class="px-6 py-4">{{ $pedido->cantidad }}</td>
                            <td class="px-6 py-4">${{ number_format($pedido->total, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">{{ $pedido->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">No hay pedidos en el período seleccionado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
