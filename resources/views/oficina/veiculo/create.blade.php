@extends('navbar')

@section('content')
<div class="container mt-4">
    <h1>Adicionar Novo Veículo</h1>
    <p>Adicionando veículo para o cliente: <strong>{{ $cliente->nome }}</strong></p>

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

    <form method="POST" action="{{ route('veiculos.store') }}">
        @csrf

        <input type="hidden" name="cliente_id" value="{{ $cliente->id }}">

        <div class="mb-3">
            <label for="placa" class="form-label">Placa</label>
            <input type="text" id="placa" name="placa" class="form-control" value="{{ old('placa') }}" required>
        </div>

        <div class="mb-3">
            <label for="marca" class="form-label">Marca</label>
            <input type="text" id="marca" name="marca" class="form-control" value="{{ old('marca') }}" required>
        </div>

        <div class="mb-3">
            <label for="modelo" class="form-label">Modelo</label>
            <input type="text" id="modelo" name="modelo" class="form-control" value="{{ old('modelo') }}" required>
        </div>

        <div class="mb-3">
            <label for="ano" class="form-label">Ano</label>
            <input type="number" id="ano" name="ano" class="form-control" value="{{ old('ano') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Cadastrar Veículo</button>

        <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
