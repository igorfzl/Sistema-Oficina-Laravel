
@extends('layouts.app')

@section('content')
    <h1>Edit Sale</h1>
    <form method="POST" action="/admin/sales/{{ $sale->id }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="user_id" class="form-label">User</label>
            <select id="user_id" name="user_id" class="form-select" required>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $user->id == $sale->user_id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="product_id" class="form-label">Product</label>
            <select id="product_id" name="product_id" class="form-select" required>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}" {{ $product->id == $sale->product_id ? 'selected' : '' }}>
                        {{ $product->name }} - ${{ $product->price }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" id="quantity" name="quantity" class="form-control" min="1" value="{{ $sale->quantity }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Sale</button>
    </form>
@endsection
