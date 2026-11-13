<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Armada Operasional</title>
    <!-- Google Fonts: Plus Jakarta Sans & JetBrains Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Local Compiled Tailwind CSS v4 & @tailwindplus/elements via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 9999px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>
<body class="bg-slate-100/90 text-slate-800 font-sans antialiased min-h-screen flex flex-col lg:flex-row selection:bg-blue-600 selection:text-white">

    <!-- =========================================================================
         MOBILE HEADER & TAILWIND PLUS <el-dialog> DRAWER SIDEBAR
    ========================================================================== -->
    <div class="lg:hidden bg-slate-950 text-white px-4 py-3 flex items-center justify-between sticky top-0 z-40 shadow-md border-b border-slate-800">
        <div class="flex items-center gap-2.5">
            <div class="w-9 h-9 rounded-xl bg-blue-600 flex items-center justify-center shadow-inner shadow-blue-400/30">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                </svg>
            </div>
            <div>
                <span class="font-bold text-sm tracking-tight block leading-none">ARMADA<span class="text-blue-400">OPS</span></span>
            </div>
        </div>
        <button type="button" command="show-modal" commandfor="mobileSidebarDialog" class="p-2 rounded-lg bg-slate-800 text-slate-200 hover:bg-slate-700 focus:outline-none cursor-pointer">
            <span class="sr-only">Buka menu navigasi</span>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>

    <!-- Tailwind Plus Official Mobile Drawer (<el-dialog>) -->
    <el-dialog>
        <dialog id="mobileSidebarDialog" class="backdrop:bg-transparent lg:hidden">
            <el-dialog-backdrop class="fixed inset-0 bg-slate-900/70 backdrop-blur-xs transition-opacity duration-300 ease-linear data-closed:opacity-0"></el-dialog-backdrop>
            <div tabindex="0" class="fixed inset-0 flex focus:outline-none">
                <el-dialog-panel class="relative mr-16 flex w-full max-w-xs flex-1 transform transition duration-300 ease-in-out data-closed:-translate-x-full">
                    <div class="absolute top-0 left-full flex w-16 justify-center pt-5 duration-300 ease-in-out data-closed:opacity-0">
                        <button type="button" command="close" commandfor="mobileSidebarDialog" class="-m-2.5 p-2.5 text-white cursor-pointer">
                            <span class="sr-only">Tutup sidebar</span>
                            <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <!-- Drawer Content -->
                    <div class="flex grow flex-col justify-between overflow-y-auto bg-slate-950 px-5 pb-4 ring-1 ring-white/10">
                        <div class="pt-5">
                            <div class="flex items-center gap-3 px-2 mb-6">
                                <div class="w-10 h-10 rounded-xl bg-blue-600 flex items-center justify-center text-white shadow-lg shadow-blue-600/30">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1"/>
                                    </svg>
                                </div>
                                <div>
                                    <span class="font-extrabold text-white text-base tracking-tight">Armada<span class="text-blue-500">Ops</span></span>
                                </div>
                            </div>
                            <nav class="space-y-1.5">
                                <a href="{{ route('home') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-semibold {{ request()->routeIs('home') ? 'bg-blue-600 text-white' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }}">
                                    Dashboard Armada
                                </a>
                                <a href="{{ route('perawatan.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-semibold {{ request()->routeIs('perawatan.*') ? 'bg-blue-600 text-white' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }}">
                                    Jadwal Perawatan
                                </a>
                            </nav>
                        </div>
                        <div class="p-3 rounded-xl bg-slate-900 border border-slate-800 text-xs text-slate-300">
                            @auth
                                <p class="font-bold text-white">{{ ucfirst(auth()->user()->username) }}</p>
                                <p class="text-[10px] text-blue-400">Role: {{ ucfirst(auth()->user()->role) }}</p>
                            @else
                                <p class="font-bold text-white">Guest</p>
                            @endauth
                        </div>
                    </div>
                </el-dialog-panel>
            </div>
        </dialog>
    </el-dialog>

    <!-- =========================================================================
         DESKTOP SIDEBAR NAVIGATION (Minimalist App Shell)
    ========================================================================== -->
    <aside class="hidden lg:flex lg:sticky top-0 left-0 z-40 h-screen w-64 bg-slate-950 text-slate-300 flex-col justify-between shrink-0 border-r border-slate-800/80">
        <div class="p-5 overflow-y-auto">
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-3 px-2 py-1.5 mb-7 group">
                <div class="w-10 h-10 rounded-xl bg-blue-600 flex items-center justify-center text-white shadow-lg shadow-blue-600/30 group-hover:scale-105 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/>
                    </svg>
                </div>
                <div>
                    <span class="font-extrabold text-white text-base tracking-tight">Armada<span class="text-blue-500">Ops</span></span>
                    <p class="text-[11px] text-slate-400">Armada Operasional</p>
                </div>
            </a>

            <div class="px-3 mb-2 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                Menu Operasional
            </div>

            <nav class="space-y-1.5">
                <a href="{{ route('home') }}"
                   class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-150 {{ request()->routeIs('home') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/25' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }}">
                    <span class="flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Dashboard Armada
                    </span>
                    <span class="w-2 h-2 rounded-full {{ request()->routeIs('home') ? 'bg-white' : 'bg-transparent' }}"></span>
                </a>

                <a href="{{ route('perawatan.index') }}"
                   class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-150 {{ request()->routeIs('perawatan.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/25' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }}">
                    <span class="flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                        </svg>
                        Jadwal Perawatan
                    </span>
                </a>
            </nav>

            <!-- Collapsible Disclosure menggunakan @tailwindplus/elements <el-disclosure> -->
            <div class="mt-6">
                <button type="button" command="--toggle" commandfor="sidebarFleetDisclosure" class="w-full flex items-center justify-between px-3 py-2 text-[11px] font-bold uppercase tracking-wider text-slate-400 hover:text-white transition cursor-pointer">
                    <span>Kategori Unit Gudang</span>
                    <svg class="w-4 h-4 text-slate-500 transition-transform in-aria-expanded:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <el-disclosure id="sidebarFleetDisclosure" class="block mt-1 space-y-1">
                    <a href="{{ route('perawatan.index', ['keyword' => 'fk_']) }}" class="flex items-center justify-between px-3.5 py-2 rounded-xl text-xs font-medium text-slate-400 hover:bg-slate-900 hover:text-white transition">
                        <span class="flex items-center gap-2.5">
                            <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                            Forklift Elektrik
                        </span>
                        <span class="font-mono text-[11px] text-slate-500">fk_1..5</span>
                    </a>
                    <a href="{{ route('perawatan.index', ['keyword' => 'tr_']) }}" class="flex items-center justify-between px-3.5 py-2 rounded-xl text-xs font-medium text-slate-400 hover:bg-slate-900 hover:text-white transition">
                        <span class="flex items-center gap-2.5">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            Troli Hidrolik
                        </span>
                        <span class="font-mono text-[11px] text-slate-500">tr_1..5</span>
                    </a>
                    <a href="{{ route('perawatan.index', ['keyword' => 'pu_']) }}" class="flex items-center justify-between px-3.5 py-2 rounded-xl text-xs font-medium text-slate-400 hover:bg-slate-900 hover:text-white transition">
                        <span class="flex items-center gap-2.5">
                            <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                            Mobil Pick-up
                        </span>
                        <span class="font-mono text-[11px] text-slate-500">pu_1..5</span>
                    </a>
                </el-disclosure>
            </div>
        </div>

        <!-- Bottom Role Profile -->
        <div class="p-4 border-t border-slate-800/80 bg-slate-900/50">
            <div class="flex items-center gap-3">
                @auth
                    <div class="w-9 h-9 rounded-xl {{ auth()->user()->isAdmin() ? 'bg-blue-600' : 'bg-emerald-600' }} text-white font-extrabold text-xs flex items-center justify-center shrink-0 shadow-md">
                        {{ strtoupper(substr(auth()->user()->username, 0, 2)) }}
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-xs font-bold text-white truncate">{{ ucfirst(auth()->user()->username) }}</p>
                        <p class="text-[10px] text-slate-400 truncate">Role: {{ ucfirst(auth()->user()->role) }}</p>
                    </div>
                @else
                    <div class="w-9 h-9 rounded-xl bg-slate-700 text-white font-extrabold text-xs flex items-center justify-center shrink-0">
                        GU
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-xs font-bold text-white truncate">Belum Login</p>
                        <p class="text-[10px] text-slate-400 truncate">Armada Operasional</p>
                    </div>
                @endauth
            </div>

            @auth
                <form action="{{ route('logout') }}" method="POST" class="mt-3">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-3 py-2 rounded-xl bg-rose-500/10 hover:bg-rose-600 text-rose-400 hover:text-white border border-rose-500/20 text-xs font-semibold transition-all duration-150 cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="mt-3 w-full flex items-center justify-center gap-2 px-3 py-2 rounded-xl bg-blue-600 hover:bg-blue-500 text-white text-xs font-semibold transition-all duration-150 shadow-sm">
                    Login
                </a>
            @endauth
        </div>
    </aside>

    <!-- =========================================================================
         MAIN CONTENT AREA & MINIMALIST TOP HEADER
    ========================================================================== -->
    <div class="flex-1 flex flex-col min-w-0">
        <header class="bg-white/85 backdrop-blur-md border-b border-slate-200/80 sticky top-0 z-30">
            <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
                <h1 class="text-sm sm:text-base font-extrabold text-slate-900 tracking-tight">
                    Achmad Zidane, <span class="font-mono text-blue-600">102022500077</span>, Kelompok 4 Modul D Armada Operasional
                </h1>
            </div>
        </header>

        <!-- PAGE CONTENT CONTAINER -->
        <div class="flex-1 max-w-[1440px] w-full mx-auto px-4 sm:px-6 lg:px-8 py-6">
            @yield('content')
        </div>
    </div>
</body>
</html>
