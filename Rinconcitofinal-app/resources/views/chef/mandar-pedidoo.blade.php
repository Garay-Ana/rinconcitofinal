<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            🚚 Pedidos para Repartir
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if($pedidos->isEmpty())
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded">
                <p class="font-medium">No hay pedidos listos para repartir.</p>
            </div>
        @else
            <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">👤 Cliente</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">🍽️ Plato</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">🔢 Cantidad</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">📦 Estado</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Acción</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($pedidos as $pedido)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    {{ $pedido->cliente->name ?? 'Desconocido' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    {{ $pedido->plato->nombre ?? 'Desconocido' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    {{ $pedido->cantidad ?? 1 }}
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <form method="POST" action="{{ route('chef.pedido.update', $pedido->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <select name="estado" class="border border-gray-300 rounded px-2 py-1 text-sm">
                                            <option value="pendiente" {{ $pedido->estado == 'pendiente' ? 'selected' : '' }}>pendiente</option>
                                            <option value="en preparación" {{ $pedido->estado == 'en preparación' ? 'selected' : '' }}>en preparación</option>
                                            <option value="listo_entrega" {{ $pedido->estado == 'listo_entrega' ? 'selected' : '' }}>listo_entrega</option>
                                            <option value="listo" {{ $pedido->estado == 'listo' ? 'selected' : '' }}>listo</option>
                                            <option value="entregado" {{ $pedido->estado == 'entregado' ? 'selected' : '' }}>entregado</option>
                                        </select>
                                </td>
                                <td class="px-6 py-4 text-sm">
                                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded">
                                            Actualizar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-app-layout>
