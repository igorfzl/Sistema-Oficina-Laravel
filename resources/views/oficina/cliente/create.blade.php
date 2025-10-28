@extends('navbar')

@section('content')
<h1>Cadastrar Novo Cliente</h1>

<form method="POST" action="{{ route('clientes.store') }}">
    @csrf
    <div class="mb-3">
        <label for="nome" class="form-label">Nome do Cliente</label>

        <input type="text" id="nome" name="nome" class="form-control" value="{{ old('nome') }}" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">E-mail</label>

        <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
    </div>
    <div class="mb-3">
        <label for="telefone" class="form-label">Telefone</label>

        <input type="text" id="telefone" name="telefone" class="form-control" value="{{ old('telefone') }}">
    </div>
    <div class="mb-3">
        <label for="endereco" class="form-label">Endereço</label>

        <input type="text" id="endereco" name="endereco" class="form-control" value="{{ old('endereco') }}">
    </div>

    <button type="submit" class="btn btn-primary">Cadastrar Cliente</button>
</form>
@endsection
