@extends('layouts.app')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <h2 style="font-size: 1.5rem; font-weight: 700;">All Products</h2>
    <a href="{{ route('products.create') }}" class="btn btn-primary">+ Add New Product</a>
</div>

@if($products->isEmpty())
    <div class="card empty-state">
        <p>No products found. Start by adding one!</p>
    </div>
@else
    <div class="grid">
        @foreach($products as $product)
            <div class="product-card">
                @if($product->image_path)
                    <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="product-image">
                @else
                    <div class="product-image" style="display: flex; align-items: center; justify-content: center; color: var(--text-muted); font-size: 0.8rem;">
                        No Image
                    </div>
                @endif
                <div class="product-info">
                    <div class="product-name">{{ $product->name }}</div>
                    <div class="product-price">${{ number_format($product->price, 2) }}</div>
                    <div class="product-desc">{{ $product->description }}</div>
                    <div class="product-actions">
                        <a href="{{ route('products.edit', $product) }}" class="btn" style="background: rgba(255,255,255,0.05); color: white;">Edit</a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Delete this product and its image?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection
