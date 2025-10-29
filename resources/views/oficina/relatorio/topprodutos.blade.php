@extends('navbar')
@section('content')
<div class="container mt-4">
    <div class="row mb-3">
        <div class="col-md-6">
            <h3>Relatório: Top 5 Produtos (Peças)</h3>
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
                        <th>Produto (Peça)</th>
                        <th>Total de Unidades Utilizadas</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($topProdutos as $produto)
                    <tr>
                        <td>{{ $produto->nome }}</td>
                        <td>{{ $produto->total_usado }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="2">Nenhum produto utilizado em OS.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
