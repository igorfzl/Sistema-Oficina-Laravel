@extends('navbar')

@section('content')
<div class="container mt-4">

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Editar Categoria</h1>
    </div>

    <form method="POST" action="{{ route('categorias.update', $categoria->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nome" class="form-label">Nome da Categoria</label>
            <input type="text" id="nome" name="nome" class="form-control" value="{{ old('nome', $categoria->nome) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Atualizar Categoria</button>
    </form>

</div>
@endsection
