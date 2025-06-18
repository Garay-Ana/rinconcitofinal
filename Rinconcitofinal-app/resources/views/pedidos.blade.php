<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pedidos Asignados - Chef
        </h2>
    </x-slot>
<div class="py-12" style="background-color: #f4eedb;">
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Listado de Pedidos</h3>

                {{-- Tabla de pedidos --}}
                <table class="min-w-full border border-gray-300 text-sm">
                    <thead class="bg-gray-100 text-left">
                        <tr>
                            <th class="px-4 py-2 border"># Pedido</th>
                            <th class="px-4 py-2 border">Cliente</th>
                            <th class="px-4 py-2 border">Platos</th>
                            <th class="px-4 py-2 border">Estado</th>
                            <th class="px-4 py-2 border">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Pedido 1 --}}
                        <tr>
                            <td class="px-4 py-2 border">1001</td>
                            <td class="px-4 py-2 border">Juan Pérez</td>
                            <td class="px-4 py-2 border">Pizza, Ensalada</td>
                            <td class="px-4 py-2 border text-yellow-600 font-semibold">En preparación</td>
                            <td class="px-4 py-2 border">
                                <button class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">Marcar como Listo</button>
                            </td>
                        </tr>

                        {{-- Pedido 2 --}}
                        <tr>
                            <td class="px-4 py-2 border">1002</td>
                            <td class="px-4 py-2 border">María Gómez</td>
                            <td class="px-4 py-2 border">Hamburguesa, Papas</td>
                            <td class="px-4 py-2 border text-yellow-600 font-semibold">En preparación</td>
                            <td class="px-4 py-2 border">
                                <button class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">Marcar como Listo</button>
                            </td>
                        </tr>

                        {{-- Puedes continuar con más registros aquí --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>


