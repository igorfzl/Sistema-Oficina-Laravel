@extends('navbar')

@section('content')
<div class="container mt-4">
    <div class="row mb-3">
        <div class="col-md-6">
            <h3>Detalhes da Ordem de Serviço #{{ $ordemServico->id }}</h3>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('ordemservicos.index') }}" class="btn btn-secondary">Voltar ao Histórico</a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Resumo da OS</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <strong>Cliente:</strong>
                    <p>{{ $ordemServico->cliente->nome ?? 'Cliente não informado' }}</p>

                    <strong>Veículo:</strong>
                    <p>{{ $ordemServico->veiculo->marca ?? '' }} {{ $ordemServico->veiculo->modelo ?? '' }} (Placa: {{ $ordemServico->veiculo->placa ?? 'N/A' }})</p>

                    <strong>Descrição do Problema:</strong>
                    <p>{{ $ordemServico->descricao_problema ?? 'Nenhuma descrição fornecida.' }}</p>

                    <strong>Observações Internas:</strong>
                    <p>{{ $ordemServico->observacoes ?? 'Nenhuma observação.' }}</p>
                </div>
                <div class="col-md-6">
                    <strong>Status:</strong>
                    <p>
                        @switch($ordemServico->status)
                        @case('Pendente')
                        <span class="badge bg-warning text-dark">{{ $ordemServico->status }}</span>
                        @break
                        @case('Em Andamento')
                        <span class="badge bg-info text-dark">{{ $ordemServico->status }}</span>
                        @break
                        @case('Aguardando Peça')
                        <span class="badge bg-secondary">{{ $ordemServico->status }}</span>
                        @break
                        @case('Finalizada')
                        <span class="badge bg-success">{{ $ordemServico->status }}</span>
                        @break
                        @case('Cancelada')
                        <span class="badge bg-danger">{{ $ordemServico->status }}</span>
                        @break
                        @default
                        <span class="badge bg-light text-dark">{{ $ordemServico->status }}</span>
                        @endswitch
                    </p>
                    <strong>Data de Entrada:</strong>
                    <p>{{ \Carbon\Carbon::parse($ordemServico->data_entrada)->format('d/m/Y') }}</p>

                    <strong>Previsão de Saída:</strong>
                    <p>{{ $ordemServico->data_saida_prevista ? \Carbon\Carbon::parse($ordemServico->data_saida_prevista)->format('d/m/Y') : 'Não definida' }}</p>
                </div>
            </div>

            <hr>
            <h5>Itens da Ordem de Serviço</h5>
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Item (Serviço/Produto)</th>
                        <th>Qtd.</th>
                        <th>Valor Unit.</th>
                        <th>Valor Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $subtotalServico = 0;
                    $subtotalProduto = 0;
                    @endphp

                    @if ($ordemServico->servico)
                    @php $subtotalServico = $ordemServico->servico->valor; @endphp
                    <tr>
                        <td>(Serviço) {{ $ordemServico->servico->nome }}</td>
                        <td>1</td>
                        <td>R$ {{ number_format($ordemServico->servico->valor, 2, ',', '.') }}</td>
                        <td>R$ {{ number_format($subtotalServico, 2, ',', '.') }}</td>
                    </tr>
                    @endif

                    @if ($ordemServico->produto)
                    @php $subtotalProduto = $ordemServico->produto->valor * $ordemServico->produto_quantidade; @endphp
                    <tr>
                        <td>(Produto) {{ $ordemServico->produto->nome }}</td>
                        <td>{{ $ordemServico->produto_quantidade }}</td>
                        <td>R$ {{ number_format($ordemServico->produto->valor, 2, ',', '.') }}</td>
                        <td>R$ {{ number_format($subtotalProduto, 2, ',', '.') }}</td>
                    </tr>
                    @endif

                    @if (!$ordemServico->servico && !$ordemServico->produto)
                    <tr>
                        <td colspan="4" class="text-center">Nenhum serviço ou produto associado a esta OS.</td>
                    </tr>
                    @endif
                </tbody>
                <tfoot class="table-group-divider">
                    <tr>
                        <td colspan="3" class="text-end"><strong>Valor Total:</strong></td>
                        <td><strong>R$ {{ number_format($ordemServico->valor_total, 2, ',', '.') }}</strong></td>
                    </tr>
                </tfoot>
            </table>

        </div>
    </div>
</div>
@endsection
