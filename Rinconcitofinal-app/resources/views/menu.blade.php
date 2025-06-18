<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Gestión del Menú - Chef
        </h2>
    </x-slot>

    <div class="py-8">
    <div class="py-12" style="background-color: #f4eedb;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Platos Disponibles</h3>

                <table class="min-w-full border border-gray-300 text-sm">
                    <thead class="bg-gray-100 text-left">
                        <tr>
                            <th class="px-4 py-2 border">Nombre</th>
                            <th class="px-4 py-2 border">Descripción</th>
                            <th class="px-4 py-2 border">Ingredientes</th>
                            <th class="px-4 py-2 border">Precio</th>
                            <th class="px-4 py-2 border">Cantidad</th>
                            <th class="px-4 py-2 border">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($platos as $plato)
                        <tr>
                            <td class="px-4 py-2 border">{{ $plato->nombre }}</td>
                            <td class="px-4 py-2 border">{{ $plato->descripcion }}</td>
                            <td class="px-4 py-2 border">{{ $plato->ingredientes }}</td>
                            <td class="px-4 py-2 border">${{ number_format($plato->precio, 0, ',', '.') }}</td>
                            <td class="px-4 py-2 border">{{ $plato->cantidad }}</td>
                            <td class="px-4 py-2 border">
                                <a href="{{ route('chef.plato.edit', $plato->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Editar</a>
                                <form action="{{ route('chef.plato.destroy', $plato->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Está seguro de eliminar este plato?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-6">
                    <a href="{{ route('chef.plato.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Agregar Nuevo Plato</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
