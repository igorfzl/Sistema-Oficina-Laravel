@extends('navbar')

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-md-6">
            <h1>Cadastrar Novo Serviço</h1>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('servicos.index') }}" class="btn btn-secondary">Voltar para a Lista</a>
        </div>
    </div>

    @endif
    <form method="POST" action="{{ route('servicos.store') }}">
        @csrf
        <div class="card">
            <div class="card-header">
                <h4>Informações do Serviço</h4>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome do Serviço</label>
                    <input type="text" id="nome" name="nome" class="form-control" value="{{ old('nome') }}" required>
                </div>
                <div class="mb-3">
                    <label for="descricao" class="form-label">Descrição do Serviço</label>

                    <textarea id="descricao" name="descricao" class="form-control">{{ old('descricao') }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="valor" class="form-label">Preço Padrão (R$)</label>

                    <input type="number" step="0.01" min="0" id="valor" name="valor" class="form-control" value="{{ old('valor') }}" required>
                </div>
            </div>
            <div class="card-footer text-end">
                <button type="submit" class="btn btn-primary">Cadastrar Serviço</button>
            </div>
        </div>
    </form>
</div>
@endsection
