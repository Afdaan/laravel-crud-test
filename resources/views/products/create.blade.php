@extends('layouts.app')

@section('content')
<div style="max-width: 600px; margin: 0 auto;">
    <div style="margin-bottom: 2rem;">
        <a href="{{ route('products.index') }}" style="color: var(--primary); text-decoration: none; font-weight: 600;">← Back to List</a>
    </div>

    <div class="card">
        <h2 style="margin-bottom: 2rem; font-size: 1.5rem;">Create New Product</h2>

        @if($errors->any())
            <div style="background: rgba(239, 68, 68, 0.1); border: 1px solid var(--danger); color: var(--danger); padding: 1rem; border-radius: 0.75rem; margin-bottom: 1.5rem;">
                <ul style="margin-left: 1.5rem;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="e.g. Modern Chair">
            </div>

            <div class="form-group">
                <label for="price">Price ($)</label>
                <input type="number" id="price" name="price" step="0.01" value="{{ old('price') }}" required placeholder="0.00">
            </div>

            <div class="form-group">
                <label for="description">Description (Optional)</label>
                <textarea id="description" name="description" rows="4" placeholder="Tell us more about the product...">{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label for="image">Product Image (Test Storage)</label>
                <input type="file" id="image" name="image" accept="image/*">
                <p style="font-size: 0.8rem; color: var(--text-muted); mt: 0.5rem;">Upload an image to test Larvel storage functionality.</p>
            </div>

            <div style="margin-top: 2.5rem;">
                <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center; height: 3.5rem; font-size: 1rem;">Create Product</button>
            </div>
        </form>
    </div>
</div>
@endsection
