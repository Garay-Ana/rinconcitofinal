<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Actualizar Estado del Pedido</h2>
    </x-slot>
<div class="py-12" style="background-color: #f4eedb;">
    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 rounded shadow">
            <p>Selecciona el pedido y actualiza su estado.</p>

            <form class="mt-4 space-y-4">
                <label class="block">
                    Pedido:
                    <select class="border rounded w-full py-2 px-3">
                        <option>Pedido #001</option>
                        <option>Pedido #002</option>
                    </select>
                </label>

                <label class="block">
                    Estado:
                    <select class="border rounded w-full py-2 px-3">
                        <option>En ruta</option>
                        <option>Entregado</option>
                        <option>Cancelado</option>
                    </select>
                </label>

                <button type="submit" class="px-4 py-2 bg-yellow-600 text-white rounded hover:bg-yellow-700">Actualizar Estado</button>
            </form>
        </div>
    </div>
</x-app-layout>

