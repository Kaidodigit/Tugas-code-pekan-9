@extends('layouts.app')

@section('content')
@php
    $totalData = $perawatan->count();
    $jmlFk = $perawatan->filter(fn($i) => str_starts_with(strtolower($i->nomor_seri), 'fk'))->count();
    $jmlTr = $perawatan->filter(fn($i) => str_starts_with(strtolower($i->nomor_seri), 'tr'))->count();
    $jmlPu = $perawatan->filter(fn($i) => str_starts_with(strtolower($i->nomor_seri), 'pu'))->count();
@endphp

<div class="space-y-6">

    <!-- NOTIFIKASI SUKSES -->
    @if(session('success'))
        <div id="alertSuccess" class="flex items-center justify-between p-4 text-emerald-900 bg-emerald-50 border border-emerald-200 rounded-2xl shadow-xs" role="alert">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-emerald-600 text-white flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-emerald-700">Berhasil</p>
                    <p class="text-sm font-semibold">{{ session('success') }}</p>
                </div>
            </div>
            <button type="button" onclick="document.getElementById('alertSuccess').remove()" class="text-emerald-600 hover:text-emerald-900 p-1.5 rounded-xl hover:bg-emerald-100 transition cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    @endif

    <!-- HEADER BANNER (Dominant bg-blue-600 dengan Golden Ratio Split) -->
    <div class="bg-blue-600 text-white rounded-2xl p-6 shadow-lg shadow-blue-600/20 relative overflow-hidden">
        <div class="absolute -right-12 -bottom-12 w-56 h-56 rounded-full bg-blue-500/30 blur-2xl pointer-events-none"></div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-center relative z-10">
            <div class="lg:col-span-7 space-y-1.5">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-700/80 border border-blue-400/30 text-xs font-bold text-blue-100">
                    <span>🛠️ Pemeliharaan Aset Logistik</span>
                </div>
                <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Jadwal & Riwayat Perawatan Armada</h2>
                <p class="text-xs sm:text-sm text-blue-100 max-w-2xl leading-relaxed">
                    Kelola pencatatan nomor seri dan jadwal servis berkala untuk kendaraan operasional gudang (Forklift, Troli, dan Pick-up).
                </p>
            </div>

            <div class="lg:col-span-5 flex flex-wrap lg:justify-end items-center gap-3">
                <!-- Tombol Trigger Resmi @tailwindplus/elements menggunakan command="show-modal" commandfor="..." -->
                <button type="button"
                        command="show-modal"
                        commandfor="modalPerawatan"
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-white text-blue-700 hover:bg-blue-50 text-sm font-extrabold rounded-xl shadow-md transition duration-150 cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Input Perawatan Baru</span>
                </button>
                <a href="{{ route('home') }}"
                   class="inline-flex items-center gap-2 px-4 py-2.5 bg-blue-700/80 hover:bg-blue-800 text-white border border-blue-400/30 text-sm font-semibold rounded-xl transition duration-150">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    <span>Kembali ke Menu</span>
                </a>
            </div>
        </div>
    </div>

    <!-- 4 KARTU RINGKASAN FILTER CEPAT -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <a href="{{ route('perawatan.index') }}"
           class="bg-white rounded-2xl border {{ !request('keyword') ? 'border-blue-600 ring-2 ring-blue-500/15' : 'border-slate-200/80 hover:border-blue-300' }} p-4 shadow-2xs transition flex items-center justify-between">
            <div>
                <span class="text-xs font-semibold text-slate-500 block">Semua Jadwal</span>
                <span class="text-2xl font-extrabold font-mono text-slate-900 mt-0.5 block">{{ $totalData }}</span>
            </div>
            <div class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center font-bold text-xs">
                ALL
            </div>
        </a>

        <a href="{{ route('perawatan.index', ['keyword' => 'fk']) }}"
           class="bg-white rounded-2xl border {{ strtolower(request('keyword')) === 'fk' ? 'border-blue-600 ring-2 ring-blue-500/15' : 'border-slate-200/80 hover:border-blue-300' }} p-4 shadow-2xs transition flex items-center justify-between">
            <div>
                <span class="text-xs font-semibold text-slate-500 block">Unit Forklift (FK)</span>
                <span class="text-2xl font-extrabold font-mono text-slate-900 mt-0.5 block">{{ $jmlFk }}</span>
            </div>
            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 border border-blue-200 flex items-center justify-center font-mono font-bold text-xs">
                FK
            </div>
        </a>

        <a href="{{ route('perawatan.index', ['keyword' => 'tr']) }}"
           class="bg-white rounded-2xl border {{ strtolower(request('keyword')) === 'tr' ? 'border-blue-600 ring-2 ring-blue-500/15' : 'border-slate-200/80 hover:border-blue-300' }} p-4 shadow-2xs transition flex items-center justify-between">
            <div>
                <span class="text-xs font-semibold text-slate-500 block">Unit Troli (TR)</span>
                <span class="text-2xl font-extrabold font-mono text-slate-900 mt-0.5 block">{{ $jmlTr }}</span>
            </div>
            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 border border-emerald-200 flex items-center justify-center font-mono font-bold text-xs">
                TR
            </div>
        </a>

        <a href="{{ route('perawatan.index', ['keyword' => 'pu']) }}"
           class="bg-white rounded-2xl border {{ strtolower(request('keyword')) === 'pu' ? 'border-blue-600 ring-2 ring-blue-500/15' : 'border-slate-200/80 hover:border-blue-300' }} p-4 shadow-2xs transition flex items-center justify-between">
            <div>
                <span class="text-xs font-semibold text-slate-500 block">Unit Pick-up (PU)</span>
                <span class="text-2xl font-extrabold font-mono text-slate-900 mt-0.5 block">{{ $jmlPu }}</span>
            </div>
            <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-700 border border-amber-200 flex items-center justify-center font-mono font-bold text-xs">
                PU
            </div>
        </a>
    </div>

    <!-- MAIN TABLE CARD DENGAN SEARCH TOOLBAR -->
    <div class="bg-white border border-slate-200/80 rounded-2xl shadow-xs overflow-hidden">

        <div class="p-5 border-b border-slate-200/80 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h3 class="text-base font-extrabold text-slate-900">Daftar Jadwal Perawatan Armada</h3>
                <p class="text-xs text-slate-500">
                    @if(request('keyword'))
                        Menampilkan hasil pencarian untuk kata kunci: <span class="font-mono font-bold text-blue-600">"{{ request('keyword') }}"</span>
                    @else
                        Menampilkan seluruh riwayat dan rencana servis armada operasional gudang.
                    @endif
                </p>
            </div>

            <form action="{{ route('perawatan.index') }}" method="GET" class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2.5 w-full md:w-auto">
                <div class="relative flex-1 sm:w-80">
                    <input type="text"
                           name="keyword"
                           value="{{ request('keyword') }}"
                           placeholder="Cari nomor seri armada (contoh: fk_1, tr_2, pu_1)..."
                           class="w-full pl-9 pr-4 py-2 text-xs sm:text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-600 focus:bg-white text-slate-800 placeholder-slate-400 transition">
                    <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>

                <div class="flex items-center gap-2">
                    <button type="submit" class="flex-1 sm:flex-initial px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs sm:text-sm font-bold rounded-xl shadow-xs transition cursor-pointer">
                        Cari
                    </button>
                    @if(request('keyword'))
                        <a href="{{ route('perawatan.index') }}" class="px-4 py-2 border border-rose-200 bg-rose-50 text-rose-600 hover:bg-rose-100 text-xs sm:text-sm font-bold rounded-xl transition text-center">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Tabel Data -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200/80 text-sm text-left">
                <thead class="bg-slate-900 text-white">
                    <tr>
                        <th class="px-5 py-3.5 text-center font-bold text-[11px] uppercase tracking-wider w-16">No</th>
                        <th class="px-5 py-3.5 font-bold text-[11px] uppercase tracking-wider">Nomor Seri / Armada</th>
                        <th class="px-5 py-3.5 font-bold text-[11px] uppercase tracking-wider">Kategori Unit</th>
                        <th class="px-5 py-3.5 font-bold text-[11px] uppercase tracking-wider">Tanggal Perawatan</th>
                        <th class="px-5 py-3.5 font-bold text-[11px] uppercase tracking-wider">Status Servis</th>
                        <th class="px-5 py-3.5 text-center font-bold text-[11px] uppercase tracking-wider w-48">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($perawatan as $index => $item)
                        @php
                            $prefix = strtolower(substr($item->nomor_seri, 0, 2));
                            $formattedSeri = strtoupper(str_replace('_', '-', $item->nomor_seri));
                            if ($prefix === 'tr') {
                                $unitName = 'Troli Gudang Hidrolik';
                                $unitBadge = 'bg-emerald-50 text-emerald-700 border-emerald-200';
                                $unitImg = asset('image/Troli.png');
                            } elseif ($prefix === 'pu') {
                                $unitName = 'Mobil Pick-up Logistik';
                                $unitBadge = 'bg-amber-50 text-amber-800 border-amber-200';
                                $unitImg = asset('image/Pickup.png');
                            } else {
                                $unitName = 'Forklift Operasional';
                                $unitBadge = 'bg-blue-50 text-blue-700 border-blue-200';
                                $unitImg = asset('image/Forklift.png');
                            }

                            $tglObj = \Carbon\Carbon::parse($item->tanggal_perawatan);
                            $isDone = $tglObj->isPast() && !$tglObj->isToday();
                            $isToday = $tglObj->isToday();
                        @endphp
                        <tr class="odd:bg-white even:bg-slate-50/60 hover:bg-blue-50/40 transition-colors duration-150">
                            <td class="px-5 py-4 text-center font-mono text-xs font-semibold text-slate-400 align-middle">
                                {{ $index + 1 }}
                            </td>
                            <td class="px-5 py-4 align-middle">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-white border border-slate-200 p-1 flex items-center justify-center shrink-0 shadow-2xs">
                                        <img src="{{ $unitImg }}" alt="{{ $unitName }}" class="max-h-8 w-auto object-contain">
                                    </div>
                                    <div>
                                        <span class="font-mono font-extrabold text-slate-900 text-sm block">{{ strtolower($item->nomor_seri) }}</span>
                                        <span class="text-[11px] text-slate-400 font-mono">Unit: {{ $formattedSeri }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-4 align-middle">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-bold border {{ $unitBadge }}">
                                    {{ $unitName }}
                                </span>
                            </td>
                            <td class="px-5 py-4 align-middle">
                                <div class="font-semibold text-slate-800 text-sm">
                                    {{ $tglObj->format('d M Y') }}
                                </div>
                                <div class="text-[11px] text-slate-400">
                                    {{ $tglObj->diffForHumans() }}
                                </div>
                            </td>
                            <td class="px-5 py-4 align-middle">
                                @if($isToday)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-ping"></span>
                                        Servis Hari Ini
                                    </span>
                                @elseif($isDone)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        Selesai
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-700">
                                        <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span>
                                        Terjadwal
                                    </span>
                                @endif
                            </td>
                            <td class="px-5 py-4 text-center align-middle whitespace-nowrap">
                                <div class="inline-flex items-center gap-1.5">
                                    <!-- Tombol Edit menggunakan Resmi @tailwindplus/elements command="show-modal" -->
                                    <button type="button"
                                            command="show-modal"
                                            commandfor="modalEdit{{ $item->id }}"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 bg-amber-500 hover:bg-amber-600 text-white font-bold text-xs rounded-xl transition duration-150 shadow-2xs cursor-pointer">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        <span>Edit</span>
                                    </button>

                                    @if(auth()->user()->isAdmin())
                                        <!-- Tombol Hapus (Khusus Admin) -->
                                        <button type="button"
                                                command="show-modal"
                                                commandfor="modalDelete{{ $item->id }}"
                                                class="inline-flex items-center gap-1 px-3 py-1.5 bg-rose-600 hover:bg-rose-700 text-white font-bold text-xs rounded-xl transition duration-150 shadow-2xs cursor-pointer">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            <span>Hapus</span>
                                        </button>
                                    @endif
                                </div>

                                <!-- ===============================================================
                                     TAILWIND PLUS OFFICIAL <el-dialog> UNTUK EDIT DATA
                                ================================================================ -->
                                <el-dialog>
                                    <dialog id="modalEdit{{ $item->id }}" aria-labelledby="titleEdit{{ $item->id }}" class="fixed inset-0 size-auto max-h-none max-w-none overflow-y-auto bg-transparent backdrop:bg-transparent">
                                        <el-dialog-backdrop class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in"></el-dialog-backdrop>

                                        <div tabindex="0" class="flex min-h-full items-center justify-center p-4 text-center focus:outline-none">
                                            <el-dialog-panel class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl border border-slate-200 transition-all data-closed:translate-y-4 data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in sm:my-8 sm:w-full sm:max-w-lg data-closed:sm:translate-y-0 data-closed:sm:scale-95">
                                                <div class="flex items-center justify-between px-6 py-4 bg-blue-600 text-white">
                                                    <div class="flex items-center gap-2.5">
                                                        <div class="w-8 h-8 rounded-lg bg-white/20 flex items-center justify-center">
                                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                            </svg>
                                                        </div>
                                                        <h3 id="titleEdit{{ $item->id }}" class="text-base font-extrabold">Edit Perawatan Armada</h3>
                                                    </div>
                                                    <button type="button" command="close" commandfor="modalEdit{{ $item->id }}" class="text-blue-100 hover:text-white hover:bg-blue-700 rounded-lg p-1.5 transition focus:outline-none cursor-pointer">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                        </svg>
                                                    </button>
                                                </div>

                                                <form action="{{ route('perawatan.update', $item->id) }}" method="POST">
                                                    @csrf
                                                    <div class="p-6 space-y-4">
                                                        <div>
                                                            <label class="block text-xs font-extrabold uppercase tracking-wider text-slate-600 mb-1.5">Pilih Armada & Nomor Seri</label>
                                                            <select class="w-full px-3.5 py-2.5 border border-slate-300 rounded-xl shadow-2xs focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 text-sm bg-white font-medium text-slate-800" name="nomor_seri" required>
                                                                <optgroup label="Forklift Operasional (Zona A)">
                                                                    <option value="fk_1" {{ $item->nomor_seri == 'fk_1' ? 'selected' : '' }}>FK-1 — Forklift Unit 01</option>
                                                                    <option value="fk_2" {{ $item->nomor_seri == 'fk_2' ? 'selected' : '' }}>FK-2 — Forklift Unit 02</option>
                                                                    <option value="fk_3" {{ $item->nomor_seri == 'fk_3' ? 'selected' : '' }}>FK-3 — Forklift Unit 03</option>
                                                                    <option value="fk_4" {{ $item->nomor_seri == 'fk_4' ? 'selected' : '' }}>FK-4 — Forklift Unit 04</option>
                                                                    <option value="fk_5" {{ $item->nomor_seri == 'fk_5' ? 'selected' : '' }}>FK-5 — Forklift Unit 05</option>
                                                                </optgroup>
                                                                <optgroup label="Troli Gudang Hidrolik (Zona B)">
                                                                    <option value="tr_1" {{ $item->nomor_seri == 'tr_1' ? 'selected' : '' }}>TR-1 — Troli Unit 01</option>
                                                                    <option value="tr_2" {{ $item->nomor_seri == 'tr_2' ? 'selected' : '' }}>TR-2 — Troli Unit 02</option>
                                                                    <option value="tr_3" {{ $item->nomor_seri == 'tr_3' ? 'selected' : '' }}>TR-3 — Troli Unit 03</option>
                                                                    <option value="tr_4" {{ $item->nomor_seri == 'tr_4' ? 'selected' : '' }}>TR-4 — Troli Unit 04</option>
                                                                    <option value="tr_5" {{ $item->nomor_seri == 'tr_5' ? 'selected' : '' }}>TR-5 — Troli Unit 05</option>
                                                                </optgroup>
                                                                <optgroup label="Mobil Pick-up Logistik (Zona C)">
                                                                    <option value="pu_1" {{ $item->nomor_seri == 'pu_1' ? 'selected' : '' }}>PU-1 — Pick-up Unit 01</option>
                                                                    <option value="pu_2" {{ $item->nomor_seri == 'pu_2' ? 'selected' : '' }}>PU-2 — Pick-up Unit 02</option>
                                                                    <option value="pu_3" {{ $item->nomor_seri == 'pu_3' ? 'selected' : '' }}>PU-3 — Pick-up Unit 03</option>
                                                                    <option value="pu_4" {{ $item->nomor_seri == 'pu_4' ? 'selected' : '' }}>PU-4 — Pick-up Unit 04</option>
                                                                    <option value="pu_5" {{ $item->nomor_seri == 'pu_5' ? 'selected' : '' }}>PU-5 — Pick-up Unit 05</option>
                                                                </optgroup>
                                                            </select>
                                                        </div>
                                                        <div>
                                                            <label class="block text-xs font-extrabold uppercase tracking-wider text-slate-600 mb-1.5">Tanggal Perawatan</label>
                                                            <input type="date" class="w-full px-3.5 py-2.5 border border-slate-300 rounded-xl shadow-2xs focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 text-sm font-medium text-slate-800" name="tanggal_perawatan" value="{{ $item->tanggal_perawatan }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="flex justify-end gap-2.5 px-6 py-4 bg-slate-50 border-t border-slate-200/80">
                                                        <button type="button" command="close" commandfor="modalEdit{{ $item->id }}" class="px-4 py-2 border border-slate-300 bg-white text-slate-700 hover:bg-slate-100 rounded-xl text-xs font-bold transition cursor-pointer">
                                                            Batal
                                                        </button>
                                                        <button type="submit" class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-xs font-bold transition shadow-sm cursor-pointer">
                                                            Simpan Perubahan
                                                        </button>
                                                    </div>
                                                </form>
                                            </el-dialog-panel>
                                        </div>
                                    </dialog>
                                </el-dialog>

                                @if(auth()->user()->isAdmin())
                                    <!-- ===============================================================
                                         TAILWIND PLUS OFFICIAL <el-dialog> KONFIRMASI HAPUS (KHUSUS ADMIN)
                                    ================================================================ -->
                                    <el-dialog>
                                        <dialog id="modalDelete{{ $item->id }}" aria-labelledby="titleDelete{{ $item->id }}" class="fixed inset-0 size-auto max-h-none max-w-none overflow-y-auto bg-transparent backdrop:bg-transparent">
                                            <el-dialog-backdrop class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in"></el-dialog-backdrop>

                                            <div tabindex="0" class="flex min-h-full items-center justify-center p-4 text-center focus:outline-none">
                                                <el-dialog-panel class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl border border-slate-200 transition-all data-closed:translate-y-4 data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in sm:my-8 sm:w-full sm:max-w-md data-closed:sm:translate-y-0 data-closed:sm:scale-95">
                                                    <div class="bg-white px-6 pt-6 pb-4">
                                                        <div class="sm:flex sm:items-start gap-4">
                                                            <div class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-2xl bg-rose-100 sm:mx-0">
                                                                <svg class="size-6 text-rose-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                                                                </svg>
                                                            </div>
                                                            <div class="mt-3 text-center sm:mt-0 sm:text-left">
                                                                <h3 id="titleDelete{{ $item->id }}" class="text-base font-extrabold text-slate-900">Hapus Jadwal Perawatan?</h3>
                                                                <p class="mt-1.5 text-xs text-slate-500 leading-relaxed">
                                                                    Apakah Anda yakin ingin menghapus jadwal servis untuk armada <span class="font-mono font-bold text-slate-800">#{{ strtoupper($item->nomor_seri) }}</span> pada tanggal <span class="font-semibold text-slate-800">{{ $tglObj->format('d M Y') }}</span>?
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="bg-slate-50 px-6 py-3.5 flex flex-row-reverse gap-2.5 border-t border-slate-200/80">
                                                        <a href="{{ route('perawatan.destroy', $item->id) }}" class="inline-flex justify-center rounded-xl bg-rose-600 px-4 py-2 text-xs font-bold text-white shadow-xs hover:bg-rose-700 transition">
                                                            Ya, Hapus Data
                                                        </a>
                                                        <button type="button" command="close" commandfor="modalDelete{{ $item->id }}" class="inline-flex justify-center rounded-xl bg-white px-4 py-2 text-xs font-bold text-slate-700 ring-1 ring-slate-300 hover:bg-slate-100 transition cursor-pointer">
                                                            Batal
                                                        </button>
                                                    </div>
                                                </el-dialog-panel>
                                            </div>
                                        </dialog>
                                    </el-dialog>
                                @endif

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-12 px-4">
                                <div class="max-w-sm mx-auto space-y-2">
                                    <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center mx-auto">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                        </svg>
                                    </div>
                                    <p class="text-sm font-extrabold text-slate-800">
                                        {{ request('keyword') ? 'Tidak ada data perawatan yang sesuai.' : 'Belum ada data perawatan yang dijadwalkan.' }}
                                    </p>
                                    <p class="text-xs text-slate-400">
                                        Klik tombol "Input Perawatan Baru" di atas untuk menambahkan jadwal servis armada.
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- =========================================================================
     TAILWIND PLUS OFFICIAL <el-dialog> UNTUK TAMBAH DATA (CREATE)
========================================================================== -->
<el-dialog>
    <dialog id="modalPerawatan" aria-labelledby="modalLabel" class="fixed inset-0 size-auto max-h-none max-w-none overflow-y-auto bg-transparent backdrop:bg-transparent">
        <el-dialog-backdrop class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in"></el-dialog-backdrop>

        <div tabindex="0" class="flex min-h-full items-center justify-center p-4 text-center focus:outline-none">
            <el-dialog-panel class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl border border-slate-200 transition-all data-closed:translate-y-4 data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in sm:my-8 sm:w-full sm:max-w-lg data-closed:sm:translate-y-0 data-closed:sm:scale-95">
                <div class="flex items-center justify-between px-6 py-4 bg-blue-600 text-white">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-white/20 flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                            </svg>
                        </div>
                        <h3 class="text-base font-extrabold" id="modalLabel">Form Perawatan Armada Baru</h3>
                    </div>
                    <button type="button" command="close" commandfor="modalPerawatan" class="text-blue-100 hover:text-white hover:bg-blue-700 rounded-lg p-1.5 transition focus:outline-none cursor-pointer">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form action="{{ route('perawatan.store') }}" method="POST">
                    @csrf
                    <div class="p-6 space-y-4">
                        <div>
                            <label for="nomor_seri" class="block text-xs font-extrabold uppercase tracking-wider text-slate-600 mb-1.5">Pilih Armada & Nomor Seri</label>
                            <select class="w-full px-3.5 py-2.5 border border-slate-300 rounded-xl shadow-2xs focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 text-sm bg-white font-medium text-slate-800" id="nomor_seri" name="nomor_seri" required>
                                <option value="" disabled selected>Pilih unit armada operasional...</option>
                                <optgroup label="Forklift Operasional (Zona A)">
                                    <option value="fk_1">FK-1 — Forklift Unit 01</option>
                                    <option value="fk_2">FK-2 — Forklift Unit 02</option>
                                    <option value="fk_3">FK-3 — Forklift Unit 03</option>
                                    <option value="fk_4">FK-4 — Forklift Unit 04</option>
                                    <option value="fk_5">FK-5 — Forklift Unit 05</option>
                                </optgroup>
                                <optgroup label="Troli Gudang Hidrolik (Zona B)">
                                    <option value="tr_1">TR-1 — Troli Unit 01</option>
                                    <option value="tr_2">TR-2 — Troli Unit 02</option>
                                    <option value="tr_3">TR-3 — Troli Unit 03</option>
                                    <option value="tr_4">TR-4 — Troli Unit 04</option>
                                    <option value="tr_5">TR-5 — Troli Unit 05</option>
                                </optgroup>
                                <optgroup label="Mobil Pick-up Logistik (Zona C)">
                                    <option value="pu_1">PU-1 — Pick-up Unit 01</option>
                                    <option value="pu_2">PU-2 — Pick-up Unit 02</option>
                                    <option value="pu_3">PU-3 — Pick-up Unit 03</option>
                                    <option value="pu_4">PU-4 — Pick-up Unit 04</option>
                                    <option value="pu_5">PU-5 — Pick-up Unit 05</option>
                                </optgroup>
                            </select>
                        </div>
                        <div>
                            <label for="tanggal_perawatan" class="block text-xs font-extrabold uppercase tracking-wider text-slate-600 mb-1.5">Tanggal Perawatan</label>
                            <input type="date" class="w-full px-3.5 py-2.5 border border-slate-300 rounded-xl shadow-2xs focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 text-sm font-medium text-slate-800" id="tanggal_perawatan" name="tanggal_perawatan" required>
                        </div>
                    </div>
                    <div class="flex justify-end gap-2.5 px-6 py-4 bg-slate-50 border-t border-slate-200/80">
                        <button type="button" command="close" commandfor="modalPerawatan" class="px-4 py-2 border border-slate-300 bg-white text-slate-700 hover:bg-slate-100 rounded-xl text-xs font-bold transition cursor-pointer">
                            Batal
                        </button>
                        <button type="submit" class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-xs font-bold transition shadow-sm cursor-pointer">
                            Simpan Data
                        </button>
                    </div>
                </form>
            </el-dialog-panel>
        </div>
    </dialog>
</el-dialog>
@endsection
