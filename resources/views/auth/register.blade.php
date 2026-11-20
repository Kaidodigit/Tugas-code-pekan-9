<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register — Sistem Gudang</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .login-page{min-height:100vh;display:grid;place-items:center;padding:24px;background:radial-gradient(circle at top left,#e9efff 0,#f5f7fb 42%,#f5f7fb 100%)}
        .login-card{width:min(100%,430px);background:#fff;border:1px solid #e5eaf1;border-radius:16px;padding:34px;box-shadow:0 18px 55px rgba(22,39,76,.09)}
        .login-brand{display:flex;align-items:center;gap:12px;margin-bottom:28px}.login-brand .brand-mark{width:48px;height:48px}
        .login-brand .brand-copy strong{color:#172033}.login-brand .brand-copy small{color:#78849a}
        .login-card h1{font:800 25px Manrope,sans-serif;letter-spacing:-.6px;margin:0 0 7px}.login-subtitle{color:#78849a;margin:0 0 24px;font-size:13px}
        .login-field{display:flex;flex-direction:column;gap:7px;margin-bottom:16px}.login-field label{font-size:12px;font-weight:700;color:#435068}.login-field input{width:100%;border:1px solid #dfe5ee;border-radius:8px;padding:12px 13px;font:inherit;font-size:13px;outline:none}.login-field input:focus{border-color:#8096f0;box-shadow:0 0 0 3px rgba(60,100,232,.09)}
        .login-submit{width:100%;margin-top:8px;padding:12px}.login-note{margin:22px 0 0;padding-top:17px;border-top:1px solid #edf0f5;color:#8994a6;font-size:12px;text-align:center}.login-error{display:block;color:#c53d48;font-size:11px}.login-message{padding:11px 13px;margin-bottom:17px;border-radius:8px;background:#edfaf3;border:1px solid #cceedd;color:#18734f;font-size:12px}
        @media(max-width:480px){.login-card{padding:25px 21px}}
    </style>
</head>
<body>
    <main class="login-page">
        <section class="login-card" aria-labelledby="auth-title">
            <div class="login-brand">
                <span class="brand-mark">SG</span>
                <span class="brand-copy"><strong>Sistem Gudang</strong><small>Warehouse Management</small></span>
            </div>
            <h1 id="auth-title">Buat akun baru</h1>
            <p class="login-subtitle">Akun baru otomatis terdaftar sebagai Staff.</p>

            @if (session('success'))
                <div class="login-message" role="status">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-error" role="alert">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('register.proses') }}">
                @csrf
                <div class="login-field">
                    <label for="username">Username</label>
                    <input id="username" name="username" type="text" value="{{ old('username') }}" maxlength="50" autocomplete="username" required autofocus>
                    @error('username')<span class="login-error">{{ $message }}</span>@enderror
                </div>
                <div class="login-field">
                    <label for="password">Password</label>
                    <input id="password" name="password" type="password" autocomplete="new-password" required>
                    @error('password')<span class="login-error">{{ $message }}</span>@enderror
                </div>
                <div class="login-field">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required>
                </div>
                <button type="submit" class="btn btn-primary login-submit">Daftar</button>
            </form>
            <p class="login-note">Sudah punya akun? <a href="{{ route('login') }}" style="color:#3c64e8;font-weight:700">Login</a></p>
        </section>
    </main>
</body>
</html>
