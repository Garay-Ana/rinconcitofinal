<?php

namespace App\Http\Controllers;

use App\Models\Plato;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ClienteController extends Controller
{
    public function index()
    {
        // Obtener todos los platos para mostrar al cliente
        $platos = Plato::all();
        return view('cliente', compact('platos'));
    }

    // Agregar plato al carrito (sesión)
    public function agregarAlCarrito(Request $request)
    {
        $request->validate([
            'plato_id' => 'required|exists:platos,id',
            'cantidad' => 'required|integer|min:1',
        ]);

        $carrito = Session::get('carrito', []);

        $platoId = $request->plato_id;
        $cantidad = $request->cantidad;

        if (isset($carrito[$platoId])) {
            $carrito[$platoId]['cantidad'] += $cantidad;
        } else {
            $plato = Plato::find($platoId);
            $carrito[$platoId] = [
                'plato' => $plato,
                'cantidad' => $cantidad,
            ];
        }

        Session::put('carrito', $carrito);

        return redirect()->route('cliente.carrito')->with('success', 'Plato agregado al carrito.');
    }

    // Mostrar carrito
    public function mostrarCarrito()
    {
        $carrito = Session::get('carrito', []);

        // Reconstruir objetos Plato para que métodos como precioConDescuento estén disponibles
        foreach ($carrito as &$item) {
            if (is_array($item['plato'])) {
                $item['plato'] = Plato::find($item['plato']['id']);
            }
        }

        return view('cliente.carrito', compact('carrito'));
    }

    // Confirmar pedido y vaciar carrito
    public function confirmarPedido()
    {
        $carrito = Session::get('carrito', []);

        if (empty($carrito)) {
            return redirect()->route('cliente.carrito')->with('error', 'El carrito está vacío.');
        }

        foreach ($carrito as $item) {
            $precioConDescuento = $item['plato']->precioConDescuento();
            $cantidad = $item['cantidad'] ?? 1;

            Pedido::create([
                'cliente_id' => Auth::id(),
                'plato_id' => $item['plato']->id,
                'estado' => 'pendiente',
                'cantidad' => $cantidad,
                'precio_con_descuento' => $precioConDescuento,
            ]);
        }

        Session::forget('carrito');

        return redirect()->route('cliente.dashboard')->with('success', 'Pedido realizado correctamente.');
    }

    public function actualizarCantidadCarrito(Request $request)
    {
        $request->validate([
            'plato_id' => 'required|exists:platos,id',
            'cantidad' => 'required|integer|min:1',
        ]);

        $carrito = Session::get('carrito', []);

        $platoId = $request->plato_id;
        $cantidad = $request->cantidad;

        if (isset($carrito[$platoId])) {
            $carrito[$platoId]['cantidad'] = $cantidad;
            Session::put('carrito', $carrito);
            return redirect()->route('cliente.carrito')->with('success', 'Cantidad actualizada correctamente.');
        }

        return redirect()->route('cliente.carrito')->with('error', 'El plato no está en el carrito.');
    }

    public function eliminarPlatoCarrito($id)
    {
        $carrito = Session::get('carrito', []);

        if (isset($carrito[$id])) {
            unset($carrito[$id]);
            Session::put('carrito', $carrito);
            return redirect()->route('cliente.carrito')->with('success', 'Plato eliminado del carrito correctamente.');
        }

        return redirect()->route('cliente.carrito')->with('error', 'El plato no está en el carrito.');
    }

    // Nuevo método para mostrar la vista de reseñas con solo el formulario
    public function mostrarResenas()
    {
        $platos = Plato::all();
        return view('cliente.reseñas', compact('platos'));
    }
}
