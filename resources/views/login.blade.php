<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login — Inventaris Armada</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <main class="login-page">
        <section class="login-card" aria-labelledby="login-title">
            <div class="login-brand">
                <span class="brand-mark">IA</span>
                <span class="brand-copy"><strong>Inventaris</strong><small>Armada Operasional</small></span>
            </div>
            <h1 id="login-title">Masuk ke akun</h1>
            <p class="login-subtitle">Gunakan akun yang telah didaftarkan untuk mengakses pengelolaan armada operasional.</p>

            @if (session('success'))
                <div class="login-message" role="status">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-error" role="alert">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('login.process') }}">
                @csrf
                <div class="login-field">
                    <label for="username">Username</label>
                    <input id="username" name="username" type="text" value="{{ old('username') }}" placeholder="Masukkan username" autocomplete="username" required autofocus>
                    @error('username')<span class="login-error">{{ $message }}</span>@enderror
                </div>
                <div class="login-field">
                    <label for="password">Password</label>
                    <input id="password" name="password" type="password" placeholder="Masukkan password" autocomplete="current-password" required>
                    @error('password')<span class="login-error">{{ $message }}</span>@enderror
                </div>
                <button type="submit" class="btn btn-primary login-submit">Login</button>
            </form>
            <p class="login-note">Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
        </section>
    </main>
</body>
</html>
