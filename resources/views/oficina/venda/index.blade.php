@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-md-6">
            <h3>Histórico de Vendas</h3>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('vendas.create') }}" class="btn btn-primary">Registrar Nova Venda</a>
        </div>
    </div>

    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        {{ $message }}
    </div>
    @endif
    @if ($message = Session::get('error'))
    <div class="alert alert-danger">
        {{ $message }}
    </div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Data</th>
                        <th>Cliente</th>
                        <th>Valor Total</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($vendas as $venda)
                    <tr>
                        <td>{{ $venda->id }}</td>
                        <td>{{ \Carbon\Carbon::parse($venda->data_venda)->format('d/m/Y H:i') }}</td>
                        <td>{{ $venda->cliente->nome ?? 'Cliente não informado' }}</td>
                        <td>R$ {{ number_format($venda->valor_total, 2, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('vendas.destroy', $venda) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir?');">
                                <a href="{{ route('vendas.show', $venda) }}" class="btn btn-info btn-sm">Ver Recibo</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Nenhuma venda registrada.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
