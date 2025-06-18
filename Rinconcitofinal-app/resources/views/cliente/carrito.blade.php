<x-app-layout>
    <div class="text-center my-6">
        <a href="/">
            <img src="{{ asset('images/logo.png') }}" alt="Rinconcito Logo" class="h-24 mx-auto">
        </a>
    </div>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800">
                🛒 Carrito de Compras
            </h2>
            <a href="{{ url('/cliente') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Volver al panel
            </a>
        </div>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        {{-- Notificaciones --}}
        <div class="fixed top-4 left-0 right-0 z-50 flex justify-center px-4">
            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" 
                     class="bg-green-600 text-white rounded-md px-4 py-2 shadow">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" 
                     class="bg-red-600 text-white rounded-md px-4 py-2 shadow">
                    {{ session('error') }}
                </div>
            @endif
        </div>

        <div class="bg-white shadow-md rounded-lg p-6 mt-8">
            @if(count($carrito) > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Plato</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Cantidad</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Precio Unitario</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Subtotal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($carrito as $item)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $item['plato']->nombre }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <form method="POST" action="{{ route('cliente.carrito.actualizar') }}" class="flex items-center space-x-2">
                                            @csrf
                                            <input type="hidden" name="plato_id" value="{{ $item['plato']->id }}">
                                            <input type="number" name="cantidad" value="{{ $item['cantidad'] }}" min="1" 
                                                   class="w-16 border-gray-300 rounded-md shadow-sm text-center" required>
                                            <button type="submit" class="text-sm bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded">
                                                Actualizar
                                            </button>
                                        </form>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                        @if($item['plato']->isEnOferta())
                                            <span class="line-through text-red-500">${{ number_format($item['plato']->precio, 2) }}</span>
                                            <span class="ml-2 font-bold text-green-600">${{ number_format($item['plato']->precioConDescuento(), 2) }}</span>
                                        @else
                                            ${{ number_format($item['plato']->precio, 2) }}
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                        @if($item['plato']->isEnOferta())
                                            <span class="line-through text-red-500">${{ number_format($item['plato']->precio * $item['cantidad'], 2) }}</span>
                                            <span class="ml-2 font-bold text-green-600">${{ number_format($item['plato']->precioConDescuento() * $item['cantidad'], 2) }}</span>
                                        @else
                                            ${{ number_format($item['plato']->precio * $item['cantidad'], 2) }}
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <form method="POST" action="{{ route('cliente.carrito.eliminar', $item['plato']->id) }}" 
                                              onsubmit="return confirm('¿Estás seguro de eliminar este plato del carrito?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                                                Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <form method="POST" action="{{ route('cliente.carrito.confirmar') }}" class="mt-6 text-right">
                    @csrf
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded shadow">
                        Confirmar Pedido y Pagar 💳
                    </button>
                </form>
            @else
                <div class="text-center text-gray-600 text-lg">
                    Tu carrito está vacío 🛒
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
