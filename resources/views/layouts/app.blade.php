<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Rak Gudang') — Sistem Gudang</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="app-shell">
        <aside class="sidebar">
            <a class="brand" href="{{ route('rak.index') }}">
                <span class="brand-mark">SG</span>
                <span class="brand-copy"><strong>Sistem Gudang</strong><small>Warehouse Management</small></span>
            </a>

            <div class="nav-label">MENU UTAMA</div>
            <a class="nav-link {{ request()->routeIs('rak.*') ? 'active' : '' }}" href="{{ route('rak.index') }}">
                <span class="nav-icon">▦</span><span>Daftar Rak</span>
            </a>
            <div class="sidebar-note">
                <span class="note-dot"></span>
                <div><strong>Database terhubung</strong><small>MySQL · sistem_gudang</small></div>
            </div>
            <div class="sidebar-footer">Sistem Informasi Gudang<br><span>Laravel CRUD</span></div>
        </aside>

        <main class="main-area">
            <header class="topbar">
                <div class="breadcrumb">Gudang <span>/</span> <strong>@yield('page_title', 'Daftar Rak')</strong></div>
                <div class="topbar-right">
                    <span class="status-indicator"></span>
                    <span>Sistem aktif</span>
                    <span class="user-divider" aria-hidden="true"></span>
                    <span class="user-identity">
                        <strong>{{ auth()->user()->username }}</strong>
                        <small class="role-label role-{{ auth()->user()->role }}">{{ strtoupper(auth()->user()->role) }}</small>
                    </span>
                    <form method="POST" action="{{ route('logout') }}" class="logout-form">
                        @csrf
                        <button type="submit" class="logout-button">Logout</button>
                    </form>
                </div>
            </header>

            <div class="page-content">
                @if (session('success'))
                    <div class="alert alert-success" role="status"><span class="alert-symbol">✓</span>{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-error" role="alert">{{ session('error') }}</div>
                @endif
                @yield('content')
            </div>
            <footer class="page-footer">Sistem Gudang <span>•</span> Aplikasi pengelolaan data rak</footer>
        </main>
    </div>
    @stack('scripts')
</body>
</html>
