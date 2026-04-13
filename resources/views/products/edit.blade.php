@extends('layouts.app')

@section('content')
<div style="max-width: 600px; margin: 0 auto;">
    <div style="margin-bottom: 2rem;">
        <a href="{{ route('products.index') }}" style="color: var(--primary); text-decoration: none; font-weight: 600;">← Back to List</a>
    </div>

    <div class="card">
        <h2 style="margin-bottom: 2rem; font-size: 1.5rem;">Edit Product</h2>

        @if($errors->any())
            <div style="background: rgba(239, 68, 68, 0.1); border: 1px solid var(--danger); color: var(--danger); padding: 1rem; border-radius: 0.75rem; margin-bottom: 1.5rem;">
                <ul style="margin-left: 1.5rem;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required>
            </div>

            <div class="form-group">
                <label for="price">Price ($)</label>
                <input type="number" id="price" name="price" step="0.01" value="{{ old('price', $product->price) }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description (Optional)</label>
                <textarea id="description" name="description" rows="4">{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="image">Replace Image (Optional)</label>
                @if($product->image_path)
                    <div style="margin-bottom: 1rem;">
                        <img src="{{ asset('storage/' . $product->image_path) }}" style="width: 100px; height: 100px; object-fit: cover; border-radius: 0.5rem; border: 1px solid var(--border);">
                    </div>
                @endif
                <input type="file" id="image" name="image" accept="image/*">
            </div>

            <div style="margin-top: 2.5rem;">
                <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center; height: 3.5rem; font-size: 1rem;">Update Product</button>
            </div>
        </form>
    </div>
</div>
@endsection
