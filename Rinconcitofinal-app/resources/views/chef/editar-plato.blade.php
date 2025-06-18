<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Plato
        </h2>
    </x-slot>

    <div class="py-12 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm rounded-lg p-6">
            @if ($errors->any())
                <div class="mb-4">
                    <ul class="list-disc list-inside text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('chef.plato.update', $plato->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="nombre" class="block font-medium text-sm text-gray-700">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="border-gray-300 rounded-md shadow-sm mt-1 block w-full" value="{{ old('nombre', $plato->nombre) }}" required>
                </div>

                <div class="mb-4">
                    <label for="descripcion" class="block font-medium text-sm text-gray-700">Descripción</label>
                    <textarea name="descripcion" id="descripcion" class="border-gray-300 rounded-md shadow-sm mt-1 block w-full">{{ old('descripcion', $plato->descripcion) }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="precio" class="block font-medium text-sm text-gray-700">Precio</label>
                    <input type="number" step="0.01" name="precio" id="precio" class="border-gray-300 rounded-md shadow-sm mt-1 block w-full" value="{{ old('precio', $plato->precio) }}" required>
                </div>

                <div class="mb-4">
                    <label for="ingredientes" class="block font-medium text-sm text-gray-700">🧾 Ingredientes</label>
                    <textarea name="ingredientes" id="ingredientes" class="border-gray-300 rounded-md shadow-sm mt-1 block w-full" rows="3">{{ old('ingredientes', $plato->ingredientes) }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="cantidad" class="block font-medium text-sm text-gray-700">📦 Cantidad Disponible</label>
                    <input type="number" name="cantidad" id="cantidad" min="0" class="border-gray-300 rounded-md shadow-sm mt-1 block w-full" value="{{ old('cantidad', $plato->cantidad) }}">
                </div>

                <div class="mb-4">
                    <label for="descuento_porcentaje" class="block font-medium text-sm text-gray-700">📉 Descuento (%)</label>
                    <input type="number" name="descuento_porcentaje" id="descuento_porcentaje" min="0" max="100" class="border-gray-300 rounded-md shadow-sm mt-1 block w-full" value="{{ old('descuento_porcentaje', $plato->descuento_porcentaje) }}">
                </div>

                <div class="mb-4">
                    <label for="fecha_inicio_oferta" class="block font-medium text-sm text-gray-700">📅 Fecha Inicio Oferta</label>
                    <input type="date" name="fecha_inicio_oferta" id="fecha_inicio_oferta" class="border-gray-300 rounded-md shadow-sm mt-1 block w-full" value="{{ old('fecha_inicio_oferta', $plato->fecha_inicio_oferta) }}">
                </div>

                <div class="mb-4">
                    <label for="fecha_fin_oferta" class="block font-medium text-sm text-gray-700">📅 Fecha Fin Oferta</label>
                    <input type="date" name="fecha_fin_oferta" id="fecha_fin_oferta" class="border-gray-300 rounded-md shadow-sm mt-1 block w-full" value="{{ old('fecha_fin_oferta', $plato->fecha_fin_oferta) }}">
                </div>


                <a href="{{ route('chef.index') }}" class="inline-block bg-gray-500 text-white rounded-md px-4 py-2 hover:bg-gray-600 mr-4">
                    Regresar
                </a>
                <button type="submit" class="bg-blue-600 text-white rounded-md px-4 py-2 hover:bg-blue-700">
                    Actualizar Plato
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
