<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Aceptar Pedido</h2>
    </x-slot>


    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 rounded shadow">
            <p>Aquí podrás ver los pedidos asignados y aceptar uno para comenzar la entrega.</p>

            <!-- Ejemplo básico de listado de pedidos -->
            <ul class="list-disc pl-5 mt-4">
                <li>Pedido #001 - Cliente: Juan Pérez - Detalles...</li>
                <li>Pedido #002 - Cliente: María Gómez - Detalles...</li>
            </ul>

            <button class="mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Aceptar Pedido</button>
        </div>
    </div>
</x-app-layout>

