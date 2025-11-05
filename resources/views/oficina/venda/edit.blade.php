@extends('navbar')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar Venda</div>
                <div class="card-body">

                    <form method="POST" action="{{ route('vendas.update', $venda->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="cliente_id" class="form-label">Cliente</label>
                            <select id="cliente_id" name="cliente_id" class="form-select">
                                @foreach ($clientes as $cliente)
                                <option value="{{ $cliente->id }}" {{ $cliente->id == $venda->cliente_id ? 'selected' : '' }}>
                                    {{ $cliente->nome }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="produto_id" class="form-label">Produto</label>
                            <select id="produto_id" name="produto_id" class="form-select" required>
                                @foreach ($produtos as $produto)
                                <option value="{{ $produto->id }}" {{ $produto->id == $venda->produto_id ? 'selected' : '' }}>
                                    {{ $produto->nome }} - R$ {{ number_format($produto->valor, 2, ',', '.') }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="quantidade" class="form-label">Quantidade</label>
                            <input type="number" id="quantidade" name="quantidade" class="form-control"
                                value="{{ old('quantidade', $venda->quantidade) }}" min="1" required>
                        </div>

                        <div class="mb-3">
                            <label for="forma_pagamento" class="form-label">Forma de Pagamento</label>
                            <select id="forma_pagamento" name="forma_pagamento" class="form-select">
                                <option value="Dinheiro" {{ old('forma_pagamento', $venda->forma_pagamento) == 'Dinheiro' ? 'selected' : '' }}>Dinheiro</option>
                                <option value="Cartão de Débito" {{ old('forma_pagamento', $venda->forma_pagamento) == 'Cartão de Débito' ? 'selected' : '' }}>Cartão de Débito</option>
                                <option value="Cartão de Crédito" {{ old('forma_pagamento', $venda->forma_pagamento) == 'Cartão de Crédito' ? 'selected' : '' }}>Cartão de Crédito</option>
                                <option value="PIX" {{ old('forma_pagamento', $venda->forma_pagamento) == 'PIX' ? 'selected' : '' }}>PIX</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="observacoes" class="form-label">Observações</label>
                            <textarea id="observacoes" name="observacoes" class="form-control" rows="3">{{ old('observacoes', $venda->observacoes) }}</textarea>
                        </div>

                        <hr>

                        <button type="submit" class="btn btn-primary">Atualizar</button>
                        <a href="{{ route('vendas.index') }}" class="btn btn-secondary">Cancelar</a>

                        <hr>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
