@extends('layouts.app')

@section('content')
<div class="my-6 max-w-5xl mx-auto">
    <!-- GOLDEN RATIO SPLIT CARD (7 Cols Visual Showcase bg-blue-600 : 5 Cols Login Form) -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-lg overflow-hidden grid grid-cols-1 lg:grid-cols-12">

        <!-- KIRI (7 Kolom ~58-62%): Dominant bg-blue-600 Showcase -->
        <div class="lg:col-span-7 bg-blue-600 text-white p-8 sm:p-10 flex flex-col justify-between relative overflow-hidden">
            <div class="absolute -right-16 -top-16 w-64 h-64 rounded-full bg-blue-500/35 blur-2xl pointer-events-none"></div>
            <div class="absolute -left-16 -bottom-16 w-56 h-56 rounded-full bg-blue-800/40 blur-2xl pointer-events-none"></div>

            <div class="relative z-10 space-y-4">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/15 border border-white/25 text-xs font-bold">
                    <span>🔐 Autentikasi Sistem Inventaris Gudang</span>
                </div>
                <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight leading-tight">
                    Modul Individu D:<br>Armada Operasional
                </h2>
                <p class="text-blue-100 text-xs sm:text-sm leading-relaxed max-w-md">
                    Portal manajemen kendaraan operasional gudang (Forklift, Troli Hidrolik, dan Mobil Pick-up), pelacakan nomor seri unit, serta penjadwalan perawatan berkala.
                </p>
            </div>

            <!-- Preview Mini Armada -->
            <div class="my-6 grid grid-cols-3 gap-3 relative z-10">
                <div class="bg-white/10 backdrop-blur-xs border border-white/20 rounded-2xl p-3 text-center">
                    <div class="h-14 flex items-center justify-center bg-white rounded-xl p-1.5 mb-2">
                        <img src="{{ asset('image/Forklift.png') }}" alt="Forklift" class="max-h-11 w-auto object-contain">
                    </div>
                    <span class="text-xs font-bold block">Forklift</span>
                    <span class="text-[10px] font-mono text-blue-200">FK-01..05</span>
                </div>
                <div class="bg-white/10 backdrop-blur-xs border border-white/20 rounded-2xl p-3 text-center">
                    <div class="h-14 flex items-center justify-center bg-white rounded-xl p-1.5 mb-2">
                        <img src="{{ asset('image/Troli.png') }}" alt="Troli" class="max-h-11 w-auto object-contain">
                    </div>
                    <span class="text-xs font-bold block">Troli</span>
                    <span class="text-[10px] font-mono text-blue-200">TR-01..05</span>
                </div>
                <div class="bg-white/10 backdrop-blur-xs border border-white/20 rounded-2xl p-3 text-center">
                    <div class="h-14 flex items-center justify-center bg-white rounded-xl p-1.5 mb-2">
                        <img src="{{ asset('image/Pickup.png') }}" alt="Pickup" class="max-h-11 w-auto object-contain">
                    </div>
                    <span class="text-xs font-bold block">Pick-up</span>
                    <span class="text-[10px] font-mono text-blue-200">PU-01..05</span>
                </div>
            </div>

            <div class="relative z-10 pt-4 border-t border-blue-500/50 flex items-center justify-between text-xs text-blue-100">
                <span>Achmad Zidane • 102022500077</span>
                <span class="font-mono font-bold">Kelompok 4</span>
            </div>
        </div>

        <!-- KANAN (5 Kolom ~38-42%): Form Login -->
        <div class="lg:col-span-5 p-8 sm:p-10 flex flex-col justify-center bg-white">
            <div class="mb-6">
                <h3 class="text-xl font-extrabold text-slate-900">Masuk ke Sistem</h3>
                <p class="text-xs text-slate-500 mt-1">Gunakan akun petugas untuk mengelola jadwal perawatan armada.</p>
            </div>

            <form action="{{ route('login.process') }}" method="POST" class="space-y-4">
                @csrf

                @error('username')
                    <div class="p-3.5 bg-rose-50 border border-rose-200 text-rose-700 text-xs font-semibold rounded-xl flex items-center gap-2.5">
                        <svg class="w-4 h-4 shrink-0 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>{{ $message }}</span>
                    </div>
                @enderror

                <div>
                    <label for="username" class="block text-xs font-extrabold uppercase tracking-wider text-slate-600 mb-1.5">Username</label>
                    <input type="text"
                           id="username"
                           name="username"
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-xl shadow-2xs focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 focus:bg-white text-slate-900 placeholder-slate-400 text-sm transition"
                           placeholder="Masukkan username..."
                           value="{{ old('username') }}"
                           required>
                </div>

                <div>
                    <label for="password" class="block text-xs font-extrabold uppercase tracking-wider text-slate-600 mb-1.5">Password</label>
                    <input type="password"
                           id="password"
                           name="password"
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-xl shadow-2xs focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 focus:bg-white text-slate-900 placeholder-slate-400 text-sm transition"
                           placeholder="Masukkan password..."
                           required>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-4 rounded-xl transition duration-150 shadow-md shadow-blue-600/20 cursor-pointer text-sm">
                        Login Petugas
                    </button>
                </div>

                <div class="pt-2 text-center">
                    <a href="{{ route('home') }}" class="text-xs font-semibold text-slate-500 hover:text-blue-600 transition">
                        ← Kembali ke Dashboard Utama
                    </a>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection
