@extends('navbar')

@section('content')
<div class="container mt-4">

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Editar Cliente</h1>
    </div>

    <form method="POST" action="{{ route('clientes.update', $cliente->id) }}">
        @csrf
        @method('PUT')

        <h4>Dados Pessoais</h4>
        <div class="mb-3">
            <label for="nome" class="form-label">Nome do Cliente</label>
            <input type="text" id="nome" name="nome" class="form-control" value="{{ old('nome', $cliente->nome) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $cliente->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="telefone" class="form-label">Telefone</label>
            <input type="text" id="telefone" name="telefone" class="form-control" value="{{ old('telefone', $cliente->telefone) }}">
        </div>

        <div class="mb-3">
            <label for="endereco" class="form-label">Endereço</label>
            <input type="text" id="endereco" name="endereco" class="form-control" value="{{ old('endereco', $cliente->endereco) }}">
        </div>

        <button type="submit" class="btn btn-primary">Atualizar Cliente</button>
    </form>

    <hr class="my-4">

    {{-- Seção para VEÍCULOS --}}
    <div class="mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Veículos do Cliente</h2>

            {{-- Botão para adicionar um novo veículo --}}
            {{-- Esta rota (ex: 'veiculos.create') deve levar a um formulário de cadastro DE VEÍCULO --}}
            {{-- Estamos passando o ID do cliente para que o formulário saiba a quem o veículo pertence --}}
            <a href="{{ route('veiculos.create', ['cliente_id' => $cliente->id]) }}" class="btn btn-success">
                + Adicionar Veículo
            </a>
        </div>

        {{-- Lista de veículos que o cliente já possui --}}
        @if ($cliente->veiculos->count() > 0)
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Placa</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Ano</th>
                    <th style="width: 150px;">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cliente->veiculos as $veiculo)
                <tr>
                    <td>{{ $veiculo->placa }}</td>
                    <td>{{ $veiculo->marca }}</td>
                    <td>{{ $veiculo->modelo }}</td>
                    <td>{{ $veiculo->ano }}</td>
                    <td>
                        {{-- Rota para editar o VEÍCULO --}}
                        <a href="{{ route('veiculos.edit', $veiculo->id) }}" class="btn btn-primary btn-sm">Editar</a>

                        {{-- Rota para deletar o VEÍCULO --}}
                        <form action="{{ route('veiculos.destroy', $veiculo->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Deletar este veículo?')">Deletar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="alert alert-info">
            Este cliente ainda não possui veículos cadastrados.
        </div>
        @endif
    </div>
</div>
@endsection
