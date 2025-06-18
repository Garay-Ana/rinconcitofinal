<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Ruta por defecto después del login.
     */
    

    public function boot(): void
    {
        
        // Redirección por rol después de login
        // $this->redirectToByRole();

        // Definición de rutas
        $this->routes(function () {
            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));
        });
    }

    // protected function redirectToByRole()
    // {
    //     // Esto se ejecuta solo después de login exitoso
    //     app('router')->middleware('web')->pushMiddlewareToGroup('web', function ($request, $next) {
    //         if (auth()->check()) {
    //             $rol = auth()->user()->tipo_usuario;
    //             switch ($rol) {
    //                 case 'admin':
    //                     return redirect('/admin');
    //                 case 'chef':
    //                     return redirect('/chef');
    //                 case 'cliente':
    //                     return redirect('/cliente');
    //             }
    //         }
    //         return $next($request);
    //     });
    // }
}
