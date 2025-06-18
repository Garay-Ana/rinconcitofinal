<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Crear Nuevo Usuario
        </h2>
    </x-slot>

    <div class="py-12" style="background-color: #f4eedb;">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow rounded-lg">
                <form method="POST" action="{{ route('admin.users.store') }}">
                    @csrf

                    <div class="mb-4">
                        <x-input-label for="name" :value="__('Nombre')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="email" :value="__('Correo Electrónico')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="password" :value="__('Contraseña')" />
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" />
                        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="tipo_usuario" :value="__('Tipo de Usuario')" />
                        <select id="tipo_usuario" name="tipo_usuario" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                            <option value="cliente" {{ old('tipo_usuario') == 'cliente' ? 'selected' : '' }}>Cliente</option>
                            <option value="chef" {{ old('tipo_usuario') == 'chef' ? 'selected' : '' }}>Chef</option>
                            <option value="repartidor" {{ old('tipo_usuario') == 'repartidor' ? 'selected' : '' }}>Repartidor</option>
                            <option value="admin" {{ old('tipo_usuario') == 'admin' ? 'selected' : '' }}>Administrador</option>
                        </select>
                        <x-input-error :messages="$errors->get('tipo_usuario')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="role" :value="__('Rol (opcional)')" />
                        <x-text-input id="role" class="block mt-1 w-full" type="text" name="role" :value="old('role')" />
                        <x-input-error :messages="$errors->get('role')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="fecha_nacimiento" :value="__('Fecha de Nacimiento (opcional)')" />
                        <x-text-input id="fecha_nacimiento" class="block mt-1 w-full" type="date" name="fecha_nacimiento" :value="old('fecha_nacimiento')" />
                        <x-input-error :messages="$errors->get('fecha_nacimiento')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button>
                            Crear Usuario
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
