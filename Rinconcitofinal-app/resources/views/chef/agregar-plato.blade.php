<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            👨‍🍳 Agregar Nuevo Plato
        </h2>
    </x-slot>
 <div class="py-12" style="background-color: #FEF3C7;">
    <div class="py-12 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-md rounded-lg p-8 space-y-6">
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

<form method="POST" action="{{ route('chef.plato.store') }}" enctype="multipart/form-data" class="space-y-6">
    @csrf

    <div>
        <label for="nombre" class="block text-sm font-medium text-gray-700">🍽️ Nombre del Plato</label>
        <input type="text" name="nombre" id="nombre"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
            value="{{ old('nombre') }}" required>
    </div>

    <div>
        <label for="descuento_porcentaje" class="block text-sm font-medium text-gray-700">📉 Descuento (%)</label>
        <input type="number" name="descuento_porcentaje" id="descuento_porcentaje" min="0" max="100"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
            value="{{ old('descuento_porcentaje') }}">
    </div>

    <div>
        <label for="fecha_inicio_oferta" class="block text-sm font-medium text-gray-700">📅 Fecha Inicio Oferta</label>
        <input type="date" name="fecha_inicio_oferta" id="fecha_inicio_oferta"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
            value="{{ old('fecha_inicio_oferta') }}">
    </div>

    <div>
        <label for="fecha_fin_oferta" class="block text-sm font-medium text-gray-700">📅 Fecha Fin Oferta</label>
        <input type="date" name="fecha_fin_oferta" id="fecha_fin_oferta"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
            value="{{ old('fecha_fin_oferta') }}">
    </div>

                <div>
                    <label for="descripcion" class="block text-sm font-medium text-gray-700">📝 Descripción</label>
                    <textarea name="descripcion" id="descripcion" rows="3"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Describe el plato...">{{ old('descripcion') }}</textarea>
                </div>

                <div>
                    <label for="precio" class="block text-sm font-medium text-gray-700">💲 Precio</label>
                    <input type="number" step="0.01" name="precio" id="precio"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        value="{{ old('precio') }}" required>
                </div>

                <div>
                    <label for="ingredientes" class="block text-sm font-medium text-gray-700">🧾 Ingredientes</label>
                    <textarea name="ingredientes" id="ingredientes" rows="3"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Lista de ingredientes...">{{ old('ingredientes') }}</textarea>
                </div>

                <div>
                    <label for="cantidad" class="block text-sm font-medium text-gray-700">📦 Cantidad Disponible</label>
                    <input type="number" name="cantidad" id="cantidad" min="0"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        value="{{ old('cantidad', 0) }}">
                </div>

                <div>
    <label for="imagen" class="block text-sm font-medium text-gray-700">📷 Imagen del Plato</label>
    <input type="file" name="imagen" id="imagen"
        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:border file:border-gray-300 file:rounded-md file:bg-gray-50 file:text-sm file:font-semibold file:text-gray-700 hover:file:bg-gray-100"
        accept="image/*" onchange="previewImage(event)">
    <img id="imagePreview" src="#" alt="Vista previa de la imagen" class="mt-4 max-h-48 hidden rounded-md" />
</div>

<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('imagePreview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = '#';
            preview.classList.add('hidden');
        }
    }
</script>

                <div class="text-right">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-md shadow transition">
                        ➕ Agregar Plato
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
