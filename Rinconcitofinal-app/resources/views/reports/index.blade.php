<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight">
            📈 Generar Reportes Financieros y de Consumo
        </h2>
    </x-slot>
 <div class="py-12" style="background-color:rgb(217, 212, 204);">
    <div class="container py-5">

        {{-- Filtro de fechas --}}
        <div class="card shadow-sm mb-4 border-0">
            <div class="card-body">
                <form method="GET" action="{{ route('reports.index') }}">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-4">
                            <label for="start_date" class="form-label fw-semibold">📅 Fecha inicio</label>
                            <input type="date" id="start_date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                        </div>
                        <div class="col-md-4">
                            <label for="end_date" class="form-label fw-semibold">📅 Fecha fin</label>
                            <input type="date" id="end_date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                        </div>
                        <div class="col-md-4 d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-funnel-fill me-1"></i> Filtrar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Botones de descarga --}}
        @if(request()->has('start_date') && request()->has('end_date'))
        <div class="mb-3 d-flex gap-2">
            <a href="{{ route('reports.pdf', request()->all()) }}" class="btn btn-outline-danger">
                <i class="bi bi-file-earmark-pdf-fill me-1"></i> PDF
            </a>
            {{-- <a href="{{ route('reports.excel', request()->all()) }}" class="btn btn-outline-success">
                <i class="bi bi-file-earmark-excel-fill me-1"></i> Excel
            </a> --}}
        </div>
        @endif

        {{-- Resumen y tabla --}}
        @if(isset($pedidos))
        <div class="card border-0 shadow-sm">
            <div class="card-body">

                <h4 class="fw-bold mb-3 text-primary">📊 Resumen de Ventas</h4>
                <ul class="list-unstyled mb-4">
                    <li><strong>Total de pedidos:</strong> {{ $totalPedidos }}</li>
                    <li><strong>Total de ventas:</strong> ${{ number_format($totalVentas, 0, ',', '.') }}</li>
                </ul>

                <h5 class="fw-bold mb-3 text-secondary">🧾 Detalle de Pedidos</h5>
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle shadow-sm">
                        <thead class="table-light text-center">
                            <tr>
                                <th><i class="bi bi-hash"></i> ID</th>
                                <th><i class="bi bi-person-fill"></i> Cliente</th>
                                <th><i class="bi bi-egg-fried"></i> Plato</th>
                                <th><i class="bi bi-stack"></i> Cantidad</th>
                                <th><i class="bi bi-currency-dollar"></i> Total</th>
                                <th><i class="bi bi-calendar-event"></i> Fecha</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @forelse($pedidos as $pedido)
                            <tr>
                                <td class="fw-semibold">{{ $pedido->id }}</td>
                                <td>{{ $pedido->cliente->nombre ?? 'N/A' }}</td>
                                <td>{{ $pedido->plato->nombre ?? 'N/A' }}</td>
                                <td>{{ $pedido->cantidad }}</td>
                                <td class="text-success fw-bold">${{ number_format($pedido->totalValor ?? 0, 0, ',', '.') }}</td>
                                <td>{{ $pedido->created_at->format('d/m/Y') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-muted">No hay registros para este período.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        @endif

        <a href="{{ url('/chef/inventario') }}" class="btn btn-secondary mt-3">Regresar</a>

    </div>

    {{-- Bootstrap Icons CDN --}}
    @push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    @endpush
</x-app-layout>
