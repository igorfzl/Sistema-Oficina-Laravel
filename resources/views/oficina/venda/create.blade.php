@extends('navbar')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Registrar Venda</div>
                <div class="card-body">

                    <form method="POST" action="{{ route('vendas.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="cliente_id" class="form-label">Cliente</label>
                            <select id="cliente_id" name="cliente_id" class="form-select">
                                @foreach ($clientes as $cliente)
                                <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                                    {{ $cliente->nome }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="produto_id" class="form-label">Produto</label>
                            <select id="produto_id" name="produto_id" class="form-select" required>
                                <option value="">Selecione um produto...</option>
                                @foreach ($produtos as $produto)
                                <option value="{{ $produto->id }}" {{ old('produto_id') == $produto->id ? 'selected' : '' }}>
                                    {{ $produto->nome }} - R$ {{ number_format($produto->valor, 2, ',', '.') }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="quantidade" class="form-label">Quantidade</label>
                            <input type="number" id="quantidade" name="quantidade" class="form-control" value="{{ old('quantidade', 1) }}" min="1" required>
                        </div>
                        <div class="mb-3">
                            <label for="forma_pagamento" class="form-label">Forma de Pagamento</label>
                            <select id="forma_pagamento" name="forma_pagamento" class="form-select">
                                <option value="Dinheiro" {{ old('forma_pagamento', 'PIX') == 'Dinheiro' ? 'selected' : '' }}>Dinheiro</option>
                                <option value="Cartão de Débito" {{ old('forma_pagamento', 'PIX') == 'Cartão de Débito' ? 'selected' : '' }}>Cartão de Débito</option>
                                <option value="Cartão de Crédito" {{ old('forma_pagamento', 'PIX') == 'Cartão de Crédito' ? 'selected' : '' }}>Cartão de Crédito</option>
                                <option value="PIX" {{ old('forma_pagamento', 'PIX') == 'PIX' ? 'selected' : '' }}>PIX</option>
                            </select>
                        </div>
                </div>
                <div class="mb-3">
                    <label for="observacoes" class="form-label">Observações</label>
                    <textarea id="observacoes" name="observacoes" class="form-control" rows="3">{{ old('observacoes') }}</textarea>
                </div>
                <hr>
                <button type="submit" class="btn btn-primary">Registrar Venda</button>
                <hr>
                <a href="{{ route('vendas.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
                <hr>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
