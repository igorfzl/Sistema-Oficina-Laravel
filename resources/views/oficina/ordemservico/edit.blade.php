@extends('navbar')

@section('content')
<div class="container mt-4">
    <div class="row mb-3">
        <div class="col-md-6">
            <h3>Editar Ordem de Serviço #{{ $ordemServico->id }}</h3>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('ordemservicos.index') }}" class="btn btn-secondary">Voltar ao Histórico</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('ordemservicos.update', $ordemServico) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="cliente_id" class="form-label">Cliente *</label>
                            <select id="cliente_id" name="cliente_id" class="form-select" required>
                                <option value="">Selecione um cliente</option>
                                @foreach($clientes as $cliente)
                                <option value="{{ $cliente->id }}" {{ old('cliente_id', $ordemServico->cliente_id) == $cliente->id ? 'selected' : '' }}>
                                    {{ $cliente->nome }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="veiculo_id" class="form-label">Veículo *</label>
                            <select id="veiculo_id" name="veiculo_id" class="form-select" required>
                                <option value="">Selecione um veículo</option>
                                @foreach($veiculos as $veiculo)
                                <option value="{{ $veiculo->id }}" {{ old('veiculo_id', $ordemServico->veiculo_id) == $veiculo->id ? 'selected' : '' }}>
                                    {{ $veiculo->placa ?? $veiculo->modelo }} (Dono: {{ $veiculo->cliente->nome ?? 'N/A' }})
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="data_entrada" class="form-label">Data de Entrada *</label>
                            <input type="date" id="data_entrada" name="data_entrada" class="form-control" value="{{ old('data_entrada', $ordemServico->data_entrada) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="data_saida_prevista" class="form-label">Previsão de Saída</a-label>
                                <input type="date" id="data_saida_prevista" name="data_saida_prevista" class="form-control" value="{{ old('data_saida_prevista', $ordemServico->data_saida_prevista) }}">
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status *</label>
                            <select id="status" name="status" class="form-select" required>
                                <option value="Pendente" {{ old('status', $ordemServico->status) == 'Pendente' ? 'selected' : '' }}>Pendente</option>
                                <option value="Em Andamento" {{ old('status', $ordemServico->status) == 'Em Andamento' ? 'selected' : '' }}>Em Andamento</option>
                                <option value="Aguardando Peça" {{ old('status', $ordemServico->status) == 'Aguardando Peça' ? 'selected' : '' }}>Aguardando Peça</option>
                                <option value="Finalizada" {{ old('status', $ordemServico->status) == 'Finalizada' ? 'selected' : '' }}>Finalizada</option>
                                <option value="Cancelada" {{ old('status', $ordemServico->status) == 'Cancelada' ? 'selected' : '' }}>Cancelada</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="servico_id" class="form-label">Serviço Principal</label>
                            <select id="servico_id" name="servico_id" class="form-select">
                                <option value="">Nenhum serviço</option>
                                @foreach($servicos as $servico)
                                <option value="{{ $servico->id }}" {{ old('servico_id', $ordemServico->servico_id) == $servico->id ? 'selected' : '' }}>
                                    {{ $servico->nome }} (R$ {{ number_format($servico->valor, 2, ',', '.') }})
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="produto_id" class="form-label">Produto Principal</label>
                            <select id="produto_id" name="produto_id" class="form-select">
                                <option value="">Nenhum produto</option>
                                @foreach($produtos as $produto)
                                <option value="{{ $produto->id }}" {{ old('produto_id', $ordemServico->produto_id) == $produto->id ? 'selected' : '' }}>
                                    {{ $produto->nome }} (R$ {{ number_format($produto->valor, 2, ',', '.') }})
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="produto_quantidade" class="form-label">Quantidade do Produto</label>
                            <input type="number" id="produto_quantidade" name="produto_quantidade" class="form-control" value="{{ old('produto_quantidade', $ordemServico->produto_quantidade) }}" placeholder="Obrigatório se selecionar um produto">
                        </div>

                        <div class="mb-3">
                            <label for="descricao_problema" class="form-label">Descrição do Problema</label>
                            <textarea id="descricao_problema" name="descricao_problema" class="form-control" rows="3">{{ old('descricao_problema', $ordemServico->descricao_problema) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="observacoes" class="form-label">Observações Internas</label>
                            <textarea id="observacoes" name="observacoes" class="form-control" rows="3">{{ old('observacoes', $ordemServico->observacoes) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <a href="{{ route('ordemservicos.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Atualizar Ordem de Serviço</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
