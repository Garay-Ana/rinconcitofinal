<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Resolver Incidencias</h2>
    </x-slot>
<div class="py-12" style="background-color: #f4eedb;">
    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 rounded shadow">
            <p>Reporta o resuelve cualquier problema que ocurra durante la entrega.</p>

            <form class="mt-4 space-y-4">
                <label class="block">
                    Pedido:
                    <select class="border rounded w-full py-2 px-3">
                        <option>Pedido #001</option>
                        <option>Pedido #002</option>
                    </select>
                </label>

                <label class="block">
                    Descripción de la incidencia:
                    <textarea class="border rounded w-full py-2 px-3" rows="4" placeholder="Describe la incidencia..."></textarea>
                </label>

                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Registrar Incidencia</button>
            </form>
        </div>
    </div>
</x-app-layout>
