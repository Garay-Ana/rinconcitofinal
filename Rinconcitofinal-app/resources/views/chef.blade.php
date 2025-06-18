<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight ">
            Bienvenido Chef: {{ Auth::user()->name }}
        </h2>
    </x-slot>

    <!-- Fondo agradable -->
   <div class="py-12" style="background-color: #f4eedb;">
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

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
                    <table class="min-w-full table-auto text-sm text-gray-700">
                        <thead class="bg-amber-100 text-gray-800 uppercase text-xs tracking-wider">
                            <tr>
                                <th class="py-3 px-4 text-left">Cliente</th>
                                <th class="py-3 px-4 text-left">Imagen</th>
                                <th class="py-3 px-4 text-left">Plato</th>
                                <th class="py-3 px-4 text-left">Cantidad</th>
                                <th class="py-3 px-4 text-left">Estado</th>
                                <th class="py-3 px-4 text-left">Total Valor</th>
                                <th class="py-3 px-4 text-left">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pedidos as $pedido)
                                <tr class="border-b hover:bg-yellow-50 transition duration-150 ease-in-out">
                                    <td class="py-3 px-4 font-medium">{{ $pedido->cliente->name ?? 'Desconocido' }}</td>
                                    <td class="py-3 px-4">
                                        @if($pedido->plato && $pedido->plato->imagen)
                                            <img src="{{ $pedido->plato->imagen }}" alt="{{ $pedido->plato->nombre }}" class="h-16 w-16 object-cover rounded shadow">
                                        @else
                                            <span class="text-gray-400 italic">Sin imagen</span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-4">{{ $pedido->plato->nombre ?? 'Desconocido' }}</td>
                                    <td class="py-3 px-4">{{ $pedido->cantidad ?? 1 }}</td>
                                    <td class="py-3 px-4">
                                        <span class="inline-block bg-gray-200 text-gray-700 px-2 py-1 rounded text-xs">
                                            {{ ucfirst($pedido->estado) }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4">${{ number_format($pedido->totalValor, 2) }}</td>
                                    <td class="py-3 px-4">
                                        <form method="POST" action="{{ route('chef.pedido.actualizar-agrupado') }}" class="flex items-center space-x-2">
                                            @csrf
                                            <input type="hidden" name="cliente_id" value="{{ $pedido->cliente_id }}">
                                            <input type="hidden" name="plato_id" value="{{ $pedido->plato_id }}">
                                            <select name="estado" class="border border-gray-300 rounded-md text-sm px-2 py-1 focus:ring focus:ring-amber-300">
                                                <option value="pendiente" {{ $pedido->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                                <option value="en preparación" {{ $pedido->estado == 'en preparación' ? 'selected' : '' }}>En preparación</option>
                                                <option value="listo_entrega" {{ $pedido->estado == 'listo_entrega' ? 'selected' : '' }}>Listo para entrega</option>
                                                <option value="listo" {{ $pedido->estado == 'listo' ? 'selected' : '' }}>Listo</option>
                                                <option value="entregado" {{ $pedido->estado == 'entregado' ? 'selected' : '' }}>Entregado</option>
                                            </select>
                                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded-md text-sm shadow">
                                                ✅
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="p-4 text-right font-semibold text-lg bg-amber-100 rounded-b-lg">
                        Total Ventas: ${{ number_format($totalVentas, 2) }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
