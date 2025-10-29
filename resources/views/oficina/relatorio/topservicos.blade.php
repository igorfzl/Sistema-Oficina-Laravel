@extends('navbar')
@section('content')
<div class="container mt-4">
    <div class="row mb-3">
        <div class="col-md-6">
            <h3>Relatório: Top 5 Serviços</h3>
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
                        <th>Serviço</th>
                        <th>Total de Vezes Realizado</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($topServicos as $servico)
                    <tr>
                        <td>{{ $servico->nome }}</td>
                        <td>{{ $servico->total_realizado }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="2">Nenhum serviço realizado em OS.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
