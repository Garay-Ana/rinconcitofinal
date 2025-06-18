<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Plato;
use Illuminate\Http\Request;

class ChefController extends Controller
{
    public function index()
    {
        // Obtener pedidos pendientes sin agrupar para incluir estado
        $pedidos = Pedido::whereIn('estado', ['pendiente', 'en preparación', 'listo_entrega', 'listo'])
            ->whereHas('plato', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->with('cliente', 'plato')
            ->get();

        // Calcular total por pedido y total general de ventas
        $totalVentas = 0;
        foreach ($pedidos as $pedido) {
            $precio = $pedido->plato->precio ?? 0;
            $cantidad = $pedido->cantidad ?? 1;
            $pedido->totalValor = $precio * $cantidad;
            $totalVentas += $pedido->totalValor;
        }

        // Obtener platos del chef autenticado
        $platos = Plato::where('user_id', auth()->id())->get();

        return view('chef', compact('pedidos', 'platos', 'totalVentas'));
    }

    public function updatePedido(Request $request, $id)
    {
        $request->validate([
            'estado' => 'required|string|in:pendiente,en preparación,listo,listo_entrega,entregado',
        ]);

        $pedido = Pedido::findOrFail($id);
        $pedido->estado = $request->input('estado');
        $pedido->save();

        // Reducir cantidad en inventario solo si el estado es 'listo' o 'listo_entrega'
        if (in_array($pedido->estado, ['listo', 'listo_entrega'])) {
            $plato = Plato::find($pedido->plato_id);
            if ($plato && $plato->cantidad > 0) {
                $plato->cantidad = max(0, $plato->cantidad - $pedido->cantidad);
                $plato->save();
            }
        }

        return redirect()->route('chef.index')->with('success', 'Estado del pedido actualizado correctamente.');
    }

    public function createPlato()
    {
        return view('chef.agregar-plato');
    }

    public function storePlato(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'ingredientes' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'cantidad' => 'nullable|integer|min:0',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'descuento_porcentaje' => 'nullable|integer|min:0|max:100',
            'fecha_inicio_oferta' => 'nullable|date',
            'fecha_fin_oferta' => 'nullable|date|after_or_equal:fecha_inicio_oferta',
        ]);

        $imagenPath = null;
        if ($request->hasFile('imagen')) {
            $image = $request->file('imagen');
            $imageName = time().'_'.$image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $imagenPath = 'images/' . $imageName;
        }

        Plato::create([
            'user_id' => auth()->id(),
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'ingredientes' => $request->ingredientes,
            'precio' => $request->precio,
            'cantidad' => $request->cantidad ?? 0,
            'imagen' => $imagenPath,
            'descuento_porcentaje' => $request->descuento_porcentaje,
            'fecha_inicio_oferta' => $request->fecha_inicio_oferta,
            'fecha_fin_oferta' => $request->fecha_fin_oferta,
        ]);

        return redirect()->route('chef.index')->with('success', 'Plato agregado correctamente.');
    }

    public function editPlato($id)
    {
        $plato = Plato::where('user_id', auth()->id())->findOrFail($id);
        return view('chef.editar-plato', compact('plato'));
    }

    public function updatePlato(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'ingredientes' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'cantidad' => 'nullable|integer|min:0',
        ]);

        $plato = Plato::where('user_id', auth()->id())->findOrFail($id);
        $plato->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'ingredientes' => $request->ingredientes,
            'precio' => $request->precio,
            'cantidad' => $request->cantidad,
        ]);

        return redirect()->route('chef.index')->with('success', 'Plato actualizado correctamente.');
    }

    public function destroyPlato($id)
    {
        $plato = Plato::where('user_id', auth()->id())->findOrFail($id);
        $plato->delete();

        return redirect()->route('chef.index')->with('success', 'Plato eliminado correctamente.');
    }

    public function inventario()
    {
        $platos = Plato::where('user_id', auth()->id())->get();
        return view('chef.inventario', compact('platos'));
    }

    public function updateCantidad(Request $request, $id)
    {
        $request->validate([
            'cantidad' => 'required|integer|min:0',
        ]);

        $plato = Plato::findOrFail($id);
        $plato->cantidad = $request->cantidad;
        $plato->save();

        return redirect()->route('chef.inventario')->with('success', 'Cantidad actualizada correctamente.');
    }

    public function mandarPedido()
    {
        $chefId = auth()->id();
        $pedidos = Pedido::whereIn('estado', ['pendiente', 'en preparación', 'listo'])
            ->whereHas('plato', function ($query) use ($chefId) {
                $query->where('user_id', $chefId);
            })
            ->with('plato', 'cliente')
            ->get();
        return view('chef.mandar-pedido', compact('pedidos'));
    }

    public function updatePedidoAgrupado(Request $request)
    {
        $clienteId = $request->input('cliente_id');
        $platoId = $request->input('plato_id');
        $nuevoEstado = $request->input('estado');

        $pedido = Pedido::where('cliente_id', $clienteId)
            ->where('plato_id', $platoId)
            ->first();

        if ($pedido) {
            $pedido->estado = $nuevoEstado;
            $pedido->save();

            if (in_array($nuevoEstado, ['listo', 'listo_entrega'])) {
                $plato = Plato::find($platoId);
                if ($plato && $plato->cantidad > 0) {
                    $plato->cantidad = max(0, $plato->cantidad - $pedido->cantidad);
                    $plato->save();
                }
            }
        }

        return redirect()->route('chef.index')->with('success', 'Estado del pedido actualizado correctamente.');
    }
}
