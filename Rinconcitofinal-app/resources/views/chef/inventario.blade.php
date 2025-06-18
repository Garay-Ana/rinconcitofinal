<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Control de Inventario
        </h2>
    </x-slot>
    <div class="py-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <a href="{{ route('chef.index') }}" class="inline-block bg-gray-500 text-white rounded-md px-4 py-2 hover:bg-gray-600 mb-4">
            Regresar
        </a>
    </div>
 <div class="py-12" style="background-color: #FEF3C7;">
    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="mb-4">
            <a href="{{ route('reports.index') }}" class="inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                Generar Reportes
            </a>
        </div>

        @if($platos->isEmpty())
            <p>No hay platos en el inventario.</p>
        @else
            <table class="min-w-full bg-white border">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">Nombre</th>
                        <th class="py-2 px-4 border-b">Descripción</th>
                        <th class="py-2 px-4 border-b">Precio</th>
                        <th class="py-2 px-4 border-b">Cantidad Disponible</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($platos as $plato)
                        <tr>
                        <td class="py-2 px-4 border-b">{{ $plato->nombre }}</td>
                        <td class="py-2 px-4 border-b">{{ $plato->descripcion }}</td>
                        <td class="py-2 px-4 border-b">{{ $plato->precio }}</td>
                        <td class="py-2 px-4 border-b">
                            <form method="POST" action="{{ route('chef.plato.updateCantidad', $plato->id) }}" class="flex items-center space-x-2">
                                @csrf
                                @method('PUT')
                                <input type="number" name="cantidad" value="{{ $plato->cantidad ?? 10 }}" min="0" class="border rounded px-2 py-1 w-20">
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded">
                                    Guardar
                                </button>
                            </form>
                        </td>
                        <td class="py-2 px-4 border-b">
                            <form action="{{ route('chef.plato.destroy', $plato->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este plato?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-app-layout>
