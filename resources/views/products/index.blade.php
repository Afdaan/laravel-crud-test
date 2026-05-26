@extends('layouts.app')

@section('content')
<!-- Webhook Test Banner -->
<div style="background: linear-gradient(90deg, rgba(99,102,241,0.2), rgba(168,85,247,0.2)); border: 1px solid rgba(99,102,241,0.4); border-radius: 1rem; padding: 1rem 1.5rem; margin-bottom: 2rem; display: flex; align-items: center; justify-content: space-between;">
    <div style="display: flex; align-items: center; gap: 1rem;">
        <span style="font-size: 1.5rem;">🚀</span>
        <div>
            <h3 style="font-weight: 700; color: #a5b4fc; margin-bottom: 0.25rem;">PaaS Auto-Deploy Push Test</h3>
            <p style="font-size: 0.85rem; color: var(--text-muted);">This banner was added to test the webhook integration. If you see this, the push event was successfully deployed!</p>
        </div>
    </div>
    <span style="font-size: 0.75rem; font-weight: 600; padding: 0.25rem 0.75rem; background: rgba(16,185,129,0.2); color: #34d399; border-radius: 9999px; border: 1px solid rgba(16,185,129,0.3);">Build #2</span>
</div>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <h2 style="font-size: 1.5rem; font-weight: 700;">All Products</h2>
    <div style="display: flex; gap: 1rem;">
        <a href="{{ route('diagnostics.index') }}" class="btn" style="background: rgba(99, 102, 241, 0.15); color: #a5b4fc; border: 1px solid rgba(99, 102, 241, 0.3);">
            🔍 PaaS Diagnostics
        </a>
        <a href="{{ route('products.create') }}" class="btn btn-primary">+ Add New Product</a>
    </div>
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
