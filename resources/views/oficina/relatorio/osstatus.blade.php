@extends('navbar')
@section('content')
<div class="container mt-4">
    <div class="row mb-3">
        <div class="col-md-6">
            <h3>Relatório: Ordens de Serviço por Status</h3>
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
                        <th>Status</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($osPorStatus as $status)
                    <tr>
                        <td>{{ $status->status }}</td>
                        <td>{{ $status->total }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="2">Nenhum status encontrado.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
