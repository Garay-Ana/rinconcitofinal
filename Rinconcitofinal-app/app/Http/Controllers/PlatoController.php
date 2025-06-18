<?php

namespace App\Http\Controllers;

use App\Models\Plato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\CambioDisponibilidadPlato;

use App\Models\Resena;

class PlatoController extends Controller
{
    public function index(Request $request)
    {
        $minPrice = $request->query('min_price');
        $maxPrice = $request->query('max_price');
        $tipoComida = $request->query('tipo_comida');
        // $filtroSaludable = $request->query('filtro_saludable', ''); // Eliminado filtro saludable

        // Obtener tipos de comida únicos para el filtro
        $tiposComida = Plato::select('tipo_comida')
            ->whereNotNull('tipo_comida')
            ->distinct()
            ->pluck('tipo_comida');

        // Obtener platos en oferta activos
        $fechaActual = now()->toDateString();
        $platosEnOfertaQuery = Plato::whereNotNull('descuento_porcentaje')
            ->where('descuento_porcentaje', '>', 0)
            ->where('fecha_inicio_oferta', '<=', $fechaActual)
            ->where('fecha_fin_oferta', '>=', $fechaActual);

        // Obtener todos los platos sin filtrar por saludable o vegano
        $platosQuery = Plato::where(function($query) use ($fechaActual) {
            $query->whereNull('descuento_porcentaje')
                  ->orWhere('descuento_porcentaje', '=', 0)
                  ->orWhere('fecha_inicio_oferta', '>', $fechaActual)
                  ->orWhere('fecha_fin_oferta', '<', $fechaActual);
        });

        if ($minPrice !== null && $minPrice !== '') {
            $platosEnOfertaQuery->where('precio', '>=', $minPrice);
            $platosQuery->where('precio', '>=', $minPrice);
        }

        if ($maxPrice !== null && $maxPrice !== '') {
            $platosEnOfertaQuery->where('precio', '<=', $maxPrice);
            $platosQuery->where('precio', '<=', $maxPrice);
        }

        if ($tipoComida !== null && $tipoComida !== '') {
            $platosEnOfertaQuery->where('tipo_comida', $tipoComida);
            $platosQuery->where('tipo_comida', $tipoComida);
        }

        $platosEnOferta = $platosEnOfertaQuery->get();
        $platos = $platosQuery->get();

        // Obtener reseñas para mostrar en welcome
        $reseñas = Resena::with('user', 'plato')->latest()->take(10)->get();

        return view('welcome', compact('platosEnOferta', 'platos', 'reseñas', 'tiposComida', 'tipoComida', 'minPrice', 'maxPrice'));
    }


    public function guardarResena(Request $request)
    {
        $request->validate([
            'plato_id' => 'required|exists:platos,id',
            'calificacion' => 'required|integer|min:1|max:5',
            'comentario' => 'nullable|string|max:1000',
        ]);

        $resena = Resena::create([
            'user_id' => auth()->id(),
            'plato_id' => $request->input('plato_id'),
            'calificacion' => $request->input('calificacion'),
            'comentario' => $request->input('comentario'),
        ]);

        return redirect()->route('cliente.dashboard')->with('success', 'Reseña guardada correctamente.');
    }

    public function updateCantidad(Request $request, $id)
    {
        $request->validate([
            'cantidad' => 'required|integer|min:0',
        ]);

        $plato = Plato::findOrFail($id);
        $cantidadAnterior = $plato->cantidad;
        $nuevaCantidad = $request->input('cantidad');

        $plato->cantidad = $nuevaCantidad;
        $plato->save();

        // Detectar cambio en disponibilidad
        $disponibleAntes = $cantidadAnterior > 0;
        $disponibleAhora = $nuevaCantidad > 0;

        if ($disponibleAntes !== $disponibleAhora) {
            // Obtener clientes que tienen pedidos con este plato
            $clientes = \App\Models\Pedido::where('plato_id', $plato->id)
                ->with('cliente')
                ->get()
                ->pluck('cliente')
                ->unique('id')
                ->filter();

            // Enviar notificación a los clientes
            Notification::send($clientes, new CambioDisponibilidadPlato($plato, $disponibleAhora));
        }

        return redirect()->route('chef.inventario')->with('success', 'Cantidad actualizada correctamente.');
    }

    public function indexChef()
    {
        $platos = Plato::where('user_id', auth()->id())->get();
        return view('chef.inventario', compact('platos'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'ingredientes' => 'nullable|string',
            'precio' => 'required|numeric',
            'imagen' => 'nullable|image',
            'cantidad' => 'nullable|integer',
            'descuento_porcentaje' => 'nullable|integer|min:0|max:100',
            'fecha_inicio_oferta' => 'nullable|date',
            'fecha_fin_oferta' => 'nullable|date|after_or_equal:fecha_inicio_oferta',
        ]);

        if ($request->hasFile('imagen')) {
            $image = $request->file('imagen');
            $imageName = time().'_'.$image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $data['imagen'] = 'images/' . $imageName;
        }

        $data['user_id'] = auth()->id();
        
        Plato::create($data);

        return redirect()->route('chef.index')->with('success', 'Plato creado correctamente.');
    }

    public function update(Request $request, Plato $plato)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'ingredientes' => 'nullable|string',
            'precio' => 'required|numeric',
            'cantidad' => 'nullable|integer',
            'descuento_porcentaje' => 'nullable|integer|min:0|max:100',
            'fecha_inicio_oferta' => 'nullable|date',
            'fecha_fin_oferta' => 'nullable|date|after_or_equal:fecha_inicio_oferta',
        ]);

        // Asignar saludable a false para evitar error de validación
        $data['saludable'] = false;

        $plato->update($data);

        return redirect()->route('chef.index')->with('success', 'Plato actualizado correctamente.');
    }

    public function create()
    {
        return view('chef.agregar-plato');
    }

    public function destroy($id)
    {
        $plato = Plato::findOrFail($id);
        $plato->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Plato eliminado correctamente.');
    }
}
