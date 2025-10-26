@extends('navbar')

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-md-6">
            <h3>Detalhes da Venda #{{ $venda->id }}</h3>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('vendas.index') }}" class="btn btn-secondary">Voltar ao Histórico</a>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Informações Principais</h5>
            <div class="row mb-4">
                <div class="col-md-3">
                    <strong>ID da Venda:</strong>
                    <p>{{ $venda->id }}</p>
                </div>
                <div class="col-md-3">
                    <strong>Data da Venda:</strong>
                    <p>{{ \Carbon\Carbon::parse($venda->data_venda)->format('d/m/Y') }}</p>
                </div>
                <div class="col-md-3">
                    <strong>Cliente:</strong>
                    <p>{{ $venda->cliente ? $venda->cliente->nome : 'Cliente não encontrado' }}</p>
                </div>
                <div class="col-md-3">
                    <strong>Status:</strong>
                    <p><span class="badge bg-success">{{ $venda->status }}</span></p>
                </div>
            </div>

            <hr>
            <h5 class="card-title mt-4">Itens da Venda</h5>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th class="text-center">Quantidade</th>
                            <th class="text-end">Preço Unitário</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $venda->produto ? $venda->produto->nome : 'Produto não encontrado' }}</td>
                            <td class="text-center">{{ $venda->quantidade }}</td>
                            <td class="text-end">R$ {{ $venda->produto ? number_format($venda->produto->valor, 2, ',', '.') : '0,00' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <hr>
            <div class="row justify-content-end mt-4">
                <div class="col-md-4">
                    <dl class="row">
                        <dt class="col-6 fs-5">Valor Total:</dt>
                        <dd class="col-6 fs-5 text-end fw-bold">R$ {{ number_format($venda->valor_total, 2, ',', '.') }}</dd>
                    </dl>
                </div>
            </div>

            <hr>
            <div class="mt-4">
                <strong>Observações:</strong>
                <p class="card-text bg-light p-3 rounded" style="min-height: 80px;">
                    {!! nl2br(e($venda->observacoes ?? 'Nenhuma observação.')) !!}
                </p>
            </div>

        </div>
    </div>
</div>
@endsection
