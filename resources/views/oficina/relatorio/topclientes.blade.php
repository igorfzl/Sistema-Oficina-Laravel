@extends('navbar')
@section('content')
<div class="container mt-4">
    <div class="row mb-3">
        <div class="col-md-6">
            <h3>Relatório: Top 5 Clientes</h3>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('relatorios.index') }}" class="btn btn-secondary">Voltar ao Menu</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Total de Ordens de Serviço</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($topClientes as $cliente)
                    <tr>
                        <td>{{ $cliente->nome }}</td>
                        <td>{{ $cliente->total_os }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="2">Nenhuma OS encontrada.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
