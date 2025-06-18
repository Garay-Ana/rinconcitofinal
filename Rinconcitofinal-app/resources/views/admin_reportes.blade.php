<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800">
                Reportes de Ventas
            </h2>
            <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 bg-gray-600 text-white rounded-md shadow hover:bg-gray-700 transition duration-200">
                Volver al Panel
            </a>
        </div>
    </x-slot>

    <div class="py-12" style="background-color: #f4eedb;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Filtro de fechas --}}
            <form method="GET" action="{{ route('admin.reportes') }}">
                <div class="flex flex-wrap gap-4 items-end mb-4">
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700">Fecha inicio</label>
                        <input type="date" id="start_date" name="start_date" value="{{ old('start_date', $startDate ?? '') }}" class="border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-700">Fecha fin</label>
                        <input type="date" id="end_date" name="end_date" value="{{ old('end_date', $endDate ?? '') }}" class="border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700 transition duration-200">Filtrar</button>
                    </div>
                </div>
            </form>

            {{-- Botones de descarga --}}
            @if(!empty($startDate) && !empty($endDate))
            <div class="mb-4 flex gap-2">
<a href="{{ route('admin.reportes.pdf', ['start_date' => $startDate, 'end_date' => $endDate]) }}" class="px-4 py-2 bg-red-600 text-white rounded-md shadow hover:bg-red-700 transition duration-200 inline-flex items-center">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="currentColor" viewBox="0 0 24 24"><path d="M6 2h9a2 2 0 012 2v2h-2V4H6v16h6v2H6a2 2 0 01-2-2V4a2 2 0 012-2z"/><path d="M15 12l-3 3-3-3h2V7h2v5h2z"/></svg>
    Descargar PDF
</a>
            </div>
            @endif

            {{-- Totales por Plato --}}
            @if(isset($totalesPorPlato) && $totalesPorPlato->isNotEmpty())
            <div class="mb-6">
                <h4 class="text-lg font-semibold text-gray-800 mb-3">🍽️ Total Vendido por Plato</h4>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-300 rounded-md shadow-sm">
                        <thead>
                            <tr class="bg-gray-100 text-gray-700">
                                <th class="py-2 px-4 border-b border-gray-300 text-left">Plato</th>
                                <th class="py-2 px-4 border-b border-gray-300 text-center">Cantidad Total</th>
                                <th class="py-2 px-4 border-b border-gray-300 text-right">Total Vendido</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($totalesPorPlato as $total)
                            <tr class="border-b border-gray-300">
                                <td class="py-2 px-4">{{ $total['nombre'] }}</td>
                                <td class="py-2 px-4 text-center">{{ $total['cantidad_total'] }}</td>
                                <td class="py-2 px-4 text-right text-green-600 font-semibold">${{ number_format($total['total_valor'], 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

            {{-- Pedidos completos --}}
            @if(isset($pedidos))
            <div class="overflow-x-auto">
                <h4 class="text-lg font-semibold text-gray-800 mb-3">📋 Pedidos Completos</h4>
                <table class="min-w-full bg-white border border-gray-300 rounded-md shadow-sm">
                    <thead>
                        <tr class="bg-gray-100 text-gray-700">
                            <th class="py-2 px-4 border-b border-gray-300 text-left">ID Pedido</th>
                            <th class="py-2 px-4 border-b border-gray-300 text-left">Cliente</th>
                            <th class="py-2 px-4 border-b border-gray-300 text-left">Plato</th>
                            <th class="py-2 px-4 border-b border-gray-300 text-center">Cantidad</th>
                            <th class="py-2 px-4 border-b border-gray-300 text-right">Total</th>
                            <th class="py-2 px-4 border-b border-gray-300 text-center">Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pedidos as $pedido)
                        <tr>
                            <td class="py-2 px-4">{{ $pedido->id ?? 'N/A' }}</td>
                            <td class="py-2 px-4">{{ $pedido->cliente->nombre ?? 'N/A' }}</td>
                            <td class="py-2 px-4">{{ $pedido->plato->nombre ?? 'N/A' }}</td>
                            <td class="py-2 px-4 text-center">{{ $pedido->cantidad }}</td>
                            <td class="py-2 px-4 text-right text-green-600 font-semibold">${{ number_format($pedido->totalCalculado ?? 0, 0, ',', '.') }}</td>
                            <td class="py-2 px-4 text-center">{{ $pedido->created_at->format('d/m/Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="py-4 text-center text-gray-500">No hay registros para este período.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>
