<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>Log in · Kimlay Admin</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Sora:wght@600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/admin.css', 'resources/js/admin.js'])
</head>
<body class="admin-body admin-body--auth">
<div class="auth-wrap">
    <form class="auth-card" method="POST" action="{{ route('login.attempt') }}">
        @csrf

        <div class="auth-brand">
            <span class="auth-brand__logo">KIMLAY.</span>
            <span class="auth-brand__tag">Admin Panel</span>
        </div>

        <h1 class="auth-title">Welcome back</h1>
        <p class="auth-sub">Log in to manage your website content.</p>

        @if ($errors->any())
            <div class="alert alert--error">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="field {{ $errors->has('email') ? 'has-error' : '' }}">
            <label for="email">Email</label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="you@example.com"
                autofocus
                required
            >
        </div>

        <div class="field {{ $errors->has('password') ? 'has-error' : '' }}">
            <label for="password">Password</label>
            <input
                type="password"
                id="password"
                name="password"
                placeholder="••••••••"
                required
            >
        </div>

        <label class="toggle auth-remember">
            <input type="checkbox" name="remember" value="1">
            <span>Remember me</span>
        </label>

        <button type="submit" class="btn btn--primary btn--block">Log in</button>

        <a class="auth-back" href="{{ route('home') }}">← Back to website</a>
    </form>
</div>
</body>
</html>
