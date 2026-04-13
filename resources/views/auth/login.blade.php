@extends('layouts.app')

@section('content')
<div style="max-width: 450px; margin: 4rem auto;">
    <div class="card" style="padding: 3rem;">
        <div style="text-align: center; margin-bottom: 2.5rem;">
            <h2 style="font-size: 2rem; margin-bottom: 0.5rem;">Welcome Back</h2>
            <p style="color: var(--text-muted);">Please sign in to manage products</p>
        </div>

        @if($errors->any())
            <div style="background: rgba(239, 68, 68, 0.1); border: 1px solid var(--danger); color: var(--danger); padding: 1rem; border-radius: 0.75rem; margin-bottom: 1.5rem;">
                <p>Incorrect email or password.</p>
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="name@example.com" 
                       style="width: 100%; padding: 0.75rem 1rem; background: rgba(15, 23, 42, 0.5); border: 1px solid var(--border); border-radius: 0.75rem; color: white;">
            </div>

            <div class="form-group" style="margin-top: 1.5rem;">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required placeholder="••••••••"
                       style="width: 100%; padding: 0.75rem 1rem; background: rgba(15, 23, 42, 0.5); border: 1px solid var(--border); border-radius: 0.75rem; color: white;">
            </div>

            <div style="margin-top: 2.5rem;">
                <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center; height: 3.5rem; font-size: 1rem;">Sign In</button>
            </div>
        </form>

        <div style="margin-top: 2rem; text-align: center; color: var(--text-muted); font-size: 0.9rem;">
            <p>Admin Email: <span style="color: var(--text);">admin@example.com</span></p>
            <p>Password: <span style="color: var(--text);">password</span></p>
        </div>
    </div>
</div>
@endsection
