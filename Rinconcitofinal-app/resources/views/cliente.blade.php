<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Bienvenido, {{ Auth::user()->name }} 👋
        </h2>
    </x-slot>

    {{-- Notificaciones flotantes --}}
    <div class="fixed top-4 left-0 right-0 z-50 flex justify-center px-4">
        @if(session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" 
                 class="bg-green-600 text-white px-4 py-2 rounded shadow">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" 
                 class="bg-red-600 text-white px-4 py-2 rounded shadow">
                {{ session('error') }}
            </div>
        @endif
    </div>

    <div class="py-12" style="background-color: #f4eedb;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <p class="text-gray-700 text-lg">Este es tu panel de cliente. Aquí puedes explorar y comprar nuestros deliciosos platos.</p>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6 mt-8">
                    @forelse($platos as $plato)
                        <div class="bg-white border border-gray-200 rounded-lg shadow hover:shadow-lg transition duration-300">
                            @if($plato->imagen)
                                <img src="{{ $plato->imagen }}" alt="{{ $plato->nombre }}" class="w-full h-48 object-cover rounded-t-lg">
                            @else
                                <div class="w-full h-48 flex items-center justify-center bg-gray-100 rounded-t-lg text-gray-400">
                                    Sin imagen
                                </div>
                            @endif

                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-gray-800">{{ $plato->nombre }}</h3>
                                <p class="text-sm text-gray-600 mt-1">{{ $plato->descripcion ?? 'Sin descripción' }}</p>
                                <p class="mt-2 text-green-600 font-bold text-md">Precio: ${{ number_format($plato->precio ?? 0, 2) }}</p>

                                <form method="POST" action="{{ route('cliente.carrito.agregar') }}" class="mt-4">
                                    @csrf
                                    <input type="hidden" name="plato_id" value="{{ $plato->id }}">
                                    <label for="cantidad_{{ $plato->id }}" class="block text-sm font-medium text-gray-700 mb-1">Cantidad</label>
                                    <input type="number" name="cantidad" id="cantidad_{{ $plato->id }}" value="1" min="1" 
                                           class="w-full border-gray-300 rounded-md shadow-sm" required>
                                    
                                    <button type="submit" class="w-full mt-3 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        Agregar al carrito
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center text-gray-500">
                            No hay platos disponibles en este momento 🍽️
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="mt-6 flex justify-center">
                <a href="{{ route('cliente.reseñas') }}"
                   class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-3 px-6 rounded-md shadow transition duration-300">
                    Calificar
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
