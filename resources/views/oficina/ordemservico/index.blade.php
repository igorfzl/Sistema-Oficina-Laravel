@extends('navbar')

@section('content')
<div class="container mt-4">
    <div class="row mb-3">
        <div class="col-md-6">
            <h3>Histórico de Ordens de Serviço</h3>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('ordemservicos.create') }}" class="btn btn-primary">Registrar Nova OS</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Data Entrada</th>
                        <th>Cliente</th>
                        <th>Veículo</th>
                        <th>Status</th>
                        <th>Valor Total</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($ordens as $os)
                    <tr>
                        <td>{{ $os->id }}</td>
                        <td>{{ \Carbon\Carbon::parse($os->data_entrada)->format('d/m/Y') }}</td>
                        <td>{{ $os->cliente->nome ?? 'N/A' }}</td>
                        <td>{{ $os->veiculo->placa ?? ($os->veiculo->modelo ?? 'N/A') }}</td>
                        <td>
                            @if($os->status == 'Pendente')
                            <span class="badge bg-warning text-dark">{{ $os->status }}</span>
                            @elseif($os->status == 'Finalizada')
                            <span class="badge bg-success">{{ $os->status }}</span>
                            @elseif($os->status == 'Cancelada')
                            <span class="badge bg-danger">{{ $os->status }}</span>
                            @else
                            <span class="badge bg-info text-dark">{{ $os->status }}</span>
                            @endif
                        </td>
                        <td>R$ {{ number_format($os->valor_total, 2, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('ordemservicos.destroy', $os) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir?');">
                                <a href="{{ route('ordemservicos.show', $os) }}" class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('ordemservicos.edit', $os) }}" class="btn btn-warning btn-sm">Editar</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Nenhuma Ordem de Serviço registrada.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
