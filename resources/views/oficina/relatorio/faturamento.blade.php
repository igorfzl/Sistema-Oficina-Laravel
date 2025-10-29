@extends('navbar')
@section('content')
<div class="container mt-4">
    <div class="row mb-3">
        <div class="col-md-6">
            <h3>Relatório de Faturamento</h3>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('relatorios.index') }}" class="btn btn-secondary">Voltar ao Menu</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h2>Resumo Geral</h2>
            <div class="resumo" style="background: #f4f4f4; padding: 15px; border-radius: 5px;">
                <p>Faturamento Total (Vendas + OS): <strong>R$ {{ number_format($faturamentoTotal, 2, ',', '.') }}</strong></p>
                <p>Total de Registos (Vendas + OS): <strong>{{ $totalRegistros }}</strong></p>
            </div>
        </div>
    </div>
</div>
@endsection
