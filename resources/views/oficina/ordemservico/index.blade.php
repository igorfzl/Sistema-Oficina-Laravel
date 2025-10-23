
@extends('layouts.app')

@section('content')
    <h1>Sales List</h1>
    <a href="/admin/sales/create" class="btn btn-success mb-3">Add New Sale</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Preço Total </th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sales as $sale)
                <tr>
                    <td>{{ $sale->id }}</td>
                    <td>{{ $sale->user->name }}</td>
                    <td>{{ $sale->product->name }}</td>
                    <td>{{ $sale->quantity }}</td>
                    <td>${{ number_format($sale->total_price, 2) }}</td>
                    <td>
                        <a href="/admin/sales/{{ $sale->id }}/edit" class="btn btn-warning btn-sm">Edit</a>
                        <form action="/admin/sales/{{ $sale->id }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
