@extends('navbar')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Editar Serviço</h1>
    </div>
    <form method="POST" action="{{ route('servicos.update', $servico->id) }}">
        @csrf
        @method('PUT')

        <h4>Informações do Serviço</h4>
        <div class="mb-3">
            <label for="nome" class="form-label">Nome do Serviço</label>
            <input type="text" id="nome" name="nome" class="form-control" value="{{ old('nome', $servico->nome) }}" required>
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição do Serviço</label>
            <input type="descricao" id="descricao" name="descricao" class="form-control" value="{{ old('descricao', $servico->descricao) }}">
        </div>

        <div class="mb-3">
            <label for="valor" class="form-label">Preço do Serviço</label>
            <input type="text" id="valor" name="valor" class="form-control" value="{{ old('valor', $servico->valor) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Atualizar Serviço</button>
    </form>
</div>
</div>
@endsection
