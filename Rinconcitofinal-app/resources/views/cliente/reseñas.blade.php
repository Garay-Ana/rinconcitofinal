<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Calificar y Reseñar Platillo
        </h2>
    </x-slot>

    <div class="py-12" style="background-color: #f4eedb;">
        <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md">
            <form method="POST" action="{{ route('guardarResena') }}">
                @csrf
                <div class="mb-5">
                    <label for="plato_id" class="block text-gray-700 font-medium mb-2">Selecciona un platillo</label>
                    <select id="plato_id" name="plato_id" required
                        class="w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500">
                        <option value="" disabled selected>Elige un platillo</option>
                        @foreach($platos as $plato)
                            <option value="{{ $plato->id }}">{{ $plato->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-5">
                    <label class="block text-gray-700 font-medium mb-2">Calificación</label>
                    <select name="calificacion" required
                        class="w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500">
                        <option value="" disabled selected>Elige una calificación</option>
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}">{{ $i }} estrella{{ $i > 1 ? 's' : '' }}</option>
                        @endfor
                    </select>
                </div>

                <div class="mb-5">
                    <label for="comentario" class="block text-gray-700 font-medium mb-2">Comentario (opcional)</label>
                    <textarea id="comentario" name="comentario" rows="4" maxlength="1000"
                        class="w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 resize-none focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500"
                        placeholder="Escribe tu comentario aquí..."></textarea>
                </div>

                <button type="submit"
                    class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-3 rounded-md shadow transition duration-300">
                    Enviar Reseña
                </button>
            </form>

            <div class="mt-6 flex justify-center">
                <a href="{{ route('cliente.dashboard') }}"
                   class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-3 px-6 rounded-md shadow transition duration-300">
                    Regresar
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
