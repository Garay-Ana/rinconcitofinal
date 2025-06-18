<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Show the registration view.
     */
    public function create()
    {
        return view('auth.register_with_fecha_nacimiento');
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request)
    {
        // Validaciones incluyendo 'unique:users' para el correo
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'tipo_usuario' => ['required', 'in:cliente,chef,repartidor,admin'],
            'fecha_nacimiento' => ['required', 'date'],
            'telefono' => ['required', 'string', 'max:20'],
        ]);

        // Crear el usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'tipo_usuario' => $request->tipo_usuario,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'telefono' => $request->telefono,
        ]);

        event(new Registered($user));

        Auth::login($user);

        // Redirección según rol
        return match ($user->tipo_usuario) {
            'admin' => redirect('/admin'),
            'chef' => redirect('/chef'),
            'repartidor' => redirect('/repartidor'),
            default => redirect('/cliente'),
        };
    }
}

