<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Bienvenido {{ Auth::user()->name }}
        </h2>
    </x-slot>

    <div class="py-12" style="background-color: #f4eedb;">
        <div class="flex flex-col items-center justify-center min-h-screen">
            <!-- Logo en grande -->
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-2/3 max-w-md md:max-w-xl lg:max-w-2xl">

            <!-- Misión y Visión debajo del logo -->
            <div class="mt-10 max-w-4xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-2xl font-bold mb-4 text-center">Nuestra Misión</h3>
                    <p class="text-gray-700 text-justify mb-6">
                        Brindar a nuestros clientes una experiencia culinaria única, ofreciendo platos de alta calidad con ingredientes frescos, en un ambiente acogedor y con atención personalizada.
                    </p>

                    <h3 class="text-2xl font-bold mb-4 text-center">Nuestra Visión</h3>
                    <p class="text-gray-700 text-justify">
                        Ser reconocidos como la plataforma líder en gastronomía local, conectando a los amantes de la buena comida con propuestas innovadoras y sostenibles.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
