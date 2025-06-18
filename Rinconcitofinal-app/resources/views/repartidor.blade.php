<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Bienvenido Repartidor: {{ Auth::user()->name }}
        </h2>
    </x-slot>
 <div class="py-12" style="background-color: #f4eedb;">
    <div class="py-10 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h3 class="text-2xl font-bold mb-6 text-gray-800">📦 Pedidos Listos para Entrega</h3>

        <div class="mb-6">
            <a href="{{ route('repartidor.resolver-incidencias') }}" class="inline-block px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">
                🛠️ Resolver Incidencias
            </a>
        </div>

        @if($pedidos->isEmpty())
            <div class="bg-yellow-100 text-yellow-800 p-4 rounded shadow text-center">
                No hay pedidos listos para entregar.
            </div>
        @else
            <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100 text-gray-700 uppercase text-sm">
                        <tr>
                            <th class="px-6 py-3 text-left">👤 Cliente</th>
                            <th class="px-6 py-3 text-left">🍽️ Plato</th>
                            <th class="px-6 py-3 text-left">🔢 Cantidad</th>
                            <th class="px-6 py-3 text-left">🚚 Estado</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-gray-800">
                        @foreach($pedidos as $pedido)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $pedido->cliente->name ?? 'Desconocido' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $pedido->plato->nombre ?? 'Desconocido' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $pedido->cantidad ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <form method="POST" action="{{ route('repartidor.pedido.actualizarEstado', $pedido->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <select name="estado"
                                            onchange="this.form.submit()"
                                            class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white text-gray-700">
                                            <option value="en_espera" {{ $pedido->estado == 'en_espera' ? 'selected' : '' }}>🕒 En espera</option>
                                            <option value="listo" {{ $pedido->estado == 'listo' ? 'selected' : '' }}>✅ Listo</option>
                                            <option value="entregado" {{ $pedido->estado == 'entregado' ? 'selected' : '' }}>📬 Entregado</option>
                                        </select>
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
