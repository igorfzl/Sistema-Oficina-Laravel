@extends('navbar')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Lista de servicos</h1>
        <a href="{{ route('servicos.create') }}" class="btn btn-primary">Novo Serviço</a>
    </div>

    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($servicos as $servico)
            <tr>
                <td>{{ $servico->id }}</td>
                <td>{{ $servico->nome }}</td>
                <td>{{ $servico->descricao }}</td>
                <td>R$ {{ number_format($servico->valor, 2, ',', '.') }}</td>
                <td>
                    <a href="{{ route('servicos.edit', $servico) }}" class="btn btn-warning btn-sm" title="Editar">
                        Editar
                    </a>
                    <form action="{{ route('servicos.destroy', $servico) }}" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja excluir este servico?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" title="Excluir">
                            Excluir
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
