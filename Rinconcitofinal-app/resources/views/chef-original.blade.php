<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Bienvenido Chef: {{ Auth::user()->name }}
        </h2>
    </x-slot>

    <!-- Notificaciones -->
    <div class="fixed top-0 left-0 right-0 z-50 flex flex-col items-center space-y-2 p-4">
        @if(session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="bg-green-600 text-white rounded px-4 py-2 shadow-md">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="bg-red-600 text-white rounded px-4 py-2 shadow-md">
                {{ session('error') }}
            </div>
        @endif
    </div>

    <div class="py-10 max-w-7xl mx-auto sm:px-6 lg:px-8">

        <!-- Botones superiores -->
        <div class="mb-6 flex flex-wrap gap-4">
            <a href="{{ route('chef.plato.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
                ➕ Agregar Nuevo Plato
            </a>
            <a href="{{ route('chef.mandar-pedido') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow">
                📦 Mandar Pedido
            </a>
            <a href="{{ route('chef.inventario') }}" class="bg-gray-800 hover:bg-gray-900 text-white px-4 py-2 rounded shadow">
                📚 Control de Inventario
            </a>
        </div>

        <h3 class="text-xl font-bold mb-4">Tus Platos</h3>
        @php
            $platos = \App\Models\Plato::all();
        @endphp

        <!-- Cards de platos -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($platos as $plato)
                <div class="bg-white rounded-lg shadow p-4">
                    <img src="{{ $plato->imagen ?? 'https://via.placeholder.com/150' }}" alt="{{ $plato->nombre }}" class="mb-3 rounded object-cover h-40 w-full">
                    <h4 class="font-semibold text-lg text-gray-800">{{ $plato->nombre }}</h4>
                    <p class="text-sm text-gray-600 mb-2">{{ $plato->descripcion }}</p>
                    <p class="text-blue-600 font-semibold mb-3">Precio: ${{ number_format($plato->precio, 2) }}</p>
                    <div class="flex space-x-2">
                        <a href="{{ route('chef.plato.edit', $plato->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">
                            ✏️ Editar
                        </a>
                        <form action="{{ route('chef.plato.destroy', $plato->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este plato?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">
                                🗑️ Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <p>No hay platos agregados.</p>
            @endforelse
        </div>

        <!-- Tabla de pedidos -->
        <h3 class="text-xl font-bold mt-10 mb-4">Pedidos Pendientes</h3>
        @if($pedidos->isEmpty())
            <p>No hay pedidos pendientes.</p>
        @else
            <div class="overflow-x-auto shadow rounded-lg">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="py-3 px-4 text-left border-b">Cliente</th>
                            <th class="py-3 px-4 text-left border-b">Imagen</th>
                            <th class="py-3 px-4 text-left border-b">Plato</th>
                            <th class="py-3 px-4 text-left border-b">Cantidad</th>
                            <th class="py-3 px-4 text-left border-b">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-800">
                        @foreach($pedidos as $pedido)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-2 px-4 border-b">{{ $pedido->cliente->name ?? 'Desconocido' }}</td>
                                <td class="py-2 px-4 border-b">
                                    @if($pedido->plato && $pedido->plato->imagen)
                                        <img src="{{ $pedido->plato->imagen }}" alt="{{ $pedido->plato->nombre }}" class="h-16 w-16 object-cover rounded">
                                    @else
                                        <span>No imagen</span>
                                    @endif
                                </td>
                                <td class="py-2 px-4 border-b">{{ $pedido->plato->nombre ?? 'Desconocido' }}</td>
                                <td class="py-2 px-4 border-b">{{ $pedido->cantidad ?? 1 }}</td>
                                <td class="py-2 px-4 border-b">
<form method="POST" action="{{ route('chef.pedido.actualizar-agrupado') }}">
    @csrf
    <!-- Removed @method('PUT') to use POST method -->
    <input type="hidden" name="cliente_id" value="{{ $pedido->cliente_id }}">
    <input type="hidden" name="plato_id" value="{{ $pedido->plato_id }}">
    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm">
        ✅ Marcar como listo
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
