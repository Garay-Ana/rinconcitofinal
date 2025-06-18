<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">
            Control de Inventario – Chef
        </h2>
    </x-slot>
<div class="py-12" style="background-color: #f4eedb;">
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 shadow-md rounded-lg">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-semibold text-gray-700">Ingredientes en Inventario</h3>
                    <button class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-5 py-2 rounded transition duration-200">
                        + Agregar Ingrediente
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-gray-700 border rounded">
                        <thead class="bg-gray-100 uppercase text-xs font-semibold text-gray-600">
                            <tr>
                                <th class="px-6 py-3 text-left border-b">Ingrediente</th>
                                <th class="px-6 py-3 text-left border-b">Cantidad</th>
                                <th class="px-6 py-3 text-left border-b">Unidad</th>
                                <th class="px-6 py-3 text-left border-b">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 border-b">Queso Mozzarella</td>
                                <td class="px-6 py-4 border-b">5</td>
                                <td class="px-6 py-4 border-b">Kg</td>
                                <td class="px-6 py-4 border-b">
                                    <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-1 rounded text-sm transition duration-200">
                                        Editar
                                    </button>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 border-b">Carne de Res</td>
                                <td class="px-6 py-4 border-b">10</td>
                                <td class="px-6 py-4 border-b">Kg</td>
                                <td class="px-6 py-4 border-b">
                                    <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-1 rounded text-sm transition duration-200">
                                        Editar
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
