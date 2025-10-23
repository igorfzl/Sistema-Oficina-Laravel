@extends('navbar')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Cadastrar Novo Produto</div>
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

                    <form method="POST" action="{{ route('produtos.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome do Produto</label>
                            <input type="text" id="nome" name="nome" class="form-control @error('nome') is-invalid @enderror" value="{{ old('nome') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="descricao" class="form-label">Descrição</label>
                            <textarea id="descricao" name="descricao" class="form-control">{{ old('descricao') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="categoria_produto_id" class="form-label">Categoria</label>
                            <select id="categoria_produto_id" name="categoria_produto_id" class="form-select @error('categoria_produto_id') is-invalid @enderror" required>
                                <option value="">Selecione uma Categoria</option>
                                @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}" {{ old('categoria_produto_id') == $categoria->id ? 'selected' : '' }}>
                                    {{ $categoria->nome }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="valor" class="form-label">Valor (R$)</label>
                            <input type="number" step="0.01" min="0" id="valor" name="valor" class="form-control @error('valor') is-invalid @enderror" value="{{ old('valor') }}" required>
                        </div>

                        <div class="text-end">
                            <a href="{{ route('produtos.index') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Cadastrar Produto</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
