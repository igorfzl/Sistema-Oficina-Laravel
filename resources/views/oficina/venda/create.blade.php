@extends('navbar')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Registrar Venda</div>
                <div class="card-body">

                    @if ($errors->any())
                    <div class="alert alert-danger mb-3">
                        <strong>Ops! Algo deu errado.</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

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

                        <button type="submit" class="btn btn-primary">Registrar Venda</button>
                        <a href="{{ route('vendas.index') }}" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
