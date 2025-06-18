<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('👤 Perfil de Usuario') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-xl p-8 space-y-6 border border-gray-200">
                <div class="text-center">
                    <h3 class="text-xl font-semibold text-gray-800">Información Personal</h3>
                    <p class="text-sm text-gray-500">Consulta tus datos registrados</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-gray-700">
                    <div>
                        <span class="font-medium text-gray-600">Nombre:</span>
                        <p class="text-lg">{{ $user->name }}</p>
                    </div>
                    <div>
                        <span class="font-medium text-gray-600">Correo electrónico:</span>
                        <p class="text-lg">{{ $user->email }}</p>
                    </div>
                    <div>
                        <span class="font-medium text-gray-600">Teléfono:</span>
                        <p class="text-lg">{{ $user->telefono ?? 'No registrado' }}</p>
                    </div>
                    <div>
                        <span class="font-medium text-gray-600">Tipo de usuario:</span>
                        <p class="text-lg">{{ ucfirst($user->tipo_usuario) }}</p>
                    </div>
                    <div>
                        <span class="font-medium text-gray-600">Fecha de nacimiento:</span>
                        <p class="text-lg">{{ $user->fecha_nacimiento ? $user->fecha_nacimiento->format('d/m/Y') : 'No registrada' }}</p>
                    </div>
                    <div>
                        <span class="font-medium text-gray-600">Fecha de creación:</span>
                        <p class="text-lg">{{ $user->created_at->format('d/m/Y') }}</p>
                    </div>
                </div>

                <div class="flex justify-end gap-4 mt-8">
                    @php
                        $userType = strtolower($user->tipo_usuario);
                        $redirectUrl = '/';
                        if ($userType === 'cliente') {
                            $redirectUrl = url('/cliente');
                        } elseif ($userType === 'chef') {
                            $redirectUrl = url('/chef');
                        } elseif ($userType === 'admin') {
                            $redirectUrl = url('/admin');
                        } elseif ($userType === 'repartidor') {
                            $redirectUrl = url('/repartidor');
                        }
                    @endphp
                    <a href="{{ $redirectUrl }}" class="inline-block px-5 py-2 rounded-md bg-gray-200 text-gray-800 hover:bg-gray-300 transition">
                        ← Regresar
                    </a>
                    <a href="{{ route('profile.edit') }}" class="inline-block px-5 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700 transition">
                        Cambiar contraseña
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
