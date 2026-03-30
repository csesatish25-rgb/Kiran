@extends('layouts.auth')

@section('title', 'Admin Login')

@section('content')
    <div class="section-heading">
        <span class="eyebrow">Admin Login</span>
        <h2>Welcome back</h2>
        <p>Use the administrator account to access the dashboard and complete the initial password update.</p>
    </div>

    <form method="POST" action="{{ route('login.store') }}" class="form-stack">
        @csrf

        <label class="field">
            <span>Username</span>
            <input type="text" name="username" value="{{ old('username', 'admin') }}" autocomplete="username" required>
        </label>

        <label class="field">
            <span>Password</span>
            <input type="password" name="password" autocomplete="current-password" required>
        </label>

        <label class="remember-row">
            <input type="checkbox" name="remember" value="1">
            <span>Keep me signed in on this device</span>
        </label>

        <button type="submit" class="button button-primary button-block">Open Admin Panel</button>
    </form>

    <div class="credential-card">
        <p class="credential-label">Default credentials</p>
        <strong>admin / admin</strong>
        <span>After your first successful login, you will be redirected to the change-password page.</span>
    </div>
@endsection
