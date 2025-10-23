@extends('navbar')

@section('content')
<h1>Cadastrar Nova Categoria</h1>

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

<form method="POST" action="{{ route('categorias.store') }}">
    @csrf
    <div class="mb-3">
        <label for="nome" class="form-label">Nome da Categoria</label>
        <input type="text" id="nome" name="nome" class="form-control" value="{{ old('nome') }}" required>
    </div>


    <button type="submit" class="btn btn-primary">Cadastrar Categoria</button>
</form>
@endsection
